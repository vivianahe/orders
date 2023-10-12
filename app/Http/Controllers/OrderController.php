<?php

namespace App\Http\Controllers;

use App\Models\DetailOrder;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::join('customers', 'customers.id', 'orders.customer_id')
            ->join('detail_orders', 'detail_orders.order_id', 'orders.id')
            ->select('customers.name', 'orders.id', 'orders.code', 'orders.delivery_address', 'orders.state', 'orders.delivery_date')
            ->where([['customers.type_document', $_GET['type']], ['customers.document', $_GET['document']], ['orders.code', $_GET['code']]])
            ->first();

        if ($order) {
            $detail = DetailOrder::join('products', 'products.id', 'detail_orders.product_id')
                ->join('orders', 'orders.id', 'detail_orders.order_id')
                ->select('products.name', 'products.ref', 'detail_orders.quantity')
                ->where('orders.id', $order->id)
                ->get();

            $responseArray = [
                'order' => $order,
                'detail' => $detail,
            ];

            return response()->json($responseArray);
        }
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
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
