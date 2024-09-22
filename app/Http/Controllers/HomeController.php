<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Brosur;
use App\Models\Buku;
use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use App\Models\Kalender;
use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Ukuran;
use App\Models\Undangan;
use App\Services\CreateSnapToken;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // dd($products);
        // $ukuranOriginal = [
        //     'plano1' => [
        //         'width' => 30.5,
        //         'height' => 46,
        //         'hp' => 3200,
        //         'plano' => [61, 92],
        //         'prices' => [
        //             '120' => 2000,
        //             '150' => 2300,
        //             '190' => 2950,
        //             '210' => 3200,
        //             '230' => 3500,
        //         ],
        //     ],
        //     'plano2' => [
        //         'width' => 32.5,
        //         'height' => 45,
        //         'hp' => 3400,
        //         'plano' => [65, 90],
        //         'prices' => [
        //             '120' => 2100,
        //             '150' => 2450,
        //             '190' => 3050,
        //             '210' => 3400,
        //             '230' => 3600,
        //             '260' => 4050,
        //             '310' => 4800,
        //         ],
        //     ],
        // ];

        // $ukuranOriginals = [
        //     'Ukuran->nama_ukuran' => [
        //         'DetailUkuran->nama_detail_ukuran' => 'DetailValueUkuran->value',
        //         'DetailUkuran->nama_detail_ukuran' => 'DetailValueUkuran->value',
        //         'DetailUkuran->nama_detail_ukuran' => [
        //             'DetailValueUkuran->nama_value_ukuran' => 'DetailValueUkuran->value',
        //             'DetailValueUkuran->nama_value_ukuran' => 'DetailValueUkuran->value',
        //         ],
        //     ]
        // ];

        // 'DetailUkuran->is_parent'
        // $produk = Product::where('judul', 'Brosur')->first();
        // $ukuran = Ukuran::where('product_id', $produk->id)->get();
        // $ukuranData = [];

        // foreach ($ukuran as $key => $value) {
        //     $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get(); // Mengambil semua detail ukuran

        //     $detailUkuranArray = [];
        //     foreach ($detail_ukurans as $detail_ukuran) {
        //         if ($detail_ukuran->is_parent) {
        //             $childDetails = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();
        //             $childArray = [];
        //             foreach ($childDetails as $childDetail) {
        //                 $childArray = $childDetail->value;
        //             }
        //             $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $childArray;
        //         } else {
        //             $detail_values = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();
        //             $prices = [];
        //             foreach ($detail_values as $detail_value) {
        //                 $prices[$detail_value->nama_value_ukuran] = $detail_value->value;
        //             }
        //             $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $prices;
        //         }
        //     }

        //     $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
        // }

        // foreach ($ukuran as $key => $value) {
        //     $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get(); // Mengambil semua detail ukuran

        //     $detailUkuranArray = [];
        //     foreach ($detail_ukurans as $detail_ukuran) {
        //         $detail_values = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();

        //         if (strtolower($detail_ukuran->nama_detail_ukuran) === 'plano') {
        //             // Jika "plano", simpan semua value dalam array
        //             $planoValues = [];
        //             foreach ($detail_values as $detail_value) {
        //                 $planoValues[] = $detail_value->value;
        //             }
        //             $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $planoValues;
        //         } elseif (count($detail_values) == 1) {
        //             // Jika hanya satu nilai, kembalikan sebagai nilai tunggal
        //             $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $detail_values->first()->value;
        //         } else {
        //             // Untuk multiple values (seperti "prices"), tetap dalam format array
        //             $prices = [];
        //             foreach ($detail_values as $detail_value) {
        //                 $prices[$detail_value->nama_value_ukuran] = $detail_value->value;
        //             }
        //             $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $prices;
        //         }
        //     }

        //     $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
        // }

        // $tes = $ukuranData;
        // dd($ukuranOriginal, $tes);

        return view('client.index', compact('products'));
    }

    public function about()
    {
        $products = Product::all();
        return view('client.about', compact('products'));
    }

    public function contact()
    {
        $products = Product::all();
        return view('client.contact', compact('products'));
    }

    public function detail_product(Request $request, $id)
    {
        $products = Product::all();
        // $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        $product = Product::findOrFail($id);
        $ukuran = Ukuran::where('product_id', $id)->get();
        $ukuranData = [];

        foreach ($ukuran as $key => $value) {
            $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get(); // Mengambil semua detail ukuran

            $detailUkuranArray = [];
            foreach ($detail_ukurans as $detail_ukuran) {
                $detail_values = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();

                if (strtolower($detail_ukuran->nama_detail_ukuran) === 'plano') {
                    // Jika "plano", simpan semua value dalam array
                    $planoValues = [];
                    foreach ($detail_values as $detail_value) {
                        $planoValues[] = $detail_value->value;
                    }
                    $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $planoValues;
                } elseif (count($detail_values) == 1) {
                    // Jika hanya satu nilai, kembalikan sebagai nilai tunggal
                    $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $detail_values->first()->value;
                } else {
                    // Untuk multiple values (seperti "prices"), tetap dalam format array
                    $prices = [];
                    foreach ($detail_values as $detail_value) {
                        $prices[$detail_value->nama_value_ukuran] = $detail_value->value;
                    }
                    $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $prices;
                }
            }

            $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
        }
        // dd($ukuranData);

        return view('client.detail_product', compact('product', 'products', 'ukuranData'));
    }

    public function cart()
    {
        $userId = auth()->user()->id;
        $transaksis = Transaksi::where('user_id', $userId)->where('status', 'Menunggu Pembayaran')->get();

        $products = Product::all();
        return view('client.cart', compact('transaksis', 'products'));
    }

    public function cart2()
    {
        $userId = auth()->user()->id;
        $statuses = ['Ditolak', 'Pesanan Diproses', 'Menunggu Pembayaran', 'Telah Dikonfirmasi', 'Selesai', 'Pesanan Dikirimkan', 'Pembayaran Dikonfirmasi'];
        $transaksis = Transaksi::where('user_id', $userId)->whereIn('status', $statuses)->get();

        $products = Product::all();

        return view('client.cart2', compact('transaksis', 'products'));
    }

    public function checkout()
    {
        $products = Product::all();
        return view('client.checkout', compact('products'));
    }

    public function payment(Request $request, string $nomor_pesanan)
    {
        $transaksi = Transaksi::with('produk')->where('nomor_pesanan', $nomor_pesanan)->first();
        // dd($transaksi);
        $product = $transaksi->produk;
        // dd($products->id);

        $transaction_details = [
            'order_id' => $transaksi->nomor_pesanan,
            'gross_amount' => intval($transaksi->total_harga),
        ];
        $items = [
            [
                'id' => $transaksi->produk_id,
                'quantity' => 1,
                'price' => intval($transaksi->total_harga),
                'name' => 'Kalender',
            ],
        ];

        $customer_details = [
            'first_name' => $transaksi->user->name,
            'email' => $transaksi->user->email,
            'phone' => $transaksi->user->no_telp,
            'address' => $transaksi->user->alamat,
        ];

        $params = [
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'customer_details' => $customer_details,
        ];
        $snapToken = new CreateSnapToken($params);
        $token = $snapToken->getSnapToken();

        // dd($totalHarga, $params);
        if ($product->judul == 'Buku') {
            $buku = Buku::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'buku', 'products', 'token'));
        } elseif ($product->judul == 'Kalender') {
            $kalender = Kalender::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'kalender', 'products', 'token'));
        } elseif ($product->judul == 'Majalah') {
            $majalah = Majalah::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'majalah', 'products', 'token'));
        } elseif ($product->judul == 'Undangan') {
            $undangan = Undangan::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'undangan', 'products', 'token'));
        } elseif ($product->judul == 'Brosur') {
            $brosur = Brosur::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'brosur', 'products', 'token'));
        }
    }

    public function profile()
    {
        $products = Product::all();
        return view('client.profile', compact('products'));
    }

    public function clear($transaksiId)
    {
        $transaksi = Transaksi::where('id', $transaksiId)
            ->where('user_id', auth()->id())
            ->where('status', 'Menunggu Pembayaran')
            ->first();
    
        if ($transaksi) {
            $transaksi->delete();
            return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        return redirect()->route('cart')->with('error', 'Produk tidak ditemukan atau tidak dapat dihapus.');
    }
}
