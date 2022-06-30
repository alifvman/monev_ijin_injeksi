@extends('public.layout')

@section('content')
    <section class="page-section clearfix" style="margin: 0px 0px;margin-top: 0px;margin-bottom: 15px;">
        <div class="container">
            <div class="intro"></div>
            <p class="text-right mb-0" style="color: rgb(255,255,255);font-family: Raleway, sans-serif;padding-right: 15px;font-size: 11px;padding-bottom: 15px;margin-bottom: 0px;background-color: rgba(150,230,150,0.15);padding-top: 15px;"><a class="btn btn-primary d-inline-block mx-auto btn-xl" role="button" href="/account/logout" style="padding: 6px 16px;font-family: Lora, serif;">Logout</a><br></p>
        </div>
    </section>
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
