@extends('applicant.layout')

@section('content')
    <section class="page-section clearfix" style="margin: 0px 0px;margin-top: 0px;margin-bottom: 15px;">
        <div class="container">
            <p class="text-right mb-0" style="color: rgb(255,255,255);font-family: Raleway, sans-serif;padding-right: 15px;font-size: 11px;padding-bottom: 15px;margin-bottom: 0px;background-color: rgba(150,230,150,0.15);padding-top: 15px;"><span style="padding-top: 3px;border-bottom: 2px solid RGBA(255,255,255,0.25);font-size: 11px; text-transform: uppercase">{{ $USER['NAMA'] }}</span> &nbsp; &nbsp; <a class="btn btn-primary d-inline-block mx-auto btn-xl" role="button" href="/account/logout" style="padding: 6px 16px;font-family: Lora, serif;">Logout</a><br></p>
        </div>
    </section>
    <section class="page-section cta" style="background-color: rgba(150,230,150,0);padding: 40px 0px;">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4"><span class="section-heading-upper">FORM PENGAJUAN</span><span class="section-heading-lower">PERMOHONAN</span></h2>
                        <p class="text-justify mb-0" style="font-family: Raleway, sans-serif;font-size: 16px;">Dalam melakukan pengajuan permohonan perizinan&nbsp;pengendalian pencemaran air, Anda bertindak sebagai pengurus permohonan izin (Formulir 3) bagi pemohon.</p>
                        <form style="margin-top: 15px;" action="/application/submission" method="post" enctype="multipart/form-data">
                            @CSRF
                            <input type="hidden" name="f1id" value="0">
                            <input type="hidden" name="f2id" value="0">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">JENIS PERMOHONAN :</label>
                                        <div class="form-row">
                                            <div class="col-4"><select id="permohonan" class="custom-select" style="padding: 6px 5px;font-family: Raleway, sans-serif;font-size: 14px;" name="permohonan" value="B"><option value="B" selected="">Permohonan Baru</option><option value="U">Perubahan</option><option value="P">Perpanjangan</option></select></div>
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
                                                    pattern="^[a-zA-Z. ]+$" required=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">JABATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" required=""
                                                    pattern="^[a-zA-Z ]+$" name="f1jabatan"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1alamat"
                                                    required=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f1kelurahan" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1kecamatan"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f1kota" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1provinsi"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1kodepos"
                                                    pattern="^[0-9]*$" minlength="4" maxlength="6"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NOMOR TELEPON PEMOHON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f1telp" inputmode="tel" required=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">FAKSIMILE :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="tel"
                                                    name="f1faks"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f1email"
                                                    required="" inputmode="email"></div>
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
                                                    required=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2alamat" required=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kelurahan" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kecamatan"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kota" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2provinsi"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kodepos"
                                                    minlength="4" maxlength="6" pattern="^[0-9]*$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NOMOR TELEPON PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    required="" name="f2telp" inputmode="tel"></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">FAKSIMILE :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="tel"
                                                    name="f2faks"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="email"
                                                    required="" name="f2email"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KEGIATAN/USAHA PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                            name="f2kegiatan" required=""></div>
                                    <div class="col text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT KEGIATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" required=""
                                            name="f2alamatkegiatan"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN KEGIATAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kelurahankegiatan" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kecamatankegiatan"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN KEGIATAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kotakegiatan" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2provinsikegiatan"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f2kodeposkegiatan"
                                                    pattern="^[0-9]*$" minlength="4" maxlength="6"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">AKTA PENDIRIAN PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2akta" required=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">NOMOR PERSETUJUAN PRINSIP :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2npp" required=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">NOMOR POKOK WAJIB PAJAK :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2npwp" required=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">PRODUKSI PERUSAHAAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2produksi" required=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KAPASITAS PRODUKSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kapasitas" required=""></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KONTAK NAMA &amp; NOMOR TELEPON :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f2kontak" required=""></div>
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
                                                    required="" pattern="^[a-zA-Z. ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">JABATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3jabatan"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-12 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">ALAMAT PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3alamat"
                                                    required=""></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-6 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">DESA/KELURAHAN PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f3kelurahan" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KECAMATAN :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3kecamatan"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-5 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">KOTA/KABUPATEN PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    name="f3kota" required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col-5 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">PROVINSI :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3provinsi"
                                                    required="" pattern="^[a-zA-Z ]+$"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">KODE POS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3kodepos"
                                                    maxlength="6" minlength="4" pattern="^[0-9]*$"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-row">
                                            <div class="col-4 text-left"><label style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">NOMOR TELEPON PENGURUS :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;"
                                                    inputmode="tel" name="f3telp" required=""></div>
                                            <div class="col-4 text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">FAKSIMILE :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3faks"
                                                    inputmode="tel"></div>
                                            <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" readonly=""
                                                    disabled="" value="" name="f3email"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>


