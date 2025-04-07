<?php

namespace App\Http\Controllers;

use App\Models\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\OrderDataTable;
use Illuminate\Support\Facades\Mail;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderDataTable $order_data_table)
    {
        return $order_data_table->render("admin.orders");
    }
 
    public function status_update(Request $request, $id)
    {
        $order = orders::find($id);
        // dd($order, $request->status);
        if ($order) {
            $order->order_status = $request->status;
           if($order->save() && $request->status=='completed'){
             $info=DB::table('orders')->where('orders.order_id', $id)     
             ->join('order_lines', 'orders.order_id', '=', 'order_lines.order_id')
                ->join('accounts', 'orders.account_id', '=', 'accounts.account_id')
                ->join('items', 'order_lines.item_id', '=', 'items.item_id')
                ->join('item_category', 'items.item_id', '=', 'item_category.item_id')
                ->join('category', 'item_category.category_id', '=', 'category.category_id')
                ->join('users', 'accounts.account_id', '=', 'users.account_id')
                ->select([
                    'orders.order_id AS ID', // Group by this column
                    DB::raw('CONCAT(users.fname, " ", users.lname) AS Customer'),
                    'accounts.email AS Email',
                    'orders.created_at AS Order Placed',
                    DB::raw('SUM(orders.total_amount) AS "Total Amount"'), // Aggregate total amount
                    'orders.order_status AS Status',
                ])
                ->groupBy('orders.order_id', 'users.fname', 'users.lname', 'accounts.email', 'orders.created_at', 'orders.order_status')
                ->get();

                 
                Mail::send('mails.checkoutmail', ['info' => $info], function ($message) use ($info) {
                    $message->to($info->first()->Email)
                            ->subject('Order Status Update');
                });
           }
            
        }
        return redirect()->back()->with('error', 'Order not found.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(orders $orders)
    {
        //
    }
}
