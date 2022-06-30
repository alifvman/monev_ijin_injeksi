@extends('public.layout')

@section('content')
    <section class="page-section cta" style="background-color: rgba(150,230,150,0.15);padding: 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">INFORMASI</span><span class="section-heading-lower">AKTIVASI AKUN</span></h2>
                        <p class="text-justify mb-0">Selamat {{ $nama }}, akun Anda telah berhasil diaktivasi.</p>
                        <p class="text-justify mb-0">Selanjutnya silakan <a href="{{ url('/') }}">klik di sini</a> untuk kembali ke halaman depan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
