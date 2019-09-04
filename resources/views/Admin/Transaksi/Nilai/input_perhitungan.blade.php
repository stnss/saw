@extends('layout')

{{-- Content Section --}}
@section('content')
<div class="page-inner">
    <div class="page-title">
        <h3 class="breadcrumb-header">
            <a href='/'>Home</a>
            <i class="fa fa-angle-right"></i>
            Perhitungan
        </h3>
    </div>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                </div>
                <div class="panel-body" style="overflow-x: auto;">
                    <h3><u>Perhitungan</u></h3>
                    <br />
                    <form method="get" id="frm" class="form-inline" action="form-x-editable.html" hidden>
                        <label>Mode:
                            <select name="c" id="c" class="form-control">
                                <option value="popup">Popup</option>
                                <option value="inline">Inline</option>
                            </select>
                        </label>

                        <button type="submit" class="btn btn-info" style="margin-left: 30px">Refresh</button>
                    </form>
                    <table id="perhitungan" class="table table-bordered table-striped" style="clear: both">
                        <tbody>
                            @if (Count($kriteria) > 0)
                                <tr>
                                    <td rowspan="2">Kriteria</td>
                                    <td rowspan="2">Sub Kriteria</td>
                                    <td colspan="{{COUNT($guru)}}">Alternatif</td>
                                </tr>
                                <tr>
                                    @foreach ($guru as $key => $item)
                                        <td>{{$item->kd_guru}}</td>
                                    @endforeach
                                </tr>
                                <?php $index = 0; ?>
                                @foreach ($span as $key => $item)
                                    @if ($item->count <= 1)
                                        <tr>
                                            <td>{{$item->nama_kriteria}}</td>
                                            <td>{{$sub[$index]->kd_sub}}</td>
                                            @for ($i = 0; $i < COUNT($guru); $i++)
                                                <td class="td-edited" data-kriteria="{{$item->kd_kriteria}}" data-guru="{{$guru[$i]->kd_guru}}">
                                                    <a href="#" class="perhitungan" data-type="text" data-pk="{{$key+2}}/{{$i+2}}" data-title="Enter username" class="editable editable-click" style="display: inline; text-size: 16px;">0</a>
                                                </td>
                                            @endfor

                                            <?php $index++; ?>
                                        </tr>
                                    @else
                                        @for ($i = 0; $i < $item->count; $i++)
                                            <tr>
                                                @if($i == 0)
                                                    <td rowspan="{{$item->count}}">{{$item->nama_kriteria}}</td>
                                                @endif
                                                <td>{{$sub[$index]->kd_sub}}</td>
                                                @for ($j = 0; $j < COUNT($guru); $j++)
                                                <td class="td-edited"  data-kriteria="{{$item->kd_kriteria}}" data-guru="{{$guru[$j]->kd_guru}}">
                                                        <a href="#" class="perhitungan" data-type="text" data-pk="{{$key+2}}/{{$j+2}}" data-title="Enter username" class="editable editable-click" style="display: inline; text-size: 16px;">0</a>
                                                    </td>
                                                @endfor
                                            </tr>
                                            <?php $index++; ?>
                                        @endfor
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <button class="btn btn-primary" id="proses-perhitungan" disabled data-href="{{URL::to('perhitungan/hasil')}}">Proses <i class="fa fa-spinner fa-sm"></i></button>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->
@endsection

{{-- CSS Section --}}
@section('css')
<link href="{{asset('assets/plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/x-editable/inputs-ext/address/address.css')}}" rel="stylesheet">

<style>
    td {
        text-align: center
    }
</style>
@endsection

{{-- JS Section --}}
@section('js')
<script src="{{asset('assets/plugins/jquery-mockjax-master/jquery.mockjax.js')}}"></script>
<script src="{{asset('assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('assets/plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.min.js')}}"></script>
<script src="{{asset('assets/plugins/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js')}}"></script>
<script src="{{asset('assets/plugins/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js')}}"></script>
<script src="{{asset('assets/plugins/x-editable/inputs-ext/address/address.js')}}"></script>
<script src="{{asset('assets/js/pages/form-x-editable.js')}}"></script>

<script>
$(document).ready(function ()
{
    $('#proses-perhitungan').attr('disabled', true);

    $('#proses-perhitungan').click(function ()
    {
        var $cols = $('#perhitungan tr td');
        var $rows = $('#perhitungan tr');
        var sendData = {};
        var data2 = {};
        var $colGuru = 0;

        $.each($cols, function (index, value)
        {
            if(index == 2){
                console.log(value.attributes.colspan.value)
                $colGuru = value.attributes.colspan.value;
                for(var i = 1; i <= $colGuru; i++){
                    console.log($cols[index + i].innerHTML)
                    sendData[$cols[index + i].innerHTML] = {};
                }
            }
        });

        // console.log(data)

        $.each($rows, function(index, value){
            if(index != 0 && index != 1){
                $.each(value.cells, function(index2, value2){
                    // console.log("================== " + index + " : " + index2 + "=====================")
                    if (value2.hasAttribute("data-kriteria")){
                        var kd = value2.getAttribute("data-guru");
                        var kr = value2.getAttribute("data-kriteria");
                        // console.log(kd)
                        // console.log(kr)
                        if (sendData[kd][kr] == undefined){
                            sendData[kd][kr] = [];
                            sendData[ kd ][ kr ][0] = value2.children[ 0 ].innerHTML;
                        } else {
                            count = sendData[kd][kr].length;
                            sendData[ kd ][ kr ][ count++ ] = value2.children[ 0 ].innerHTML;
                        }

                    }
                });
            }
        });

        data2 = {'data' : sendData};
        data2 = JSON.parse(JSON.stringify(data2));
        $.ajax({
            type: 'POST',
            url: '/perhitungan',
            data: data2,
            success: function(data){
                console.log(data)
                if(data.success){
                    $.ajax({
                        type: 'POST',
                        url: '/perhitungan/hasil',
                        data: {'data' : data.data},
                        success: function(ret){
                            window.location.href = data.url;
                        },
                        error: function(e){
                            console.log(e)
                        }
                    });
                }
            },
            error: function(data){
                console.log(data)
            }
        });
    });

    var count = 0;
    $('.td-edited').on('change', function ()
    {
        count++;
        if ($('.td-edited').length <= count)
        {
            $('#proses-perhitungan').attr('disabled', false);
        }
        else
        {
            $('#proses-perhitungan').attr('disabled', true);
        }
    });
});

</script>
@endsection
