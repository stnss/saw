@extends('layout')

{{-- Start Content --}}
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Edit Data kriteria</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Edit Data kriteria</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['action' => ['KriteriaController@update', $data->kd_kriteria], 'method' => 'POST']) }}
                            <div class="form-group">
                                <div class="col-sm-9">
                                    @error('nis')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-sm-3"></div>
                                {{Form::label('title_nip', 'Kode Kriteria')}}
                                {{Form::text('kd', $data->kd_kriteria, ['class' => 'form-control', 'id' => 'nip_kriteria', 'placeholder' => 'Kode Kriteria', 'onkeydown' => 'isNumberKey(event)', 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_nama', 'Nama Kriteria')}}
                                {{Form::text('nama', $data->nama_kriteria, ['class' => 'form-control', 'id' => 'nama_kriteria', 'placeholder' => 'Nama Kriteria', 'onkeydown' => 'isCharacterKey(event)'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_bobot', 'Bobot Kriteria')}}
                                {{Form::number('bobot', $data->bobot_kriteria, ['class' => 'form-control', 'id' => 'bobot_kriteria', 'placeholder' => 'Bobot Kriteria', 'onkeydown' => 'isCharacterKey(event)', 'step' => '0.1', 'min' => 0, 'max' => 1])}}
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
