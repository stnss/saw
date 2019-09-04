<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
// use PDF2;
use SnappyImage;
use Session;
use Redirect;

class LaporanController extends Controller
{
    private $data;

    public function indexGuru(){
        return view('Admin.Laporan.Guru.guru', [
            'tahun' => DB::table('hasil')->select('tahun_ajaran')->distinct()->get()
        ]);
    }

    public function indexRanking()
    {
        return view('Admin.Laporan.Ranking.ranking_guru', [
            'tahun' => DB::table('hasil')->select('tahun_ajaran')->distinct()->get()
        ]);
    }

    public function laporanGuru(Request $request){
        $tawal = substr($request->input('tahun_awal'), 0, 4);
        $takhir = substr($request->input('tahun_akhir'), 0, 4);

        $next = $tawal;

        $sawal = ($request->input('semester_awal') == 'Ganjil') ? 0.5 : 1;
        $sakhir = ($request->input('semester_akhir') == 'Ganjil') ? 0.5 : 1;

        $range['tahun'] = $takhir - $tawal;
        $range['semester'] = $sakhir - $sawal;

        $total = (($range['tahun'] + $range['semester']) * 2) + 1;
        // return dd($total);
        if($request->input('semester_awal') == 'Ganjil'){
            for($i = 0; $i < $total; $i++){
                $semester = ($i % 2 == 0) ? 'Ganjil' : 'Genap';
                $q = DB::table('hasil')
                    ->join('guru', 'hasil.kd_guru', '=', 'guru.kd_guru')
                    ->select('hasil.Id', 'hasil.kd_guru', 'guru.nama_guru', 'hasil.nilai_hasil', 'hasil.tahun_ajaran', 'hasil.semester')
                    ->where('tahun_ajaran', $next.'/'.($next + 1))
                    ->where('semester', $semester)
                    ->orderBy('hasil.nilai_hasil', 'DESC')
                    ->get();

                if($q){
                    foreach ($q as $key => $value) {
                        foreach ($value as $a => $b) {
                            if($a == 'kd_guru')
                                continue;

                             $ret['data'][$i][$value->kd_guru][$a] = $b;
                        }

                        $s = DB::table('detail_hasil')
                        ->join('kriteria', 'detail_hasil.kd_kriteria', '=', 'kriteria.kd_kriteria')
                        ->select('detail_hasil.kd_kriteria as kd_kriteria', 'detail_hasil.nilai_preferensi', 'kriteria.nama_kriteria')
                        ->where('detail_hasil.kd_hasil', $value->Id)
                        ->get();

                        if($s){
                            foreach ($s as $key2 => $value2) {
                                $kd = "";
                                foreach($value2 as $key3 => $value3){
                                    if($key3 == 'kd_kriteria'){
                                        $kd = $value3;
                                        continue;
                                    }

                                    // return dd($value3);

                                    $ret['data'][$i][$value->kd_guru]['hasil'][$kd][$key3] = $value3;
                                }
                            }
                        }
                    }
                }
                $next = ($i % 2 == 0) ? $next++ : $next;
            }
        }
        else
        {
            for($i = 0; $i < $total; $i++){
                $semester = ($i % 2 == 0) ? 'Genap' : 'Ganjil';
                $q = DB::table('hasil')
                    ->join('guru', 'hasil.kd_guru', '=', 'guru.kd_guru')
                    ->select('hasil.kd_guru', 'guru.nama_guru', 'hasil.nilai_hasil', 'hasil.tahun_ajaran', 'hasil.semester', 'hasil.id')
                    ->where('tahun_ajaran', $next.'/'.($next + 1))
                    ->where('semester', $semester)
                    ->orderBy('hasil.nilai_hasil', 'DESC')
                    ->get();

                    // return dd($q);

                if($q){
                    foreach ($q as $key => $value) {
                        foreach ($value as $a => $b) {
                            if($a == 'kd_guru')
                                continue;

                             $ret['data'][$i][$value->kd_guru][$a] = $b;
                        }

                        $s = DB::table('detail_hasil')
                        ->join('kriteria', 'detail_hasil.kd_kriteria', '=', 'kriteria.kd_kriteria')
                        ->select('detail_hasil.kd_kriteria as kd_kriteria', 'detail_hasil.nilai_preferensi', 'kriteria.nama_kriteria')
                        ->where('detail_hasil.kd_hasil', $value->id)
                        ->get();

                        if($s){
                            foreach ($s as $key2 => $value2) {
                                $kd = "";
                                foreach($value2 as $key3 => $value3){
                                    if($key3 == 'kd_kriteria'){
                                        $kd = $value3;
                                        continue;
                                    }

                                    // return dd($value3);

                                    $ret['data'][$i][$value->kd_guru]['hasil'][$kd][$key3] = $value3;
                                }
                            }
                        }
                    }
                }
                $next = ($i % 2 == 0) ? $next : $next++;
            }
        }

        Session::put('guru', $ret['data']);
        // return dd($ret['data']);

        return view('Admin.Laporan.Guru.guru_terbaik', ['data' => $ret['data']]);
    }

