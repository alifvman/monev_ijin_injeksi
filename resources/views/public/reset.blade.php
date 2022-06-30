@extends('public.layout')

@section('content')
    <section class="page-section clearfix">
        <div class="container">
            <div class="intro"><img class="img-fluid intro-img mb-3 mb-lg-0 rounded" src="/assets/img/ipa-pejompongan.jpg">
                <div class="intro-text left-0 text-centerfaded p-5 rounded bg-faded text-center">
                    <h2 class="section-heading mb-4"><span class="section-heading-lower">RESET</span></h2>
                    <form action="/account/setpass" method="post">
                        @CSRF
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group"><label class="d-xl-flex justify-content-xl-start" style="font-family: Raleway, sans-serif;font-size: 11px;">PASSWORD BARU :</label><input class="form-control" type="password" required="" minlength="8" maxlength="24" name="password" pattern="^[a-zA-Z0-9]+$">
                            <section class="text-right"><small style="font-family: Raleway, sans-serif;font-size: 11px;">Panjang 8 - 24 huruf dan/atau angka.<br></small></section>
                        </div>
@if ($errors->any())
                        <div id="error" align="left">
                            <small class="form-text" style="color: red;font-family: Raleway, sans-serif;font-size: 11px;text-transform: uppercase;">
                                Perhatian :
                                <ul style="padding-left: 15px;">
    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
    @endforeach
                                </ul>
                            </small>
                        </div>
@endif
                        <div class="mx-auto intro-button"><button id="formSubmit" class="btn btn-primary d-inline-block mx-auto btn-xl" type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
