@extends('layouts.client.app')

@section('title', 'Beli')

@section('content')
    <div class="container mb-5">
        <h2 class="my-5"><span class="btn btn-success bg-utama"><i class="fa fa-arrow-left pe-2"></i></span> Keranjang Saya</h2>
        <form action="">
            <label>
                <input type="radio" name="option" value="1" onclick="toggleCard()"> Delivery
            </label>
            <label class="ms-5">
                <input type="radio" name="option" value="2" onclick="toggleCard()"> Pick Up
            </label>
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow card">
                    <div class="row">
                        <div>
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="container">
                                        <p class="my-1">Rose Sumiyanti</p>
                                        <p>0897888999</p>
                                    </div>
                                </div>
                                <div class="col-md-9 mb-1">
                                    <p class="my-1">Alamat Pengiriman</p>
                                    <p>Jalan kampung durian runtuh, RT 123 RW 405 rumah hijau opah ( didepan banyak tanaman rose) SUKABUMI, KOTA BANDAR LAMPUNG, LAMPUNG, ID 35122</p>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row">
                        <div>
                            <p>Produk Dipesan</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row py-3">
                                <di class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <img src="{{asset('assets/img/undangan.jpg')}}" class="img img-fluid rounded" style="object-fit: cover max-width: 120px; max-height:120px;" width="500" alt="">
                                        </div>
                                        <div class="col-md-5">
                                            <p class="ms-2">banner</p>
                                        </div>
                                    </div>
                                </di>
                                <div class="col-md-2 mb-1">
                                    <p>Variasi</p>
                                    <p>variasi: 1 Sisi, Artpaper 100gr, glossy 1 sisi, tanpa lipat</p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p>Harga Satuan</p>
                                    <p>Rp650</p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p>Jumlah</p>
                                    <p>1000</p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p>Subtotal Produk</p>
                                    <p>Rp650.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-end mt-5">
                <div class="col-md-4 p-0">
                    <div class="border rounded p-3 mt-2 shadow w-100 justify-content-end">
                        <p class="my-1">Subtotal     :    Rp.500.000</p>
                        <p>Ongkos Kirim :    Rp.500.000</p>
                        <hr>
                        <p>Total:       Rp.500.000</p>
                        <div class="text-center my-3">
                            <button type="submit" class="btn btn-success bg-utama col-md-8">CheckOut</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
    function toggleCard() {
        const card = document.querySelector('.card');
        const radioButtons = document.querySelectorAll('input[name="option"]');
        
        if (radioButtons[1].checked) {
            card.style.display = 'none';
        } else {
            card.style.display = 'block';
        }
    }
</script>
    
@endsection