@php
    $num = 0; $grp = '';
@endphp
@foreach ($dokumen as $dok)
@php
    if ($dok['grup'] != $grp) {
        if ($grp != '') echo '</div>';
        $num = 0;
        $grp = $dok['grup'];
        switch ($grp) {
        case 'A*':
            echo '<div id="DOC_A"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Administrasi<br></span></div></div>';
            break;
        case 'TB':
            echo '<div id="DOC_B" class="d-none"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Teknis Permohonan Baru<br></span></div></div>';
            break;
        case 'TU':
            echo '<div id="DOC_U" class="d-none"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Teknis Permohonan Perubahan<br></span></div></div>';
            break;
        case 'TP':
            echo '<div id="DOC_P" class="d-none"><div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>Dokumen Persyaratan Teknis Permohonan Perpanjangan<br></span></div></div>';
            break;
        }
    }
    $num++;
@endphp
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-row">
                                                <div class="col-6 text-left d-xl-flex align-items-xl-center"><label class="col-form-label" style="font-family: Raleway, sans-serif;font-size: 11px;margin-left: 10px;">{{ $num  }}. {{ $dok['nama'] }} :</label></div>
                                                <div class="col text-left"><input type="file" style="font-family: Raleway, sans-serif;font-size: 11px;width: 100%;" name="dok{{ $dok['id'] }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
@endforeach
@php
    echo "</div><!--the.final.closure-->";
@endphp








                    <button class="btn btn-primary d-inline-block mx-auto btn-xl" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('links')
    <link rel="stylesheet" href="/assets/css/jquery-ui.css">
@endsection

@section('scripts')
    <script src="/assets/js/jquery-ui.min.js"></script>
    <script src="/assets/js/development.js"></script>   // delete this on production
@endsection

@section('in-script')
    let lastDoc = '';

    function updateDocs() {
        if (lastDoc != '')
            $('#'+lastDoc).addClass('d-none');
        lastDoc = 'DOC_' + $("#permohonan").val();
        $('#'+lastDoc).removeClass('d-none');
    }

    function init() {
        updateDocs();
@if (is_array($data['f3']))
@foreach ($data['f3'] as $key => $value)
@if (!in_array($key, array('id', 'flag', 'created_at', 'updated_at')) and ($value!=''))
        $('[name="f3{{ $key }}"]').val("{{ $value }}");
@endif
@endforeach
@endif
    }

    $("#permohonan").on('change', function(e) {
        updateDocs();
    });

    $(document).ready(function() {
//        development.run();  // delete this on production
        init();
    });

    $('[name="f1nama"').autocomplete({
        source: function(request, response) {
            $('[name="f1id"').val(0);
            $.ajax({
                url: "/autocomplete/orang",
                dataType: "jsonp",
                data: { term: request.term },
                success: function(data) { response(data); }
            }); },
        minLength: 2,
        select: function(event, ui) {
            $.post('/data/orang', {_token: "{{ csrf_token() }}", id: ui.item.id}, function(response) {
                if (response.error === 0) {
                    let x = ['flag', 'created_at', 'updated_at'];
                    $.each(response.data, function(key, value){
                        if (x.indexOf(key)==-1) {
                            $('[name="f1'+key+'"]').val(value);
                        }
                    });
                }
            });

        }
    });

    $('[name="f2nama"').autocomplete({
        source: function(request, response) {
            $('[name="f2id"').val(0);
            $.ajax({
                url: "/autocomplete/perusahaan",
                dataType: "jsonp",
                data: { term: request.term },
                success: function(data) { response(data); }
            }); },
        minLength: 2,
        select: function(event, ui) {
            $.post('/data/perusahaan', {_token: "{{ csrf_token() }}", id: ui.item.id}, function(response) {
                if (response.error === 0) {
                    let x = ['flag', 'created_at', 'updated_at'];
                    $.each(response.data, function(key, value){
                        if (x.indexOf(key)==-1) {
                            $('[name="f2'+key+'"]').val(value);
                        }
                    });
                }
            });

        }
    });

@endsection
