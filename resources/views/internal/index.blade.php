@extends('internal.layout')

@section('content')

	<div class="container-fluid" style="min-height: 690px;">
        <div class="row">
        	<div class="col-md-12" style="padding-bottom: 30px;">
        		<div class="card-body">
        			<h2>Permohonan</h2>
        		</div>
        	</div>
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-body">
                        <div class="card-body table-full-width table-responsive">
                        	<table id="example" class="table table-striped table-bordered" style="width:100%">
						        <thead>
						            <tr>
						            	<th>No </th>
						                <th>Nama</th>
						                <!-- <th>Nama Perusahaan</th> -->
						                <!-- <th>Nama Pengurus</th> -->
						                <th>Kode</th>
						                <th>Tenggal Pembuatan</th>
						                <th>Menu</th>
						            </tr>
						        </thead>
						        <tbody>
						        	@foreach($apps as $a)
							            <tr>
							                <td>{{ $loop->iteration }}</td>
							                <td>{{ $a->nama }}</td>
							                <td>#{{ chr(intval($a['created_at']->format('Y'))-2020+65) }}{{ chr(intval($a['created_at']->format('m'))-1+65) }}{{ sprintf("%03d", $a['id']) }}</td>
							                <td>{{ $a['created_at']->format('d M Y') }}</td>
							                <td>
							                	<a href="/prosses/{{ encrypt($a->id) }}" type="button" class="btn btn-primary">Prosses</a>
							                </td>
							            </tr>
						            @endforeach
						        </tbody>
						        <tfoot>
						            <tr>
						            	<th>No </th>
						                <th>Nama</th>
						                <!-- <th>Nama Perusahaan</th> -->
						                <!-- <th>Nama Pengurus</th> -->
						                <th>Kode</th>
						                <th>Tenggal Pembuatan</th>
						                <th>Menu</th>
						            </tr>
						        </tfoot>
                        	</table>
                    	</div>
                	</div>
                </div>
            </div>
		</div>
	</div>

@endsection

@section('in-style')



@endsection

@section('in-script')

	$(document).ready(function () {
	    $('#example').DataTable();
	});

@endsection