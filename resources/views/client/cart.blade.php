@extends('layouts.client.app')

@section('title', 'Keranjang')

@section('content')
    <div class="container mb-5">
        <h2 class="my-5">Keranjang Saya</h2>
        <form action="">
            <div class="row">
                <div class="border rounded p-3 col-md-8 me-5 shadow">
                    <div class="row">
                        <div class="col-md-8">
                            <button class="btn btn-success bg-utama"><i class="fa fa-arrow-left pe-2"></i> Kembali</button>
                        </div>
                        <div class="col-md-4 text-end">
                            <button class="btn btn-outline-secondary text-end">Hapus Semua</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="container" style="max-width: 90px; max-height:90px;">
                                        <img src="{{asset('assets/img/undangan.jpg')}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <p style="text-align: justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae, debitis eos voluptas voluptatibus nulla laboriosam quas molestias expedita, in neque, officiis dicta veniam rerum officia. Suscipit rem quibusdam neque deleniti maiores sequi ab ipsa error maxime unde facilis illo, quo earum vero. A incidunt optio, eligendi debitis voluptate, error voluptatum consequuntur nesciunt, ipsum aspernatur id eos minus culpa tempora harum aliquam. Placeat optio eum quo architecto? Quos natus corrupti accusamus officia necessitatibus velit voluptatum obcaecati, exercitationem nostrum porro iste aliquam neque dolores ducimus inventore quas impedit repudiandae? Itaque aperiam numquam corporis iste praesentium ipsa eveniet voluptate quasi delectus modi. Odit.</p>
                                </div>
                                <div class="col-md-2 pt-2">
                                    <button class="btn btn-outline-secondary btn-sm">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <p>Rp.500</p>
                            {{-- <input type="text"> --}}
                            <div class="input-group mb-3 d-flex justify-content-end">
                                <div class="input-group-prepend">
                                <button class="btn btn-outline-secondary" type="button" id="minus-btn">-</button>
                                </div>
                                <input type="text" class="form-control text-center" id="quantity-input" value="1" style="max-width: 50px">
                                <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="plus-btn">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col p-0">
                    <div class="border rounded p-3 mt-2 shadow w-100">
                        <p>Subtotal:    Rp.500.000</p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
          $("#plus-btn").click(function(){
            var currentValue = parseInt($("#quantity-input").val());
            $("#quantity-input").val(currentValue + 1);
          });
          
          $("#minus-btn").click(function(){
            var currentValue = parseInt($("#quantity-input").val());
            if(currentValue > 1) {
              $("#quantity-input").val(currentValue - 1);
            }
          });
        });
      </script>
@endsection