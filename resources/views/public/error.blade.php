@extends('public.layout')

@section('content')
    <section class="page-section cta" style="background-color: rgba(150,230,150,0.15);padding: 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">PERHATIAN</span><span class="section-heading-lower">SERVER ERROR</span></h2>
                        <p class="text-center mb-0">Telah terjadi error #{{ $error }}, silakan hubungi Administrator</p>
@if (isset($description))
                        <p class="text-center mb-0">{{ $description }}</p>
@endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
