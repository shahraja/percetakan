<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function province()
    {
        $api_key = Config::get('app.rajaongkir');
        // $api_key = env('RAJA_ONGKIR_KEY');
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
    
    public function city($province_id)
    {
        $api_key = config('app.rajaongkir');
        // $apiURL = 'https://api.rajaongkir.com/starter/city?province=' . $province_id;
        $apiURL = "https://api.rajaongkir.com/starter/city?province={$province_id}";

        $response = Http::withHeaders([
            'key' => $api_key
        ])->get($apiURL);
        
        $cities = $response->json()['rajaongkir']['results']; // Ambil hasil dari respons API
        
        return response()->json($cities); // Kirimkan dalam bentuk JSON
    }

    public function edit()
    {
        $user = auth()->user();
        $products = Product::all();

        $api_key = Config::get('app.rajaongkir');
        $apiURL = 'https://api.rajaongkir.com/starter/province';
        $apiURLKota = 'https://api.rajaongkir.com/starter/city?id=' . $user->kota;

        $provinces = [];

        try {
            $response = Http::withHeaders(['key' => $api_key])->get($apiURL);
            if ($response->successful()) {
                $provinces = $response->json()['rajaongkir']['results'];
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', 'Gagal mengambil data Provinsi');
        }

        try {
            $response = Http::withHeaders(['key' => $api_key])->get($apiURLKota);
            
            // if ($response->successful()) {
            //     $user->kotaName = $response->json()['rajaongkir']['results']['city_name'];
            // }
            
        } catch (\Exception $e) {
            dd($e, $user->kotaName, $user->kota, $apiURLKota, $api_key, $provinces);                   
            return redirect()->back()->with('alert', 'Gagal mengambil data Kota');
        }


        return view('client.profile', compact('products', 'user', 'provinces'));
    }

    public function update(Request $request)
    {
        $user_id = auth()->user()->id;

        $user = User::findOrFail($user_id);

        $request->validate([
            'gambar' => 'file|image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'no_telp' => 'nullable|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $filename);
            $user->gambar = $filename;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->no_telp = $request->no_telp;
        $user->alamat = $request->alamat;
        $user->provinsi = $request->provinsi;
        $user->kota = $request->kota;
        $user->kecamatan = $request->kecamatan;
        $user->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
