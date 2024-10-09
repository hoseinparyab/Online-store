<?php

namespace App\Http\Controllers\Admin\Market;

use App\Models\Market\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function newOrders()
    {
        return view('admin.market.order.index');
    }
    public function sending()
    {
        return view('admin.market.order.index');
    }
    public function unpaid()
    {
        return view('admin.market.order.index');
    }
    public function canceled()
    {
        return view('admin.market.order.index');
    }
    public function returned()
    {
        return view('admin.market.order.index');
    }
    public function all()
    {
        $orders = Order::all();
        return view('admin.market.order.index', compact('orders'));
    }
    public function show()
    {
        return view('admin.market.order.index');
    }
    public function changeSendStatus(Order $order)
    {
        switch ($order->delivery_status) {
            case 0:
                $order->delivery_status = 1;
                break;
            case 1:
                $order->delivery_status = 2;
                break;
            case 2:
                $order->delivery_status = 3;
                break;
            default:
                $order->delivery_status = 0;
        }
        $order->save();
        return back();
    }
    public function changeOrderStatus(Order $order)
    {
        switch ($order->order_status) {
            case 1:
                $order->order_status = 2;
                break;
            case 2:
                $order->order_status = 3;
                break;
            case 3:
                $order->order_status = 4;
                break;
            case 4:
                $order->order_status = 5;
                break;
            case 5:
                $order->order_status = 6;
                break;
            default:
                $order->order_status = 1;
        }
        $order->save();
        return back();
    }
    public function cancelOrder(Order $order)
    {
        $order->order_status = 4;
        $order->save();
        return back();
    }
}
