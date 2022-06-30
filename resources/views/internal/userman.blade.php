@extends('internal.layout')

@section('content')

                    <div class="row">
                        <div class="col"></div>
                        <div class="col-8 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dialogModal">User Baru</button>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col"></div>
                        <div class="col-8">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th width="40%">Nama</th>
                                    <th width="40%">Email</th>
                                    <th width="20%">Peran</th>
                                </tr>
                                </thead>
                                <tbody>
@foreach($data['user'] as $u)
                                <tr>
                                    <td>{{ $u['nama'] }}</td>
                                    <td>{{ $u['email'] }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button id="USER{{ $u['id'] }}" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ $u['peran']['nama'] }}
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
@foreach($data['peran'] as $p)
                                                <a class="dropdown-item" href="javascript:updateRole({{ $u['id'] }}, '{{ $p['posisi'] }}')">{{ $p['nama'] }}</a>
@endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
@endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col">&nbsp;</div>
                    </div>


                    <div class="modal fade" id="dialogModal" tabindex="-1" role="dialog" aria-labelledby="dialogModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">User Baru</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="formUser" action="/manage/user/create" method="post">
                                        @CSRF
                                        <input type="hidden" name="peran" value="">
                                        <div class="form-group">
                                            <label for="nama" class="col-form-label">Nama:</label>
                                            <input type="text" class="form-control" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="peran" class="col-form-label">Peran:</label>
                                            <div class="dropdown">
                                                <button id="NEWUSER" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    - pilih peran -
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
@foreach($data['peran'] as $p)
                                                        <a class="dropdown-item" href="javascript:updateFormRole('{{ $p['posisi'] }}', '{{ $p['nama'] }}')">{{ $p['nama'] }}</a>
@endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button id="submission" type="button" class="btn btn-primary" disabled>Simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection

@section('links')
    <link rel="stylesheet" href="/assets/css/dataTables.bootstrap4.min.css">
@endsection

@section('scripts')
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
@endsection

@section('in-script')

    function updateFormRole(prn, peran) {
        $('input[name="peran"]').val(prn);
        $('#NEWUSER').text(peran);
        $('#submission').removeAttr("disabled");
    }

    function updateRole(uid, prn) {
        $.post('/update/role', {_token: "{{ csrf_token() }}", uid: uid, prn: prn}, function(response) {
            if (response.error === 0) {
                $('#USER'+response.uid).text(response.peran);
            }
        });
    };

    $(document).ready(function() {
        $('#datatable').DataTable({
            searching: false,
            info: false
        });

        $('#dialogModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);
        });

        $('#submission').on('click', function (event) {
            $('#formUser').submit();
            return false;
        });
    });

@endsection