    public function laporanRanking(Request $request){
        $tawal = substr($request->input('tahun_awal'), 0, 4);
        $takhir = substr($request->input('tahun_akhir'), 0, 4);

        $next = $tawal;

        $sawal = ($request->input('semester_awal') == 'Ganjil') ? 0.5 : 1;
        $sakhir = ($request->input('semester_akhir') == 'Ganjil') ? 0.5 : 1;

        $range['tahun'] = $takhir - $tawal;
        $range['semester'] = $sakhir - $sawal;

        $total = (($range['tahun'] + $range['semester']) * 2) + 1;
        // return dd($total);
        if ($request->input('semester_awal') == 'Ganjil') {
            for ($i = 0; $i < $total; $i++) {
                $semester = ($i % 2 == 0) ? 'Ganjil' : 'Genap';
                $q = DB::table('hasil')
                    ->join('guru', 'hasil.kd_guru', '=', 'guru.kd_guru')
                    ->select('hasil.Id', 'hasil.kd_guru', 'guru.nama_guru', 'hasil.nilai_hasil', 'hasil.tahun_ajaran', 'hasil.semester')
                    ->where('tahun_ajaran', $next . '/' . ($next + 1))
                    ->where('semester', $semester)
                    ->orderBy('hasil.nilai_hasil', 'DESC')
                    ->get();

                if ($q) {
                    foreach ($q as $key => $value) {
                        foreach ($value as $a => $b) {
                            if ($a == 'kd_guru')
                                continue;

                            $ret['data'][$i][$value->kd_guru][$a] = $b;
                        }
                    }
                }
                $next = ($i % 2 == 0) ? $next++ : $next;
            }
        } else {
            for ($i = 0; $i < $total; $i++) {
                $semester = ($i % 2 == 0) ? 'Genap' : 'Ganjil';
                $q = DB::table('hasil')
                    ->join('guru', 'hasil.kd_guru', '=', 'guru.kd_guru')
                    ->select('hasil.kd_guru', 'guru.nama_guru', 'hasil.nilai_hasil', 'hasil.tahun_ajaran', 'hasil.semester', 'hasil.id')
                    ->where('tahun_ajaran', $next . '/' . ($next + 1))
                    ->where('semester', $semester)
                    ->orderBy('hasil.nilai_hasil', 'DESC')
                    ->get();

                // return dd($q);

                if ($q) {
                    foreach ($q as $key => $value) {
                        foreach ($value as $a => $b) {
                            if ($a == 'kd_guru')
                                continue;

                            $ret['data'][$i][$value->kd_guru][$a] = $b;
                        }
                    }
                }
                $next = ($i % 2 == 0) ? $next : $next++;
            }
        }

        Session::put('rank', $ret['data']);

        return view('Admin.Laporan.Ranking.guru_ranking', ['data' => $ret['data']]);
    }

