@extends('layout')

{{-- Start Content --}}
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Entry Data Guru</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Entry Data Guru</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['action' => 'GuruController@store', 'method' => 'POST']) }}
                            {{csrf_field()}}
                            <div class="form-group">
                                {{Form::label('title_nama', 'Nama Guru')}}
                                {{Form::text('nama', '', ['class' => 'form-control', 'id' => 'nama_guru', 'placeholder' => 'Nama Guru', 'onkeydown' => 'isCharacterKey(event)'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_jenkel', 'Jenis Kelamin')}}
                                <label class="radio-inline">{{Form::radio('jenkel', 'L', true)}} Laki-Laki</label>
                                <label class="radio-inline">{{Form::radio('jenkel', 'P')}} Perempuan</label>
                            </div>
                            <div class="form-group">
                                {{Form::label('title_telp', 'No. Telpon')}}
                                {{Form::text('telp', '', ['class' => 'form-control', 'id' => 'telp_guru', 'placeholder' => 'Telpon Guru', 'onkeydown' => 'isNumberKey(event)'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_alamat', 'Alamat')}}
                                {{Form::text('alamat', '', ['class' => 'form-control', 'id' => 'alamat_guru', 'placeholder' => 'Alamat'])}}
                            </div>
                            {{Form::button('<i class="fa fa-save"></i>&nbsp;&nbsp;Save', ['type' => 'submit', 'class' => 'btn btn-primary'])}}
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
