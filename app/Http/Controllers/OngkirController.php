<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function province()
    {
        $api_key = env('RAJA_ONGKIR_KEY');

        $client = new Client();

        $apiURL = "https://api.rajaongkir.com/starter/province";
        

        try {
            $response = $client->request('GET', $apiURL, [
                'headers' => [
                    'key' => $api_key
                ]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $data = [];
        }
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function city($province_id)
    {
        $api_key = env('RAJA_ONGKIR_KEY');

        $client = new Client();

        $apiURL = "https://api.rajaongkir.com/starter/city?province=".$province_id;
        

        try {
            $response = $client->request('GET', $apiURL, [
                'headers' => [
                    'key' => $api_key
                ]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $data = [];
        }
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cost(Request $request)
    {
        $api_key = env('RAJA_ONGKIR_KEY');

        $client = new Client();

        $apiURL = "https://api.rajaongkir.com/starter/cost". "?origin=" . $request->origin . "&destination=" . $request->destination . "&weight=2000" . "&courier=jne";
        

        try {
            $response = $client->request('GET', $apiURL, [
                'headers' => [
                    'key' => $api_key
                ]
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $data = [];
        }
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
