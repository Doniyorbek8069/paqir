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

    private function benefit(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $query = OrderProduct::query()
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->select('order_products.number', 'order_products.price', 'order_products.cost_price', 'orders.date');

        if ($from && $to) {
            $query->whereBetween('orders.date', [$from, $to]);
        }

        $data = $query->get();

        $total = $data->reduce(function ($carry, $item) {
            return $carry + ((float)$item->number * ((float)$item->price - (float)$item->cost_price));
        }, 0);

        return $total;
    }


}
