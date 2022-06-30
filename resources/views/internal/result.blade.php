@extends('internal.layout')

@section('content')

                    <div class="row">
                        <div class="col-2">
                            <div class="card mb-4">
                                <div class="card-header py-3">
                                    <h6 class="text-primary font-weight-bold m-0">
@if(count($apps)==0)
    Tidak Ada
@else
    <span id="counter">{{ count($apps) }}</span>
@endif
                                        Hasil Pencarian
                                    </h6>
                                </div>
                                <div class="card-body py-0 bg-dark" style="padding-left: 0px;padding-right: 0px;">
@foreach($apps as $a)
                                    <a id="APP{{ $a['id'] }}" class="d-flex align-items-xl-center apps" href="javascript:showApp({{ $a['id'] }})" style="padding:15px;width: 100%;color: RGBA(255,255,255,0.75);font-size: 11px;border-top: 1px dotted RGBA(255,255,255,0.25);">
                                        <div><i class="far fa-file-alt" style="margin-right: 10px;font-size: 18px;"></i></div>
                                        <div style="height: 27px;width: 100%;">
                                            <div class="row">
                                                <div class="col"><span>{{ $a['nama'] }}</span></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <p style="font-size: 8px;">#{{ chr(intval($a['created_at']->format('Y'))-2020+65) }}{{ chr(intval($a['created_at']->format('m'))-1+65) }}{{ sprintf("%03d", $a['id']) }}</p>
                                                </div>
                                                <div class="col text-right">
                                                    <p style="font-size: 8px;text-transform: uppercase;">{{ $a['created_at']->format('d M Y') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
@endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div id="application" class="card mb-4">
                                <div class="card-body py-3">
                                    <ul id="breadcrumb" class="breadcrumb">
                                        <li><a href="javascript:void(0);" style="width:30px"><span id="loader" class="spinner-border d-none" style="color:black; width:.75rem; height:.75rem;" role="status" aria-hidden="true"></span>&nbsp;</a></li>
@foreach ($STAGES as $stage)
                                        <li id="BC{{ $stage['stage'] }}"><a href="javascript:void(0);"  data-toggle="tooltip" data-html="true" ii-original-title="{{ $stage['nama'] }}" title="{{ $stage['nama'] }}">{{ $stage['bread'] }}</a></li>
@endforeach
                                    </ul>

                                    <section class="page-section cta">
                                        <div class="row">
                                            <div class="col">
                                                <div class="cta-inner text-center rounded">

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
                                                                    <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" inputmode="email" name="f2email"
                                                                                                                                                                                                        required="" readonly=""></div>
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
                                                                    <div class="col text-left"><label style="margin-left: 10px;font-size: 11px;font-family: Raleway, sans-serif;">EMAIL :</label><input class="form-control" type="text" style="font-family: Raleway, sans-serif;font-size: 14px;" name="f3email" readonly=""
                                                                                                                                                                                                        value="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div id="DOCS"></div>
                                    </section>

                                </div>
                                <div id="action" class="card-footer d-none">
                                    <div class="form-row">
                                        <div id="NOTES"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('in-style')
.form-group div input[type="text"] {
    padding: 0px 10px;
    border: 0px;
    margin: 0px;
    border-bottom: 1px dotted #ddd;
    border-radius: 0px;
    font-weight: bold;
    position: relative;
    top: -15px;
    background-color: RGBA(0, 0, 0, 0);
}

.form-group {
    margin: 0px;
}

.breadcrumb {
    padding: 0px;
	background: #D4D4D4;
	list-style: none;
	overflow: hidden;
}
.breadcrumb>li+li:before {
	padding: 0;
}
.breadcrumb li {
	float: left;
}
.breadcrumb li.active a {
	background: brown;                   /* fallback color */
	background: #ffc107 ;
}
.breadcrumb li.completed a {
	background: brown;                   /* fallback color */
	background: hsla(153, 57%, 51%, 1);
}
.breadcrumb li.active a:after {
	border-left: 30px solid #ffc107 ;
}
.breadcrumb li.completed a:after {
	border-left: 30px solid hsla(153, 57%, 51%, 1);
}

.breadcrumb li a {
	color: white;
	text-decoration: none;
	padding: 10px 0 10px 45px;
	position: relative;
	display: block;
	float: left;
    font-size: 11px;
    text-transform: uppercase;
}
.breadcrumb li a:after {
	content: " ";
	display: block;
	width: 0;
	height: 0;
	border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
	border-bottom: 50px solid transparent;
	border-left: 30px solid hsla(0, 0%, 83%, 1);
	position: absolute;
	top: 50%;
	margin-top: -50px;
	left: 100%;
	z-index: 2;
}
.breadcrumb li a:before {
	content: " ";
	display: block;
	width: 0;
	height: 0;
	border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
	border-bottom: 50px solid transparent;
	border-left: 30px solid white;
	position: absolute;
	top: 50%;
	margin-top: -50px;
	margin-left: 1px;
	left: 100%;
	z-index: 1;
}
.breadcrumb li:first-child a {
	padding-left: 15px;
}
.breadcrumb li a:hover { background: #ffc107  ; }
.breadcrumb li a:hover:after { border-left-color: #ffc107   !important; }

.bd-example-modal-lg .modal-dialog{
    display: table;
    position: relative;
    margin: 0 auto;
    top: calc(50% - 24px);
}

.bd-example-modal-lg .modal-dialog .modal-content{
    background-color: transparent;
    border: none;
}

#application {
    position: relative;
}
@endsection

@section('in-script')
    let app_id = 0;
    let next_stage = 0;
    let reroute_stage = 0;

    function docLine(index, link, label) {
        let html = '<div class="form-group"><div class="form-row"><div class="col"><div class="form-row"><span class="col-12 text-left d-xl-flex align-items-xl-center"><span style="font-size: 12px;padding-left: 10px;">'
                        + index + ',</span> <label class="col-form-label" style="font-family: Raleway, sans-serif;font-size: 12px;margin-left: 10px;font-weight:bold;"><a href="/download/appdoc/' + link + '" style="color:black;">' + label + '</a>'
                 + '</label></div></div></div></div></div>';
        return html;
    }

    function docHeader(title) {
        let html = '<div class="form-row"><div class="col text-left" style="padding: 0px 15px;"><span><br>' + title + '<br></span></div></div>';
        return html;
    }

    function resetForm() {
        app_id = 0;
        next_stage = 0;
        reroute_stage = 0;
        $('[id^=BC]').each(function() { $(this).removeClass(); });
        $('input[name^=f1]').each(function() { $(this).val(''); });
        $('input[name^=f2]').each(function() { $(this).val(''); });
        $('input[name^=f3]').each(function() { $(this).val(''); });
        $('#DOCS').html('');
        $('#NOTES').html('');
        $('#action').addClass('d-none');
    }

    function enableForm() {
        $('#action').removeClass('d-none');
    }

    function processApp(action) {
//        console.log('app_id: '+app_id+' action: '+action+' next_stage: '+next_stage+' reroute_stage: '+reroute_stage+' catatan: '+$('[name="catatan"]').val());
        let ra = (action=='n' ? next_stage : reroute_stage);
        let nt = $('[name="catatan"]').val();
        $.post('/application/update', {_token: "{{ csrf_token() }}", id: app_id, ra: ra, nt: nt}, function(response) {
            if (response.error === 0) {
                let c = parseInt($('#counter').text())-1;
                if (c>0)
                    $('#counter').text(c);
                else
                    $('#counter').text('Tidak Ada');
                $('#APP'+app_id).remove();
                resetForm();
            } else alert('Gagal melakukan update, silakan hubungi Administrator.');
        });
    }

    function showApp(id) {
        resetForm();
        $('[id^=APP]').each(function() { $(this).removeClass('bg-secondary'); });
        $('#loader').removeClass('d-none');
        $.post('/application/detail', {_token: "{{ csrf_token() }}", id: id, mode: 'search'}, function(response) {
            if (response.error === 0) {
                let d = response.data;


                jQuery.each(d.staging, function(i, t) {
                    let e = $('#BC'+i+' a');
                    e.attr('data-original-title', e.attr('ii-original-title') + "<br>" + t);
                });


                $('#APP'+id).addClass('bg-secondary');
                app_id = d.id;
                $('[name="permohonan"').val(d.permohonan);
                ['f1', 'f2', 'f3'].forEach(function(p) {
                    let i = d[p];
                    for(k in i) $('[name="'+p+k+'"]').val(i[k]);
                });
                let a = d.action;
                $('#catatan').text(a.nama);
                $('#next').text(a.next_label);
                next_stage = a.next;
                reroute_stage = a.reroute;
                if (a.reroute>0) {
                    $('#reroute').text(a.reroute_label);
                    $('#reroute').removeClass('d-none');
                } else $('#reroute').addClass('d-none');
                $('[id^=BC]').each(function() {
                    let s = parseInt($(this).attr('id').substr(2));
                    if (s < d['stage']) $(this).addClass('completed');
                    if (s == d['stage']) $(this).addClass('active');
                });
                n = '';
                let g = '';
                let h = '';
                let j = 0;
                d.dokumen.forEach(function(i) {
                    if (g != i.grup) {
                        j = 0;
                        g = i.grup;
                        switch (g) {
                            case 'A*':
                                h += docHeader('Dokumen Persyaratan Administrasi');
                                break;
                            case 'TB':
                                h += docHeader('Dokumen Persyaratan Teknis Permohonan Baru');
                                break;
                            case 'TU':
                                h += docHeader('Dokumen Persyaratan Teknis Permohonan Perubahan');
                                break;
                            case 'TP':
                                h += docHeader('Dokumen Persyaratan Teknis Permohonan Perpanjangan');
                                break;
                            }
                    }
                    h += docLine(++j, i.link, i.nama);
                });
                $('#DOCS').html(h);
                d.tracking.forEach(function(i) {
                    n += '<li>Catatan ' + i.peran.nama + ': ' + i.note + '</li>';
                });
                if (n!='')  n = '<ul style="padding-left: 15px; list-style: square; font-size: 12px">'+n+'</ul>';
                $('#NOTES').html(n);
                enableForm();
            };
            $('#loader').addClass('d-none');
        });
    }

//    $(document).ready(function() {
//        $('input').each(function() { if ($(this).attr('name')!='catatan') $(this).attr('disabled', ''); });
//        $('[data-toggle="tooltip"]').tooltip();
//    });

    $(document).ready(function() {
        $('input[name^=f1]').each(function() { $(this).attr('disabled', ''); });
        $('input[name^=f2]').each(function() { $(this).attr('disabled', ''); });
        $('input[name^=f3]').each(function() { $(this).attr('disabled', ''); });
        $('[data-toggle="tooltip"]').tooltip();
    }),
    function(e) {
        "use strict";
        e("#sidebarToggle, #sidebarToggleTop").on("click", function(o) {
            e("body").toggleClass("sidebar-toggled"), e(".sidebar").toggleClass("toggled"), e(".sidebar").hasClass("toggled") && e(".sidebar .collapse").collapse("hide")
        }), e(window).resize(function() {
            e(window).width() < 768 && e(".sidebar .collapse").collapse("hide")
        }), e("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function(o) {
            if (e(window).width() > 768) {
                var t = o.originalEvent,
                    l = t.wheelDelta || -t.detail;
                this.scrollTop += 30 * (l < 0 ? 1 : -1), o.preventDefault()
            }
        }), e(document).on("scroll", function() {
            e(this).scrollTop() > 100 ? e(".scroll-to-top").fadeIn() : e(".scroll-to-top").fadeOut()
        }), e(document).on("click", "a.scroll-to-top", function(o) {
            var t = e(this);
            e("html, body").stop().animate({
                scrollTop: e(t.attr("href")).offset().top
            }, 1e3, "easeInOutExpo"), o.preventDefault()
        })
    }(jQuery);
@endsection
