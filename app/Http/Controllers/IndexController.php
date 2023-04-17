<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $orders = Order::where('created_at', '>=', Carbon::now()->startOfMonth())->get();
        $output = [];
        foreach ($orders as &$order) {
            $data = json_decode('{}');
            $data->order_id = $order->id;
            $data->ship = $order->ship_price;
            $orderDetails = OrderDetail::where('order_id', $order->id)->get();
            $total = 0;
            foreach ($orderDetails as &$detail) {
                $total += $detail->price * $detail->quantity;
            }
            $data->total = $total;
            array_push($output, $data);
        }
        return view('homepage')->with('data', $output);
    }
}
