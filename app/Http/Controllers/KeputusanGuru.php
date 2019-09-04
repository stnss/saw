<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use PDF;
use Session;

class KeputusanGuru extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Transaksi.Keputusan.keputusan', [
            'tahun' => DB::table('hasil')->select('tahun_ajaran')->distinct()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tahun = $request->input('tahun');
        $semester = $request->input('semester');

        $q = DB::table('hasil')
            ->join('guru', 'hasil.kd_guru', '=', 'guru.kd_guru')
            ->where('tahun_ajaran', $tahun)
            ->where('semester', $semester)
            ->orderBy('nilai_hasil', 'DESC')
            ->get();

        return view('Admin.Transaksi.Keputusan.keputusan_detail', [
            'tahun' => $tahun,
            'semester' => $semester,
            'data' => $q
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function session(Request $request){
        Session::put('data', $request->all());
    }

    public function cetak(){
        // $data = $request->all();
        $data = Session::get('data');
        // return dd($data);
        $tahun = str_replace("/", "-", $data['tahun']);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_html($data));
        return $pdf->stream('Keputusan Guru Terbaik '.$tahun.' Semester '.$data['semester'].'.pdf');
        // return $data;
    }

    function convert_html($data)
    {
        date_default_timezone_set("Asia/Bangkok");
        $html = '<table style="width: 100%; margin-left:5%; margin-right:5%; border:none; text-align:center">
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
                    <h2>SURAT KEPUTUSAN GURU TERBAIK</h2>
                </center>
                <div style="margin-left:10%;margin-right:10%">
                    <p>Berdasarkan hasil dari perhitungan kinerja guru, dengan mempertimbangkan keputusan dari kepala sekolah. Maka hasil keputusan guru terbaik dengan data sebagai berikut:</p>
                    <br />
                    <p>Kode Guru  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:   '.$data['kd']. '</p>
                    <p>Nama Guru &nbsp;&nbsp;&nbsp;&nbsp;:   ' . $data['nama'] . '</p>
                    <p>Nilai Guru&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   :   ' . $data['nilai'] . '</p>
                    <br />
                    <p>Pada Periode '.$data['tahun'].' Semester '.$data['semester'].' telah terpilih sebagai guru terbaik Sekolah Dasar Islam Dian Didaktika.</p>
                    <br />
                    <br />
                    <br />
                    <p style="text-align:right">Depok, '.date("d F Y"). '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <p style="text-align:right">Kepala Sekolah&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                    <br />
                    <br />
                    <br />
                    <p style="text-align:right"><b>Drs.Moh.Syahudin H,MM</b></p>
                </div>';


        return $html;
    }
}
