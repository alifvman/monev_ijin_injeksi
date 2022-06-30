<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Monitoring dan Evaluasi Ditjen PPA Kementrian LHK Republik Indonesia">
    <meta name="author" content="adhi@mbuh.ltd">
    <meta name="generator" content="phpstorm">
    <title>{{ config('app.name') }}@if ($__env->yieldContent('title')) - @yield('title')@endif</title>
    <link rel="stylesheet" href="/assets/bootstrap/css/external.bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i">
    <link rel="stylesheet" href="/assets/css/canoneosr.css">
</head>

<body style="background: linear-gradient(rgba(47, 23, 15, 0.65), rgba(47, 23, 15, 0.65)), url('/assets/img/bg.jpg');">
    <h1 class="text-center text-white d-none d-lg-block site-heading" style="margin-top: 5px;"><span class="text-primary site-heading-upper mb-3" style="font-size: 16px;margin: 0px;margin-bottom: 0px;"><img src="/assets/img/logo-lhk.png" style="width: 69px;margin-right: 15px;">KEMENTRIAN LINGKUNGAN HIDUP DAN KEHUTANAN REPUBLIK INDONESIA<span class="site-heading-lower" style="font-size: 64px;color: rgb(255,255,255);"><br>Pengendalian Pencemaran Air<br></span></span></h1>
@yield('content')
    <section class="page-section clearfix" style="margin: 0px 0px;margin-top: 0px;margin-bottom: 15px;">
        <div class="container">
            <p class="text-right mb-0" style="color: rgb(255,255,255);font-family: Raleway, sans-serif;padding-right: 15px;font-size: 11px;padding-bottom: 15px;margin-bottom: 0px;background-color: rgba(150,230,150,0.15);padding-top: 15px;">{!! config('app.contact') !!}</p>
            <p class="text-right mb-0" style="color: rgba(255,255,255,0.5);font-family: Raleway, sans-serif;padding-right: 15px;font-size: 9px;margin-top: 15px;">{!! config('app.footer') !!}</p>
        </div>
    </section>
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/js/script.min.js"></script>
@if (View::hasSection('scripts'))
@yield('scripts')
@endif

@if (View::hasSection('in-script'))
    <script>
@yield('in-script')
    </script>
@endif
</body>

</html>
