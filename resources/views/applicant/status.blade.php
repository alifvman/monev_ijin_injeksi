@extends('applicant.layout')

@section('content')
    <section class="page-section clearfix" style="margin: 0px 0px;margin-top: 0px;margin-bottom: 15px;">
        <div class="container">
            <div class="intro"></div>
            <p class="text-right mb-0" style="color: rgb(255,255,255);font-family: Raleway, sans-serif;padding-right: 15px;font-size: 11px;padding-bottom: 15px;margin-bottom: 0px;background-color: rgba(150,230,150,0.15);padding-top: 15px;"><span style="padding-top: 3px;border-bottom: 2px solid RGBA(255,255,255,0.25);font-size: 11px; text-transform: uppercase">{{ $USER['NAMA'] }}</span> &nbsp; &nbsp; <a class="btn btn-primary d-inline-block mx-auto btn-xl" role="button" href="/account/logout" style="padding: 6px 16px;font-family: Lora, serif;">Logout</a><br></p>
        </div>
    </section>
    <section class="page-section cta" style="background-color: rgba(150,230,150,0);padding: 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">INFORMASI PENGAJUAN</span><span class="section-heading-lower">PERMOHONAN</span></h2>
                        <p class="text-justify mb-0" style="font-family: Raleway, sans-serif;font-size: 16px;">Berikut ini adalah informasi permohonan perizinan&nbsp;pengendalian pencemaran air yang Anda ajukan sebelumnya.<br></p>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">STATUS PERMOHONAN :</label>
                                        <div class="form-row">
                                            <div class="col-12"><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" readonly="" value="{{ $data['status'] }}" name="status"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
@if ($stage<0)
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NAMA PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2nama" required="" readonly="" value="{{ $data['nama'] }}"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <form style="margin-top: 15px;" action="/application/cancel" method="post">
                                @CSRF
                                <input type="hidden" name="id" value="{{ $data['id'] }}">
                                <section id="cancel" class="text-right"><button class="btn btn-primary d-inline-block mx-auto btn-xl" type="submit" style="padding: 12px 16px;">Batalkan Permohonan</button></section>
                            </form>
@else
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">JENIS PERMOHONAN :</label>
                                        <div class="form-row">
                                            <div class="col-4"><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="permohonan" required="" readonly="" value=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-left" style="padding: 0px 15px;"><span><br>Formulir 1 - Keterangan Tentang Pemohon<br></span></div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-8 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NAMA PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1nama"
                                                    pattern="^[a-zA-Z ]+$" required="" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">JABATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" required=""
                                                    pattern="^[a-zA-Z ]+$" name="f1jabatan" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1alamat"
                                                    required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f1kelurahan" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1kecamatan"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f1kota" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1provinsi"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1kodepos"
                                                    pattern="^[0-9]*$" minlength="4" maxlength="6" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NOMOR TELEPON PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f1telp" inputmode="tel" required="" readonly=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">FAKSIMILE :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="tel"
                                                    name="f1faks" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1email"
                                                    required="" inputmode="email" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-left" style="padding: 0px 15px;"><span><br>Formulir 2 - Keterangan Tentang Perusahaan<br></span></div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NAMA PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2nama"
                                                    required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2alamat" required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kelurahan" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kecamatan"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kota" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2provinsi"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kodepos"
                                                    minlength="4" maxlength="6" pattern="^[0-9]*$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NOMOR TELEPON PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    required="" name="f2telp" inputmode="tel" readonly=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">FAKSIMILE :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="tel"
                                                    name="f2faks" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="email"
                                                    name="f2email" required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KEGIATAN/USAHA PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                            name="f2kegiatan" required="" readonly=""></div>
                                    <div class="col text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT KEGIATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" required=""
                                            name="f2alamatkegiatan" readonly=""></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN KEGIATAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kelurahankegiatan" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kecamatankegiatan"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN KEGIATAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kotakegiatan" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2provinsikegiatan"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kodeposkegiatan"
                                                    pattern="^[0-9]*$" minlength="4" maxlength="6" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">AKTA PENDIRIAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2akta" required="" readonly=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">NOMOR PERSETUJUAN PRINSIP :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2npp" required="" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">NOMOR POKOK WAJIB PAJAK :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2npwp" required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">PRODUKSI PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2produksi" required="" readonly=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KAPASITAS PRODUKSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kapasitas" required="" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KONTAK NAMA &amp; NOMOR TELEPON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kontak" required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col text-left" style="padding: 0px 15px;"><span><br>Formulir 3 - Identitas Pengurus Permohonan Izin (Anda)<br></span></div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-8 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NAMA PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3nama"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">JABATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3jabatan"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3alamat"
                                                    required="" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f3kelurahan" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3kecamatan"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f3kota" required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3provinsi"
                                                    required="" pattern="^[a-zA-Z ]+$" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3kodepos"
                                                    maxlength="6" minlength="4" pattern="^[0-9]*$" readonly=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NOMOR TELEPON PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    inputmode="tel" name="f3telp" required="" readonly=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">FAKSIMILE :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3faks"
                                                    inputmode="tel" required="" readonly=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" readonly=""
                                                    value="youremail@domain" name="f3email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


