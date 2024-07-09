<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brosur;
use App\Models\Buku;
use App\Models\Kalender;
use App\Models\Majalah;
use App\Models\Transaksi;
use App\Models\Undangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try{

            $transaksi = Transaksi::findOrFail($id);
            if ($request->judul == 'Buku')
            {
                $data = Buku::where('transaksi_id', $id)->first();
            }
            elseif ($request->judul == 'Majalah')
            {
                $data = Majalah::where('transaksi_id', $id)->first();
            }
            elseif ($request->judul == 'Brosur')
            {
                $data = Brosur::where('transaksi_id', $id)->first();
            }
            elseif ($request->judul == 'Undangan')
            {
                $data = Undangan::where('transaksi_id', $id)->first();
            }
            elseif ($request->judul == 'Kalender')
            {
                $data = Kalender::where('transaksi_id', $id)->first();
            }
    
            $data->update($request->all());
    
            DB::commit();
            return back()->with('alert', 'Berhasil Edit User!');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

    }
}
