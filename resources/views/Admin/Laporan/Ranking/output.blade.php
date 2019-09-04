<style>
.page-break {
    page-break-after: always;
}
</style>
@foreach ($data as $item)
<center>
    <img src="{{asset('assets/images/logo.png')}}" width="115px" height="100px"><h1 style="margin-bottom: 3px">Laporan Ranking Guru</h1>
    @foreach ($item as $item2)
        <h2 style="margin: 0px">Tahun Ajaran {{$item2->tahun_ajaran}}</h2>
        <h3 style="margin: 0px">Semester {{$item2->semester}}</h3>
        @break
    @endforeach
    <hr width="80%"/>
    <br/><br/>
</center>
    <h2>Laporan Ranking Guru</h2>
    <div style="margin-left:10%;margin-right:10%">
        <table border="1px" width="100%" style="text-align:center;font-size:16px">
            <thead>
                <tr>
                    <th width="10%">Kode Guru</th>
                    <th width="35%">Nama Guru</th>
                    <th width="5%">Nilai Hasil</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($item as $key => $item2)
                    <tr>
                        <td>{{$key}}</td>
                        <td>{{$item2->nama_guru}}</td>
                        <td>{{$item2->nilai_hasil}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="page-break"></div>
    @break
@endforeach
