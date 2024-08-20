<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Ukuran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // $products = Product::with('ukuran.detailUkuran.detailValueUkuran')->get();
        return view('admin.product.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($id);
        $products = Product::with('ukuran.detail_ukuran.detail_value_ukuran')->get();

        $request->validate([
            'judul' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required',
        ]);

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . '.' . $gambar->getClientOriginalExtension();
            $data->gambar = $file_name;
            $data->update();
            $gambar->move('../public/assets/img/', $file_name);
        }

        if ($request->has('prices')) {
            foreach ($request->prices as $detail_ukuran_id => $value) {
                DB::table('detail_value_ukuran')
                    ->where('detail_ukuran_id', $detail_ukuran_id)
                    ->update(['value' => $value]);
            }
        }

        return back()->with('alert', 'Berhasil Edit Data!');
    }

    public function ukuran(string $judul)
    {
        $judul = Str::ucfirst($judul);
        $product = Product::where('judul', $judul)->first();
        $ukurans = Ukuran::where('product_id', $product->id)
            ->with('detail_ukuran')
            ->get();
        // dd($ukurans);
        return view('admin.product.ukuran.index', compact('ukurans', 'product'));
    }

    public function storeUkuran(Request $request, Product $product)
    {
        $request->validate([
            'nama_ukuran' => 'required|string|max:255',
        ]);

        Ukuran::create([
            'product_id' => $product->id,
            'nama_ukuran' => $request->nama_ukuran,
        ]);

        return redirect()
            ->route('admin.product.ukuran', $product->judul)
            ->with('success', 'Ukuran added successfully.');
    }

    public function updateUkuran(Request $request, Ukuran $ukuran)
    {
        $request->validate([
            'nama_ukuran' => 'required|string|max:255',
        ]);
        $ukuran->update([
            'nama_ukuran' => $request->nama_ukuran,
        ]);

        return redirect()
            ->route('admin.product.ukuran', $request->product)
            ->with('success', 'Ukuran updated successfully.');
    }

    public function deleteUkuran(Ukuran $ukuran)
    {
        $ukuran->delete();
        return redirect()
            ->route('admin.product.ukuran', $ukuran->produk->judul)
            ->with('success', 'Ukuran deleted successfully.');
    }

    public function updateOrCreate(Request $request)
    {
        $data = $request->all();
        // dd($data);
        // Ensure 'ukuran_id' exists in the request
        if (!isset($data['ukuran_id'])) {
            return redirect()->back()->with('error', 'Ukuran ID is missing.');
        }

        // Ensure 'detail_ukuran_id' exists in the request
        if (isset($data['detail_ukuran_id'])) {
            foreach ($data['detail_ukuran_id'] as $index => $id) {
                DetailUkuran::updateOrCreate(
                    ['id' => $id], // Match by ID
                    [
                        'nama_detail_ukuran' => $data['nama_detail_ukuran'][$index], // Update the 'nama_detail_ukuran' field
                        'ukuran_id' => $data['ukuran_id'], // Update the 'ukuran_id' field
                    ],
                );
            }
        } else {
            // If 'detail_ukuran_id' doesn't exist, handle as a new entry
            foreach ($data['nama_detail_ukuran'] as $index => $namaDetailUkuran) {
                DetailUkuran::create([
                    'nama_detail_ukuran' => $namaDetailUkuran,
                    'ukuran_id' => $data['ukuran_id'], // Associate with the correct 'ukuran_id'
                ]);
            }
        }

        return redirect()->back()->with('success', 'Detail Ukuran updated successfully.');
    }

    public function updateOrCreateDetailValue(Request $request, $id)
    {
        $data = $request->all();
        $ukuran_id = $data['ukuran_id'];
        $detail_ukuran_id = $data['detail_ukuran_id'];
        $nama_value_ukuran = $data['nama_value_ukuran'];
        $values = $data['value'];

        // Determine is_parent value
        $isParent = count($nama_value_ukuran) > 1 ? false : true;

        // Update or create DetailUkuran
        DetailUkuran::updateOrCreate(['id' => $detail_ukuran_id], ['ukuran_id' => $ukuran_id, 'is_parent' => $isParent]);

        // Handle DetailValueUkuran
        foreach ($nama_value_ukuran as $index => $namaValueUkuran) {
            DetailValueUkuran::updateOrCreate(
                ['id' => $data['detail_value_ukuran_id'][$index] ?? null],
                [
                    'detail_ukuran_id' => $detail_ukuran_id,
                    'nama_value_ukuran' => $namaValueUkuran,
                    'value' => $values[$index],
                ],
            );
        }

        return redirect()->back()->with('success', 'Detail Value Ukuran updated successfully.');
    }

    public function showValueUkuran($id)
    {
        $detail_ukuran = DetailUkuran::findOrFail($id);
        $ukuran = $detail_ukuran->ukuran; // Assuming you have a relationship to get the parent 'ukuran'

        return view('admin.product.value_ukuran.index', compact('detail_ukuran', 'ukuran'));
    }
}
