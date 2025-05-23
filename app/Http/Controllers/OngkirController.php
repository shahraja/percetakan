<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Spatie\FlareClient\Api;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function province()
    {
        $api_key = Config::get('app.rajaongkir');
        $apiURL = 'https://api.rajaongkir.com/starter/province';

        try {
            $response = Http::withHeaders([
                'key' => $api_key,
            ])->get($apiURL);

            if ($response->successful()) {
                $data = $response->json();
            } else {
                $data = $response->json();
            }
        } catch (\Exception $e) {
            $data = $response->json();
        }

        return response()->json([
            'data' => $data,
            // 'api' => $api_key,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function city($province_id)
    {
        // $api_key = env('RAJA_ONGKIR_KEY');
        $api_key = Config::get('app.rajaongkir');
        $apiURL = 'https://api.rajaongkir.com/starter/city?province=' . $province_id;
        
        try {
            $response = Http::withHeaders([
                'key' => $api_key,
            ])->get($apiURL);

            if ($response->successful()) {
                $data = $response->json();
            } else {
                $data = [];
            }
        } catch (\Exception $e) {
            $data = [];
        }

        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function cost(Request $request)
    {
        // $api_key = env('RAJA_ONGKIR_KEY');
        $api_key = Config::get('app.rajaongkir');

        $client = new Client();

        $apiURL = 'https://api.rajaongkir.com/starter/cost' . '?origin=' . $request->origin . '&destination=' . $request->destination . '&weight=2000' . '&courier=jne';
        // dd($apiURL);
        try {
            $response = $client->request('GET', $apiURL, [
                'headers' => [
                    'key' => $api_key,
                ],
            ]);
            $data = json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            $data = [];
        }
        return response()->json([
            'data' => $data,
        ]);

        // $api_key = env('RAJA_ONGKIR_KEY');
        // $apiURL = 'https://api.rajaongkir.com/starter/cost' . '?origin=' . $request->origin . '&destination=' . $request->destination . '&weight=2000' . '&courier=jne';

        // try {
        //     $response = Http::withHeaders([
        //         'key' => $api_key,
        //     ])->get($apiURL);

        //     if ($response->successful()) {
        //         $data = json_decode($response->getBody()->getContents(), true);
        //     } else {
        //         $data = [];
        //     }
        // } catch (\Exception $e) {
        //     $data = [];
        // }

        // return response()->json([
        //     'data' => $data,
        // ]);
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
