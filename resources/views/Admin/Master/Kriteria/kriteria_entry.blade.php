@extends('layout')

{{-- Start Content --}}
@section('content')
<div class="page-title">
    <h3 class="breadcrumb-header">Entry Data Kriteria</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title">Entry Data Kriteria</h4>
                    </div>
                    <div class="panel-body">
                        {{ Form::open(['action' => 'KriteriaController@store', 'method' => 'POST']) }}
                            {{csrf_field()}}
                            <div class="form-group">
                                {{Form::label('title_nama', 'Nama Kriteria')}}
                                {{Form::text('nama', '', ['class' => 'form-control', 'id' => 'nama_guru', 'placeholder' => 'Nama Kriteria', 'onkeydown' => 'isCharacterKey(event)'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('title_bobot', 'Bobot Kriteria')}}
                                {{Form::number('bobot', '', ['class' => 'form-control', 'id' => 'nama_guru', 'placeholder' => 'Bobot Kriteria', 'onkeydown' => 'isCharacterKey(event)', 'step' => '0.1', 'min' => 0, 'max' => 1])}}
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
