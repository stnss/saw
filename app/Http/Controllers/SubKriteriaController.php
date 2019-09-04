<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKriteria as SK;

use DB;
use Redirect;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Master.SubKriteria.sub_list', [
            'sub' => $this->GetSubKriteriaAll()
        ]);
    }

    private function GetSubKriteriaAll(){
        return DB::table('sub_kriteria')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Master.SubKriteria.sub_entry', [
            'kriteria' => DB::table('kriteria')->get()
        ]);
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
            'kriteria' => 'required'
        ]);

        $kd = $this->GenerateKodeSubKriteria();
        $nama = ucwords($request->input('nama'));

        $s = DB::table('sub_kriteria')
            ->where('nama_sub', $nama)
            ->where('kd_sub', $kd)
            ->first();

        if($s == null){
            $s = SK::create([
                'kd_sub' => $kd,
                'nama_sub' => ucwords($request->input('nama')),
                'kd_kriteria' => $request->input('kriteria')
            ]);

            if($s){
                return redirect('/sub')->with('success', 'Sub Kriteria berhasil diinput!');
            } else {
                return redirect('/sub')->with('error', 'Gagal menginput Sub Kriteria');
            }
        } else {
            return redirect('/sub')->with('error', 'Sub Kriteria Telah Terinput!');
        }
    }

    private function GenerateKodeSubKriteria(){
        $query = DB::table('sub_kriteria')
              ->select(DB::raw('ifnull(max(convert(right(kd_sub, 2), signed integer)), 0) as kode, ifnull(length(max(convert(right(kd_sub, 2)+1, signed integer))), 0) as panjang'))
              ->first();

        if($query){
            $next_number = $query->kode + 1;
            if($query->kode != 0){
                // jika nomor sudah pernah ada
                if($query->panjang == 1){
                    $urutan = 'Sub0'.$next_number;
                } else {
                    $urutan = 'Sub'.$next_number;
                }
            } else {
                $urutan = 'Sub01';
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
        return view('admin.Master.SubKriteria.sub_edit', [
            'kriteria' => DB::table('kriteria')->get(),
            'data' => SK::find($id)
        ]);
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
            'nama' => 'required|max:100',
            'kriteria' => 'required'
        ]);

        $s = SK::find($id);

        $s->nama_sub = ucwords($request->nama);
        $s->kd_kriteria = $request->kriteria;
        $s->save();

        if($s){
            return redirect('/sub')->with('success', 'Sub Kriteria berhasil diubah!');
        } else {
            return redirect('/sub')->with('error', 'Gagal mengubah Sub Kriteria');
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
        $s = SK::find($id);
        if($s != null)
            $s->delete();

        return redirect('/sub')->with('success', 'Sub Kriteria berhasil dihapus!');
    }
}
