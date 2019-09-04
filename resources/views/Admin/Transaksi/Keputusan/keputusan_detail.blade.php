@extends('layout')

{{-- Start Content --}}
@section('content')
@include('Include.message')

<div class="page-title">
    <h3 class="breadcrumb-header">Cetak Keputusan Guru Terbaik</h3>
</div>
<div id="main-wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h2 class="panel-title">Cetak Keputusan Guru Terbaik <span id="thn">{{$tahun}}</span> Semester <span id="smt">{{$semester}}</span></h2>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                        <table id="guru" class="guru display responsive nowrap" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th width="10%">Kode Guru</th>
                                    <th>Nama Guru</th>
                                    <th>Nilai Hasil</th>
                                    <th><center>Action</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item2)
                                    <tr>
                                        <td>{{$item2->kd_guru}}</td>
                                        <td>{{$item2->nama_guru}}</td>
                                        <td>{{$item2->nilai_hasil}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-primary" id="cetak">Print</button>
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
<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet">
<link href="{{asset('assets/plugins/semantic/semantic.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
{{-- End CSS --}}

{{-- Start JS --}}
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
<script src="{{asset('assets/plugin/semantic/semantic.min.js')}}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        var data;
        var table = $('#guru').DataTable({
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   3
            } ],
            select: {
                style:    'os',
                selector: 'td:last-child'
            },
            order: [[ 1, 'asc' ]]
        });

        $('#cetak').on('click', function(){
            var tblData = table.rows('.selected').data();
            $.each(tblData, function(i, val) {
                data = tblData[i];
            });

            $.ajax({
                type: 'POST',
                url: "/keputusan/s",
                data: {'kd' : data[0], 'nama' : data[1], 'nilai' : data[2], 'tahun': $('#thn').text(), 'semester': $('#smt').text()},
                success: function(ret){
                    window.location.href = 'keputusan/cetak';
                }
            });
            // $.ajax({
            //     type: 'POST',
            //     url: '/keputusan/cetak',
            //     data: {'kd' : data[0], 'nama' : data[1], 'nilai' : data[2], 'tahun': $('#thn').text(), 'semester': $('#smt').text()}
                // success: function(ret){
                //     console.log(ret)
                // },
                // error: function(error){
                //     console.log(error)
                // }
            // })
        });

    });
</script>
@endsection
{{-- End JS --}}
