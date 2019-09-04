@extends('layout')

{{-- Start Content --}}
@section('content')
@include('Include.message')

<div class="page-title">
    <h3 class="breadcrumb-header">List Data Guru</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">List Guru</h4>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table id="guru" class="display responsive nowrap" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th width="10%">Kode Guru</th>
                                    <th>Nama Guru</th>
                                    <th width="5%">Jenis Kelasmin</th>
                                    <th width="10%">No Telpon</th>
                                    <th>Alamat</th>
                                    <th width="15%" style="text-align:center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $key => $item)
                                    <tr>
                                        <td>{{$item->kd_guru}}</td>
                                        <td>{{$item->nama_guru}}</td>
                                        <td>{{($item->jenkel == 'L') ? "Laki-Laki" : "Perempuan"}}</td>
                                        <td>{{$item->no_telp}}</td>
                                        <td>{{$item->alamat}}</td>
                                        <td style="text-align:center">
                                            {{Form::open(['action' => ['GuruController@destroy', $item->kd_guru], 'method' => 'POST'])}}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::button('<i class="fa fa-trash-o"></i>', ['type' => 'submit', 'class' => 'btn btn-danger'])}}

                                                <a href="/guru/{{$item->kd_guru}}/edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                            {{Form::close()}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <a href="/guru/create" class="btn btn-primary"><span class="fa fa-plus"></span>&nbsp;Tambah Guru</a>
                    </div>
                </div>
            </div>
        </div><!-- Row -->
</div><!-- Main Wrapper -->
@endsection
{{-- End Content --}}

{{-- Start CSS --}}
@section('css')
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
@endsection
{{-- End CSS --}}

{{-- Start JS --}}
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
        $('#guru').DataTable();
    });
</script>
@endsection
{{-- End JS --}}
