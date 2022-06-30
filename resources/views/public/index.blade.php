@extends('public.layout')

@section('content')
    <section class="page-section clearfix">
        <div class="container">
            <div class="intro"><img class="img-fluid intro-img mb-3 mb-lg-0 rounded" src="/assets/img/ipa-pejompongan.jpg">
                <div class="intro-text left-0 text-centerfaded p-5 rounded bg-faded text-center">
                    <h2 class="section-heading mb-4"><span id="formTitle" class="section-heading-lower">Login</span></h2>
                    <form id="formAccount" method="post">
                        @CSRF
                        <input id="formAction" type="hidden" name="action" value="{{ old('action') }}">
                        <div id="inputNama" class="form-group"><label class="d-xl-flex justify-content-xl-start" style="font-family: Raleway, sans-serif;font-size: 11px;">NAMA LENGKAP :</label><input class="form-control" type="text" name="nama" required="" pattern="^[a-zA-Z ]+$" value="{{ old('nama') }}"></div>
                        <div id="inputEmail" class="form-group"><label class="d-xl-flex justify-content-xl-start" style="font-family: Raleway, sans-serif;font-size: 11px;">EMAIL :</label><input class="form-control" type="email" name="email" inputmode="email" required="" value="{{ old('email') }}"></div>
                        <div id="inputPassword" class="form-group"><label class="d-xl-flex justify-content-xl-start" style="font-family: Raleway, sans-serif;font-size: 11px;">PASSWORD :</label><input class="form-control" type="password" required="" minlength="8" maxlength="24" name="password" pattern="^[a-zA-Z0-9]+$">
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
                        <div align="left">
                            <p id="linkLogin" class="mb-3 d-none">Sudah memiliki akun? Silakan <span id="formLogin" class="link">Login</span>.</p>
                            <p id="linkForgot" class="mb-3"><span id="formForgot" class="link">Lupa password</span>?</p>
                            <p id="linkRegister" class="mb-3">Belum memiliki akun? Silakan <span id="formRegister" class="link">Daftar</span>&nbsp;terlebih dahulu.</p>
                        </div>
                        <div class="mx-auto intro-button"><button id="formSubmit" class="btn btn-primary d-inline-block mx-auto btn-xl" type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section cta" style="background-color: rgba(150,230,150,0.15);padding: 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">INFO PENGAJUAN</span><span class="section-heading-lower">PERMOHONAN</span></h2>
                        <p class="text-justify mb-0">Dalam melakukan pengajuan permohonan perizinan&nbsp;pengendalian pencemaran air, para pengurus permohonan diwajibkan memiliki akun terlebih dahulu untuk dapat mengakses layanan online. Bagi pengurus permohonan yang belum memiliki
                            akun, dapat melakukan proses pendaftaran terlebih dahulu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="page-section clearfix">
        <div class="container">
            <div class="intro"><img class="img-fluid intro-img mb-3 mb-lg-0 rounded" src="/assets/img/library.jpg">
                <div class="intro-text left-0 text-centerfaded p-5 rounded bg-faded text-center">
                    <h2 class="section-heading mb-4"><span class="section-heading-upper"><br>UNDUH</span><span class="section-heading-lower">Dokumen</span></h2>
                    <p class="text-justify mb-3">Berikut ini daftar dokumen terkait pengajuan permohonan perizinan yang dapat Anda unduh.</p>
                    <ul class="text-left border-primary" style="font-family: Raleway, sans-serif;font-size: 14px;">
                        <li><a class="text-dark" href="/documents/PaktaIntegritas.docx">Pakta Integritas</a></li>
                        <li><a class="text-dark" href="/documents/PermohonanBaru.docx">Surat Permohonan Perizinan Baru</a></li>
                        <li><a class="text-dark" href="/documents/PermohonanPerubahan.docx">Surat Permohonan Perubahan Perizinan</a></li>
                        <li><a class="text-dark" href="/documents/PermohonanPerpanjangan.docx">Surat Permohonan Perpanjangan Perizinan</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('in-script')
let snaphtml = {nama: "", password: ""};

let formulir = {
    login: function() {
        $('#formAction').val('login');
        $('#formTitle').text('Login');

        $('#inputNama').html("");
        $('#inputPassword').html(snaphtml.password);

        $('#linkLogin').addClass('d-none');
        $('#linkForgot').removeClass('d-none');
        $('#linkRegister').removeClass('d-none');
    },
    forgot: function() {
        $('#formAction').val('forgot');
        $('#formTitle').text('Lupa Password');

        $('#inputNama').html("");
        $('#inputPassword').html("");

        $('#linkLogin').removeClass('d-none');
        $('#linkForgot').addClass('d-none');
        $('#linkRegister').removeClass('d-none');
    },
    register: function() {
        $('#formAction').val('register');
        $('#formTitle').text('Daftar');

        $('#inputNama').html(snaphtml.nama);
        $('#inputPassword').html(snaphtml.password);

        $('#linkLogin').removeClass('d-none');
        $('#linkForgot').addClass('d-none');
        $('#linkRegister').addClass('d-none');
    },
    submit: function() {
        $('#formAccount').attr('action', '/account/'+$('#formAction').val());
        $('#formAccount').submit();
    }
}

$(document).ready(function() {
    snaphtml.nama = $('#inputNama').html();
    snaphtml.password = $('#inputPassword').html();

    $('#formLogin').on('click', function(e) { $('#error').remove(); formulir.login(); });
    $('#formForgot').on('click', function(e) { $('#error').remove(); formulir.forgot(); });
    $('#formRegister').on('click', function(e) { $('#error').remove(); formulir.register(); });
    $('#formAccount').on('submit', function(e) { formulir.submit(); });

    switch($('#formAction').val()) {
        case 'login':
            formulir.login();
            break;
        case 'forgot':
            formulir.forgot();
            break;
        case 'register':
            formulir.register();
            break;
        default:
            formulir.register();
    }
});
@endsection
