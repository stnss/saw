@extends('layout')

@section('js')
<script src="{{asset('assets/plugin/semantic/semantic.min.js')}}"></script>
<script src="{{asset('assets/plugins/datatables/js/jquery.datatables.min.js')}}"></script>
@endsection

@section('css')
<link href="{{asset('assets/plugins/datatables/css/jquery.datatables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('assets/plugins/semantic/semantic.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">
            <a href='/'>Dashboard</a>
            <i class="fa fa-angle-right"></i>
            <?php
                date_default_timezone_set("Asia/Bangkok");

                if(date("m") >= 5){
                    $year = date("Y");
                    $nextYear = $year+1;
                    $semester = "Ganjil";
                } else {
                    $year = date("Y")-1;
                    $nextYear = $year+1;
                    $semester = "Genap";
                }
            ?>
            Guru Terbaik Tahun {{$year.'/'.$nextYear}} Semester {{$semester}}
        </h3>
    </div>
</div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <h3><u>Hasil Normalisasi</u></h3>
                    <br />
                    <table id="pkriteria" class="table table-bordered" style="width:50%; clear: both; text-align: center">
                        <thead>
                            <tr style="background-color: #f7f7f7; font-weight: bold">
                                <th rowspan="2">Guru</th>
                                <th colspan="{{Count($data['normalisasi'])}}">Kriteria</th>
                            </tr>
                            <tr>
                                @foreach ($data['normalisasi'] as $key => $item)
                                    @foreach ($item as $key => $val)
                                        <th>{{$key}}</th>
                                    @endforeach
                                    @break
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['normalisasi'] as $key => $item)
                                <tr>
                                    <td>{{$key}}</td>
                                    @foreach ($item as $val)
                                        <td>{{$val}}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body">
                    <h3><u>Ranking Guru</u></h3>
                    <br />
                    <table id="pkriteria" class="table table-bordered" style="width:50%; clear: both">
                        <thead>
                            <tr style="background-color: #f7f7f7; font-weight: bold">
                                <th style="text-cen">Peringkat</th>
                                <th>Guru</th>
                                @foreach ($data['hasil'] as $key => $item)
                                    @foreach ($item as $key => $val)
                                        <th>{{$key}}</th>
                                    @endforeach
                                    @break
                                @endforeach
                                <th>Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $rank = 1; ?>
                            @foreach ($data['hasil'] as $key => $item)
                                <?php $sum = 0; ?>
                                <tr>
                                    @if ($rank === 1)
                                        <td>
                                            <div class="ui teal ribbon label">{{$rank}}#</div>
                                        </td>
                                    @else
                                        <td>{{$rank}}#</td>
                                    @endif

                                    <td>{{$key}}</td>
                                    @foreach ($item as $val)
                                        <td>{{$val}}</td>
                                        <?php $sum += $val; ?>
                                    @endforeach
                                    <td>{{$sum}}</td>
                                </tr>
                                <?php $rank++; ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
@endsection
