<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru as G;

use DB;
use Redirect;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Master.Guru.guru_list', [
            'guru' => $this->GetGuruAll()
        ]);
    }

    private function GetGuruAll(){
        return DB::table('guru')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Master.Guru.guru_entry');
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
            'jenkel' => 'required',
            'telp' => 'required|min:12|max:15',
            'alamat' => 'required'
        ]);

        $kd = $this->GenerateKodeAlternatif();
        $nama = ucwords($request->input('nama'));

        $s = DB::table('guru')
            ->where('nama_guru', $nama)
            ->first();

        if(!$s){
            $s = G::create([
                'kd_guru' => $kd,
                'nama_guru' => ucwords($request->input('nama')),
                'jenkel' => $request->input('jenkel'),
                'no_telp' => $request->input('telp'),
                'alamat' => $request->input('alamat')
            ]);

            if($s){
                return redirect('/guru')->with('success', 'Guru berhasil diinput!');
            } else {
                return redirect('/guru')->with('error', 'Gagal menginput Guru');
            }
        } else {
            return redirect('/guru')->with('error', 'Guru Telah Terinput!');
        }
    }

    private function GenerateKodeAlternatif(){
        $query = DB::table('guru')
              ->select(DB::raw('ifnull(max(convert(right(kd_guru, 3), signed integer)), 0) as kode, ifnull(length(max(convert(right(kd_guru, 3)+1, signed integer))), 0) as panjang'))
              ->first();

        if($query){
            $next_number = $query->kode + 1;
            if($query->kode != 0){// jika nomor sudah pernah ada
                if($query->panjang == 1){
                    $urutan = 'KM00'.$next_number;
                } else if($query->panjang == 2){
                    $urutan = 'KM0'.$next_number;
                } else {
                    $urutan = 'KM'.$next_number;
                }
            } else {
                $urutan = 'KM001';
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
        return view('admin.Master.Guru.guru_edit', ['data' => G::find($id)]);
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
            'jenkel' => 'required',
            'telp' => 'required|min:12|max:15'
        ]);

        $s = G::find($id);

        $s->nama_guru = ucwords($request->nama);
        $s->jenkel = $request->jenkel;
        $s->no_telp = $request->telp;
        $s->alamat = $request->alamat;
        $s->save();

        if($s){
            return redirect('/guru')->with('success', 'Guru berhasil diubah!');
        } else {
            return redirect('/guru')->with('error', 'Gagal mengubah Guru');
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
        $s = G::find($id);
        if($s != null)
            $s->delete();

        return redirect('/guru')->with('success', 'Guru berhasil dihapus!');
    }
}