    function convert_to_html_rank($data){
        // return dd($data);
        $html = '
                <style>
                    .page-break {
                        page-break-after: always;
                    }
                </style>';

        foreach($data as $key2 => $item){
            $html .= '
                <table style="width: 100%; border:none; text-align:center">
                    <tr>
                        <th rowspan="3" width="10%">
                            <img src="assets/images/logo.png" width="115px" height="100px">
                        </th>
                        <th style="font-size:18px">
                            SEKOLAH DASAR ISLAM DIAN DIDAKTIKA
                        </th>
                    </tr>
                    <tr>
                        <td><p style="margin: 0px">Jl. Rajawali Blok F No. 10 &amp; 16 Cinere, Depok Kode Pos 12330</p></td>
                    </tr>
                    <tr>
                        <td><p style="margin: 0px">Telp / Fax. (021) 75432451, 7546632 (021) 7533865</p></td>
                    </tr>
                </table>
                <hr width="90%"/>
                <br/><br/>
                <center>
                    <h2>Laporan Ranking Guru</h2>
                </center>
                <div style="margin-left:10%;margin-right:10%">
                    <table border="1px" width="100%" style="text-align:center;font-size:16px;cellspacing: 0;">
                        <thead>
                            <tr>
                                <th width="10%">Kode Guru</th>
                                <th width="35%">Nama Guru</th>
                                <th width="5%">Nilai Hasil</th>
                            </tr>
                        </thead>
                        <tbody>';
                            foreach ($item as $key => $item2){
                                $html .= '<tr>
                                    <td>'. $key .'</td>
                                    <td>'. $item2['nama_guru'] .'</td>
                                    <td>'. $item2['nilai_hasil'] .'</td>
                                </tr>';
                            }
                    $html .= '</tbody>
                    </table>
                </div>
                <div class="page-break"></div>';
        }
        // return dd($html);
        return $html;
    }

    function convert_to_html_guru($data)
    {
        // return dd($data);
        $html = '<style>
                .page-break {
                    page-break-after: always;
                }
                </style>';

        foreach ($data as $key2 => $item) {
            $html .= '
                <table style="width: 100%; margin-left:5%; margin-right:5%; border:none; text-align:center">
                    <tr>
                        <th rowspan="3" width="5%">
                            <img src="assets/images/logo.png" width="115px" height="100px">
                        </th>
                        <th style="font-size:18px">
                            SEKOLAH DASAR ISLAM DIAN DIDAKTIKA
                        </th>
                    </tr>
                    <tr>
                        <td><p style="margin: 0px">Jl. Rajawali Blok F No. 10 &amp; 16 Cinere, Depok Kode Pos 12330</p></td>
                    </tr>
                    <tr>
                        <td><p style="margin: 0px">Telp / Fax. (021) 75432451, 7546632 (021) 7533865</p></td>
                    </tr>
                </table>
                <hr width="90%"/>
                <br/><br/>
                <center>
                    <h2>Laporan Guru Terbaik</h2>
                </center>
                <div style="margin-left:10%;margin-right:10%">
                    <table border="1px" width="100%" style="text-align:center;font-size:16px;cellspacing: 0;">
                        <thead>
                            <tr>
                                <th width="10%">Kode Guru</th>
                                <th width="35%">Nama Guru</th>
                                <th>Absensi</th>
                                <th>Pendagogik</th>
                                <th>Kepribadian</th>
                                <th>Sosial</th>
                                <th>Profesional</th>
                            </tr>
                        </thead>
                        <tbody>';
            foreach ($item as $key => $item2) {
                // return dd($item2['hasil']);
                $html .= '<tr>
                            <td>' . $key . '</td>
                            <td>' . $item2['nama_guru'] . '</td>';
                            foreach($item2['hasil'] as $val){
                                $html .= '<td>' . $val['nilai_preferensi'] . '</td>';
                            }
                        $html .= '</tr>';
            }
            $html .= '</tbody>
                    </table>
                </div>
                <div class="page-break"></div>';
        }
        return $html;
    }

    public function PrintRankGuru(){
        $data = Session::get('rank');
        // Session::flush('rank');
        $awal = '';
        $akhir = '';

        foreach ($data as $index => $item) {
            foreach ($item as $key => $val) {
                if ($index == 0) {
                    $awal = $val['tahun_ajaran'] . ' ' . $val['semester'];
                } else {
                    $akhir = $val['tahun_ajaran'] . ' ' . $val['semester'];
                }
            }
        }

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_to_html_rank($data));
        return $pdf->stream($awal . ' - ' . $akhir . '.pdf');
    }

    public function PrintGuruTerbaik()
    {
        $data = Session::get('guru');
        // Session::flush('guru');
        $awal = '';
        $akhir = '';

        foreach($data as $index => $item){
            foreach($item as $key => $val){
                if($index == 0){
                    $awal = $val['tahun_ajaran'] . ' ' . $val['semester'];
                } else {
                    $akhir = $val['tahun_ajaran'] . ' ' . $val['semester'];
                }
            }
        }

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_to_html_guru($data));
        return $pdf->stream($awal . ' - ' . $akhir.'.pdf');
    }
}
