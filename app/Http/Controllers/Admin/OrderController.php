<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;
    public function __construct(Order $order)
    {
        
        $this->order = $order;
    }

    public function list()
    {
        $orders = $this->order->latest()->paginate(10);
        return view('Admin.Order.list', compact('orders'));
    }

    public function orderDetails($id)
    {
        $orderDetails = $this->order->find($id);
        return view('Admin.Order.orderDetails', compact('orderDetails'));
    }

    public function updateStatus(Request $request)
    {
        $orderStatus = $this->order->find($request->id);

        if($orderStatus)
        {
            $orderStatus->status =1;
        }
        $orderStatus->save();

        return back();
    }

    public function delete($id)
    {
       $deleteOrder= $this->order->find($id);
       $deleteOrder->products()->detach();
       $deleteOrder->delete();
       
        return back()->with('success', 'Delete Order successfully !');
    }
}
