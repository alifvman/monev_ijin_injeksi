@extends('public.layout')

@section('content')
    <section class="page-section cta" style="background-color: rgba(150,230,150,0.15);padding: 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">INFORMASI</span><span class="section-heading-lower">RESET PASSWORD</span></h2>
                        <p class="text-justify mb-0">Halo {{ $nama }},</p>
                        <p class="text-justify mb-0">Silakan cek email Anda di <b>{{ $email }}</b> dan klik tautan yang telah kami kirimkan untuk membuat password baru.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
