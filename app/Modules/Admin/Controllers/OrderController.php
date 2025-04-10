<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Staff;
use App\Models\Table;
use App\Services\TelegramBotService;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request,Staff $staff){

        DB::beginTransaction();
        try {
        $order = Order::query()->create([
            'custom_id' => $staff->id,
            'user_id'   => auth()->user()->id,
            'sum'       => 0,
            'date'      => date('Y-m-d'),
            'comment'   => $request->comment ?? NULL
        ]);
        $total = 0;
        foreach($request->products as $product){
            OrderProduct::query()->create([
                'order_id'      => $order->id,
                'product_id'    => $product['id'],
                'number'        => $product['amount'],
                'price'         => $product['price'],
                'cost_price'    => $product['cost_price']
            ]);
            $total = $total + $product['amount'] * $product['price'];
        }

        Order::query()->where('id','=',$order->id)->update([
            'sum' => $total
        ]);

        Table::query()->create([
            'custom_id' => $staff->id,
            'input'     => 0,
            'output'    => $total,
            'debt'      => $staff->balance + $total,
            'type'      => Table::OUTCOME,
            'object_id' => $order->id,
            'date'      => date('Y-m-d'),
            'comment'   => $request->comment ?? NULL
        ]);

        Staff::query()->where('id','=',$staff->id)->increment('balance',$total);

        DB::commit();
        }
        catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
        $productstext = "Mahsulotlar"."\n";
        foreach($request->products as $product){
            $productname = Product::query()->where('id','=',$product['id'])->first();
            $productstext = $productstext."<b>".$productname->name.":</b>".number_format($product['amount']).'*'.number_format($product['price'])."\n";
        }
        self::sendmessage('CHiqim Qilindi',$total,$staff->balance + $total,$staff->tg_chat_id,$request->comment ?? NULL,$productstext);

        return redirect()->back();
    }
    
    private function sendmessage($event,$sum,$debt,$id,$comment,$products){
        $service = new TelegramBotService;
        
        $text = "<b>".$event."</b>"."\n";
        $text = $text."<b>Summa:</b>".number_format($sum)."\n";
        $text = $text."<b>Qarzdorlik:</b>".number_format($debt)."\n";
        $text = $text."<b>izoh:</b>".$comment."\n";
        $text = $text.$products;
        $service->sendmessage($text,$id);

        return true;
    }
}
