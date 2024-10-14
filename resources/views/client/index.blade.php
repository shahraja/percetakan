@extends('layouts.client.app')

@section('title', 'Beranda')

@section('content')
    <img src="{{ asset('assets/img/anesh_printing_1.png') }}" class="shadow bg-gradient" width="100%" alt="">
    <div class="container px-0 mb-4">
        <h2 class="text-center p-4">Produk Kami</h2>
        <div class="row justify-content-center text-center">
            {{-- @dump($products) --}}
            @foreach ($products as $index => $product)
                @if ($index % 3 == 0 && $index != 0)
        </div>
        <div class="row justify-content-center text-center">
            @endif
            <div class="col-3 p-3 text-center">
                <a href="{{ route('detail_product', $product->id) }}">
                    {{-- <img src="{{ asset('storage/app/public/img/' . $product->gambar) }}" class="img img-fluid rounded" style="object-fit: cover" width="200" alt=""> --}}
                    <img src="{{ asset('storage/img/' . $product->gambar) }}" class="img img-fluid rounded"
                        style="object-fit: cover" width="200" alt="">
                    <p class="text-center text-black">{{ $product->judul }}</p>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    <div class="mb-5">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.674103176736!2d105.2630356142678!3d-5.395348055272299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d81584c1a8142d%3A0x3b83c6fb7a64d405!2sJl.%20Teuku%20Umar%20No.2%2C%20Pasir%20Gintung%2C%20Kec.%20Tj.%20Karang%20Pusat%2C%20Kota%20Bandar%20Lampung%2C%20Lampung%2035121%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1647859816035!5m2!1sen!2sus"
            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Testimonial Start -->
    <div class="container-fluid testimonial py-5">
        <div class="container">
            <div class="text-center mx-auto pb-5" style="max-width: 800px;">
                <h2 class="text-center p-4">Testimoni</h2>
                {{-- <h4 class="text-primary">Testimonial</h4> --}}
                <h1 class="display-5 mb-4">Our Clients' Reviews</h1>
                <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur adipisci facilis
                    cupiditate recusandae aperiam temporibus corporis itaque quis facere, numquam, ad culpa deserunt sint
                    dolorem autem obcaecati, ipsam mollitia hic.</p>
            </div>
            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($testimonials->chunk(3) as $testimonialSet)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <div class="row g-4">
                                @foreach ($testimonialSet as $testimonial)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="testimonial-item bg-white p-4 position-relative rounded shadow">
                                            <div class="d-flex align-items-center mb-3">
                                                <img src="{{ $testimonial['img'] ? asset('storage/' . $testimonial['img']) : asset('img/logo-1.jpg') }}"
                                                    class="rounded-circle" width="60" height="60" alt="Client Image">
                                                <div class="ms-3">
                                                    <h5 class="mb-0">{{ $testimonial['name'] }}</h5>
                                                </div>
                                            </div>
                                            <p class="mb-3">{{ $testimonial['review'] }}</p>
                                            <div class="d-flex mb-3">
                                                @for ($i = 0; $i < $testimonial['rating']; $i++)
                                                    <i class="fa fa-star text-warning"></i>
                                                @endfor
                                                @for ($i = 0; $i < 5 - $testimonial['rating']; $i++)
                                                    <i class="fa fa-star text-muted"></i>
                                                @endfor
                                            </div>
                                            <div class="position-absolute top-0 end-0 translate-middle">
                                                <i class="fa fa-quote-right fa-2x text-primary opacity-25"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Controls for next/previous -->
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
