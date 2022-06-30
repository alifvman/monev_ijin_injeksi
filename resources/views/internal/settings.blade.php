@extends('internal.layout')

@section('content')

    <div class="row mb-3">
        <div class="col-2"></div>
        <div class="col-6 col-lg-8">
            <div class="row">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">User Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="/account/profile" method="post">
                                @CSRF
                                <div class="form-row">
                                    <div class="col-8">
                                        <div class="form-group"><label for="username"><strong>Nama Lengkap</strong></label><input class="form-control" type="text" name="nama" value="{{ $USER['NAMA'] }}" required=""></div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group"><label for="email"><strong>Email</strong></label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" readonly="" disabled="" value="{{ $USER['EMAIL'] }}" name="email"></div>
                                    </div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Simpan</button></div>
                            </form>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold">Password Settings</p>
                        </div>
                        <div class="card-body">
                            <form action="/account/password" method="post">
                                @CSRF
                                <div class="form-row">
                                    <div class="col-4">
                                        <div class="form-group"><label for="city"><strong>Password Baru</strong></label><input class="form-control" type="password" name="newpassword" required="" minlength="8" maxlength="24" pattern="^[a-zA-Z0-9]+$"><small class="d-xl-flex justify-content-xl-end"
                                                                                                                                                                                                                                                                style="color: rgba(0,0,0,0.75);font-size: 10px;">Panjang 8 - 24 huruf dan/atau angka.</small></div>
                                    </div>
                                    <div class="col"></div>
                                </div>
                                <div class="form-group"><button class="btn btn-primary btn-sm" type="submit">Simpan</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>

@endsection

@section('in-script')

    $(document).ready(function() {
        // todo
    });

@endsection
