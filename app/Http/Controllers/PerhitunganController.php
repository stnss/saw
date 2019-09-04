<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Transaksi.Nilai.input_perhitungan', [
            'kriteria' => DB::table('kriteria')->get(),
            'guru' => DB::table('guru')->get(),
            'sub' => $this->GetSub(),
            'span' => $this->GetSpan()
        ]);
    }

    private function GetSub(){
        $q = DB::table('sub_kriteria')->select('kd_sub', 'kd_kriteria')->get();
        // return dd($q);

        return $q;
    }

    private function GetSpan(){
        $sub = DB::table('kriteria')
                ->selectRaw('
                    kriteria.kd_kriteria,
                    kriteria.nama_kriteria,
                    (
                        SELECT COUNT(kd_sub) FROM sub_kriteria WHERE kd_kriteria = kriteria.kd_kriteria
                    ) as count
                ')
                ->get();

                // return dd($sub);


        return $sub;
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
        $data = $request->all();

        $ret['altkriteria'] = array();
        $ret['tertinggi'] = array();
        $ret['normalisasi'] = array();
        $ret['preferensi'] = array();
        $ret['hasil'] = array();
        $ret['bobot'] = $this->GetBobotKriteria();

        foreach ($data['data'] as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $ret['altkriteria'][$key][$key2] = round(array_sum($value2) / COUNT($value2), 3, PHP_ROUND_HALF_UP);
            }
        }

        foreach($ret['altkriteria'] as $key => $value){
            foreach($ret['altkriteria'] as $key2 => $value2){
                if($key2 != $key){
                    foreach($value2 as $key3 => $value3){
                        if(!array_key_exists($key3, $ret['tertinggi'])){
                            $ret['tertinggi'][$key3] = $value[$key3];
                        } else {
                            if($ret['tertinggi'][$key3] < $value[$key3]){
                                $ret['tertinggi'][$key3] = $value[$key3];
                            }
                        }
                    }
                }
            }
        }

        foreach($ret['altkriteria'] as $key => $value){
            foreach($value as $key2 => $value2){
                $ret['normalisasi'][$key][$key2] = round($value2 / $ret['tertinggi'][$key2], 3, PHP_ROUND_HALF_UP);
            }
        }

        foreach($ret['normalisasi'] as $key => $value){
            foreach ($value as $key2 => $value2) {
                $ret['preferensi'][$key][$key2] = round($value2 * $ret['bobot'][$key2], 3, PHP_ROUND_HALF_UP);
            }
        }

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

        foreach($ret['preferensi'] as $key => $value){
            $nilai = 0;
            foreach ($value as $key2 => $value2) {
                $nilai += $value2;
            }

            $insert = array(
                "kd_guru" => $key,
                "nilai_hasil" => $nilai,
                "tahun_ajaran" => $year.'/'.$nextYear,
                "semester" => $semester
            );

            $q = DB::table('hasil')->insertGetId($insert);

            if($q != null){
                foreach ($value as $key3 => $value3) {
                    $detil = array(
                        "kd_hasil" => $q,
                        "kd_kriteria" => $key3,
                        "nilai_preferensi" => $value3
                    );

                    $s = DB::table('detail_hasil')->insert($detil);
                }
            }
        }

        foreach($ret['preferensi'] as $key => $value){
            $temp = array();
            foreach($value as $key2 => $value2){
                $kd = DB::table('kriteria')->where('kd_kriteria', $key2)->first();
                $temp[$kd->nama_kriteria] = $value2;
            }

            $guru = DB::table('guru')->where('kd_guru', $key)->first();
            if($guru){
                $ret['hasil'][$guru->nama_guru] = $temp;
            }
        }
        return ['success' => true, 'data' => $ret, 'url' => 'hasil'];
    }

    private function GetBobotKriteria(){
        $q = DB::table('kriteria')
            ->get();

        $ret_data = array();

        if($q){
            foreach($q as $key => $val){
                $ret_data[$val->kd_kriteria] = $val->bobot_kriteria;
            }
        }

        return $ret_data;
    }

    public function HasilControl(Request $request){
        $data = $request->all();
        $request->session()->put('data', $data['data']);
        return;
    }

    public function hasil(Request $request){
        $data = $request->session()->get('data');
        arsort($data['hasil']);

        // return dd($data['normalisasi']);

        if($data == null){
            return back();
        }

        return view('Admin.Transaksi.Nilai.hasil_perhitungan', ['data' => $data]);
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
}
