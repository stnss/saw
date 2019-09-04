@extends('layout')

{{-- Start Content --}}
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Edit Data Guru</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Edit Data Guru</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['action' => ['GuruController@update', $data->kd_guru], 'method' => 'POST']) }}
                            <div class="form-group">
                                <div class="col-sm-9">
                                    @error('nis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3"></div>
                                {{Form::label('title_nip', 'Kode Guru')}}
                                {{Form::text('nip', $data->kd_guru, ['class' => 'form-control', 'id' => 'nip_guru', 'placeholder' => 'Kode Guru', 'onkeydown' => 'isNumberKey(event)', 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_nama', 'Nama Guru')}}
                                {{Form::text('nama', $data->nama_guru, ['class' => 'form-control', 'id' => 'nama_guru', 'placeholder' => 'Nama Guru', 'onkeydown' => 'isCharacterKey(event)'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_jenkel', 'Jenis Kelamin')}}
                                @if ($data->jenkel == "L")
                                    <label class="radio-inline">{{Form::radio('jenkel', 'L', true)}} Laki-Laki</label>
                                    <label class="radio-inline">{{Form::radio('jenkel', 'P', false)}} Perempuan</label>
                                @else
                                    <label class="radio-inline">{{Form::radio('jenkel', 'L', false)}} Laki-Laki</label>
                                    <label class="radio-inline">{{Form::radio('jenkel', 'P', true)}} Perempuan</label>
                                @endif
                            </div>
                            <div class="form-group">
                                {{Form::label('title_telp', 'No. Telpon')}}
                                {{Form::text('telp', $data->no_telp, ['class' => 'form-control', 'id' => 'telp_guru', 'placeholder' => 'Telpon Guru', 'onkeydown' => 'isNumberKey(event)'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_alamat', 'Alamat')}}
                                {{Form::text('alamat', $data->alamat, ['class' => 'form-control', 'id' => 'alamat_guru', 'placeholder' => 'Alamat'])}}
                            </div>
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::button('<i class="fa fa-save"></i>&nbsp;&nbsp;Ubah', ['type' => 'submit', 'class' => 'btn btn-primary'])}}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div><!-- Row -->
</div><!-- Main Wrapper -->
@endsection
{{-- End Content --}}

{{-- Start CSS --}}
@section('css')

@endsection
{{-- End CSS --}}

{{-- Start JS --}}
@section('js')

@endsection
{{-- End JS --}}