@php
    $num = 0; $grp = '';
    $ids = array_column($data['dokumen'], 'dokumen_id');
@endphp
@foreach ($dokumen as $dok)
@php
    if ($dok['grup'] != $grp) {
            if ($grp == 'A*') echo '</div>';
            $num = 0;
            $grp = $dok['grup'];
            switch ($grp) {
            case 'A*':
                echo '<div id="DOC_A"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Administrasi<br></span></div></div>';
                break;
            case 'TB':
            	if ($data['jenis'] == 'B')
                  echo '<div id="DOC_B"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Teknis Permohonan Baru<br></span></div></div>';
                break;
            case 'TU':
            	if ($data['jenis'] == 'U')
                  echo '<div id="DOC_U"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Teknis Permohonan Perubahan<br></span></div></div>';
                break;
            case 'TP':
            	if ($data['jenis'] == 'P')
                  echo '<div id="DOC_P"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Teknis Permohonan Perpanjangan<br></span></div></div>';
                break;
            }
        }
@endphp
@if (in_array($dok['id'], $ids))
@php
    $num++;
@endphp
    <div class="form-group">
        <div class="form-row">
            <div class="col">
                <div class="form-row">
                    <div class="col-12 text-left d-xl-flex align-items-xl-center">
                        <label class="col-form-label" style="font-family: Raleway, sans-serif;font-size: 12px;margin-left: 10px;font-weight:bold;">
                            {{ $num  }}. <a href="/download/appdoc/{{ $data['id'] }}:{{ $dok['id'] }}" style="color:black;">{{ $dok['nama'] }}</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
@php
echo "</div><!--the.final.closure-->";
@endphp

                    </div>


@endif

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('in-style')
.form-group div input[type="text"] {
    padding: 0px 10px;
    border: 0px;
    margin: 0px;
    border-bottom: 1px dotted #999;
    border-radius: 0px;
    font-weight: bold;
    position: relative;
    top: -15px;
    background-color: RGBA(0, 0, 0, 0);
}

.form-group {
    margin: 0px;
}
@endsection

@section('in-script')

    function init() {
        $('[name="permohonan"]').val("{{ $data['permohonan'] }}");
@if (is_array($data['f1']))
@foreach ($data['f1'] as $key => $value)
@if (!in_array($key, array('id', 'flag', 'created_at', 'updated_at')) and ($value!=''))
        $('[name="f1{{ $key }}"]').val("{{ $value }}");
@endif
@endforeach
@endif
@if (is_array($data['f2']))
@foreach ($data['f2'] as $key => $value)
@if (!in_array($key, array('id', 'flag', 'created_at', 'updated_at')) and ($value!=''))
        $('[name="f2{{ $key }}"]').val("{{ $value }}");
@endif
@endforeach
@endif
@if (is_array($data['f3']))
@foreach ($data['f3'] as $key => $value)
@if (!in_array($key, array('id', 'flag', 'created_at', 'updated_at')) and ($value!=''))
        $('[name="f3{{ $key }}"]').val("{{ $value }}");
@endif
@endforeach
@endif
    }


    $(document).ready(function() {
        init();
    });

@endsection
