<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria as K;

use DB;
use Redirect;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Master.Kriteria.kriteria_list', [
            'kriteria' => $this->GetKriteriaAll()
        ]);
    }

    private function GetKriteriaAll(){
        return DB::table('kriteria')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Master.Kriteria.kriteria_entry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:100',
            'bobot' => 'required'
        ]);

        $kd = $this->GenerateKodeKriteria();
        $nama = ucwords($request->input('nama'));

        $s = DB::table('kriteria')
            ->where('nama_kriteria', $nama)
            ->where('kd_kriteria', $kd)
            ->first();

        if($s == null){
            $s = K::create([
                'kd_kriteria' => $kd,
                'nama_kriteria' => ucwords($request->input('nama')),
                'bobot_kriteria' => $request->input('bobot')
            ]);

            if($s){
                return redirect('/kriteria')->with('success', 'Kriteria berhasil diinput!');
            } else {
                return redirect('/kriteria')->with('error', 'Gagal menginput Kriteria');
            }
        } else {
            return redirect('/kriteria')->with('error', 'Kriteria Telah Terinput!');
        }
    }

    private function GenerateKodeKriteria(){
        $query = DB::table('kriteria')
              ->select(DB::raw('ifnull(max(convert(right(kd_kriteria, 2), signed integer)), 0) as kode, ifnull(length(max(convert(right(kd_kriteria, 2)+1, signed integer))), 0) as panjang'))
              ->first();

        if($query){
            $next_number = $query->kode + 1;
            if($query->kode != 0){
                // jika nomor sudah pernah ada
                if($query->panjang == 1){
                    $urutan = 'KN0'.$next_number;
                } else {
                    $urutan = 'KN'.$next_number;
                }
            } else {
                $urutan = 'KN01';
            }
        }

        return $urutan;
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
        return view('admin.Master.Kriteria.kriteria_edit', ['data' => K::find($id)]);
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
        $this->validate($request, [
            'nama' => 'required|max:100'
        ]);

        $s = K::find($id);

        $s->nama_kriteria = ucwords($request->nama);
        $s->bobot_kriteria = $request->bobot;
        $s->save();

        if($s){
            return redirect('/kriteria')->with('success', 'Kriteria berhasil diubah!');
        } else {
            return redirect('/kriteria')->with('error', 'Gagal mengubah Kriteria');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $s = K::find($id);
        if($s != null)
            $s->delete();

        return redirect('/kriteria')->with('success', 'Kriteria berhasil dihapus!');
    }
}
