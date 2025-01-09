<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Staff;
use App\Models\StaffType;
use App\Models\Table;
use App\Services\TelegramBotService;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    public function index(Request $request){
        $staffes = Staff::query();
        if($request->type_id != ""){
            $staffes = $staffes->where('type_id','=',$request->type_id);
        }
        $staffes = $staffes->get();
        $types = StaffType::query()->get();

        return view('operation.index',compact('staffes','types'));
    }

    public function income(Staff $staff,Request $request){
        DB::beginTransaction();

        try {
        $payment = Payment::query()->create([
            'custom_id' => $staff->id,
            'user_id'   => auth()->user()->id,
            'sum'       => $request->sum,
            'date'      => date('Y-m-d'),
            'comment'   => $request->comment ?? NULL
        ]);

        Table::query()->create([
            'custom_id' => $staff->id,
            'input'     => $request->sum,
            'output'    => 0,
            'debt'      => $staff->balance - $request->sum,
            'type'      => Table::INCOME,
            'object_id' => $payment->id,
            'date'      => date('Y-m-d'),
            'comment'   => $request->comment ?? NULL
        ]);

        Staff::query()->where('id','=',$staff->id)->decrement('balance',$request->sum);

        DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
        self::sendmessage('Kirim Qilindi',$request->sum,$staff->balance - $request->sum,$staff->tg_chat_id,$request->comment ?? NULL);
        return redirect()->back();
    }

    public function outcome(Staff $staff,Request $request){
        DB::beginTransaction();

        try {
        $order = Order::query()->create([
            'custom_id' => $staff->id,
            'user_id'   => auth()->user()->id,
            'sum'       => $request->sum,
            'date'      => date('Y-m-d'),
            'comment'   => $request->comment ?? NULL
        ]);

        Table::query()->create([
            'custom_id' => $staff->id,
            'input'     => 0,
            'output'    => $request->sum,
            'debt'      => $staff->balance + $request->sum,
            'type'      => Table::OUTCOME,
            'object_id' => $order->id,
            'date'      => date('Y-m-d'),
            'comment'   => $request->comment ?? NULL
        ]);

        Staff::query()->where('id','=',$staff->id)->increment('balance',$request->sum);

        DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
        self::sendmessage('CHiqim Qilindi',$request->sum,$staff->balance + $request->sum,$staff->tg_chat_id,$request->comment ?? NULL);
        return redirect()->back();
    }

    public function history(Staff $staff){
        $data = Table::query()->where('custom_id','=',$staff->id)->with(['order.products'])->orderBy('id','DESC')->paginate(100);
        $types = Table::LIST;

        return view('operation.history',compact('data','staff','types'));
    }

    public function incomes(Request $request){
        $data = Payment::query();
        
        if($request->custom_id != "")
        $data = $data->where('custom_id','=',$request->custom_id);
        
        if($request->from != "")
        $data = $data->where('date','>=',$request->from);

        if($request->till != "")
        $data = $data->where('date','<=',$request->till);

        $data = $data->paginate(12);
        
        $staffes = Staff::query()->get();

        return view('operation.incomes',compact('data','staffes'));
    }
    public function outcomes(Request $request){
        $data = Payment::query();
        
        if($request->custom_id != "")
        $data = $data->where('custom_id','=',$request->custom_id);
        
        if($request->from != "")
        $data = $data->where('date','>=',$request->from);

        if($request->till != "")
        $data = $data->where('date','<=',$request->till);

        $data = $data->paginate(12);
        
        $staffes = Staff::query()->get();

        return view('operation.outcomes',compact('data','staffes'));
    }

    public function order(Staff $staff){
        $products = Product::query()->get();

        return view('order.index',compact('products','staff'));
    }


    private function sendmessage($event,$sum,$debt,$id,$comment){
        $service = new TelegramBotService;
        
        $text = "<b>".$event."</b>"."\n";
        $text = $text."<b>Summa:</b>".number_format($sum)."\n";
        $text = $text."<b>Qarzdorlik:</b>".number_format($debt)."\n";
        $text = $text."<b>izoh:</b>".$comment."\n";

        $service->sendmessage($text,$id);

        return true;
    }
}
