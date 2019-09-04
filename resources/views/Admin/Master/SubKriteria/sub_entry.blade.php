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
                        {{ Form::open(['action' => 'SubKriteriaController@store', 'method' => 'POST']) }}
                            {{csrf_field()}}
                            <div class="form-group">
                                {{Form::label('title_nama', 'Nama Sub Kriteria')}}
                                {{Form::text('nama', '', ['class' => 'form-control', 'id' => 'nama_guru', 'placeholder' => 'Nama Kriteria', 'onkeydown' => 'isCharacterKey(event)'])}}
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    @error('kriteria')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{Form::label('title_bobot', 'Nama Kriteria')}}
                                <select class="form-control" name="kriteria">
                                    <option value="">Pilih Kriteria</option>
                                    @foreach ($kriteria as $item)
                                        <option value="{{$item->kd_kriteria}}">{{$item->nama_kriteria}}</option>
                                    @endforeach
                                </select>
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
