<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\CreateSnapToken;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction_details = [
            'order_id'      => rand(),
            'gross_amount'  => 10000,
        ];
        $items = [
            [
                'id'    => 1,
                'quantity'  => 1,
                'price' => 10000,
                'name'  => fake('name'),
            ]
        ];

        $customer_details = [
            'name'          => 'John',
            'email'         => "email@random.com",
        ];

        $params = [
            'transaction_details'   => $transaction_details,
            'item_details'          => $items,
            'customer_details'      => $customer_details,
        ];
        $snapToken = new CreateSnapToken($params);
        $token = $snapToken->getSnapToken();
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
        //
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
