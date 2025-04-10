<?php

namespace App\Modules\Admin\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\StaffType;

class IndexController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = StaffType::query()->get();
        $benefit = self::benefit($request);
        return view('dashboard',compact('data','benefit'));
    }

    private function benefit($request){
        $from = $request->from;
        $to = $request->to;

        $query = OrderProduct::query()
        ->join('orders','order_products.order_id','=','orders.id'); // Asosiy model (masalan, HisobKitob yoki shunga o‘xshash)

        if ($from && $to) {
            $query->whereBetween('orders.date', [$from, $to]);
        }

        $data = $query->get();
        $total = 0;
        foreach($data as $item){
            $total = $total + $item->number * ($item->price - $item->cost_price);
        }

        return $total;
    }

}
