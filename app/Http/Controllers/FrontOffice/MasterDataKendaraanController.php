<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontOffice\KendaraanRequest;
use App\Model\FrontOffice\Detailkendaraan;
use App\Model\FrontOffice\MasterDataJenisKendaraan;
use App\Model\FrontOffice\MasterDataKendaraan;
use App\Model\FrontOffice\MasterDataMerkKendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterDataKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = MasterDataKendaraan::with(['merk_kendaraan', 'jenis_kendaraan'])
        ->where('id_jenis_bengkel','=',Auth::user()->Bengkel->id_jenis_bengkel)
        ->where('status','=','Aktif')
        ->get();

        $detail = Detailkendaraan::with('Kendaraan')->where('id_bengkel', Auth::user()->Bengkel->id_bengkel)->get();

        $jenis = MasterDataJenisKendaraan::get();
        $merk = MasterDataMerkKendaraan::get();

        $id = MasterDataKendaraan::getId();
        foreach($id as $value);
        $idlama = $value->id_kendaraan;
        $idbaru = $idlama + 1;
        $blt = date('m');

        $kode_kendaraan = 'KD-'.$blt.'/'.$idbaru;


        return view('pages.frontoffice.masterdata.kendaraan.index', compact('kendaraan','jenis','merk','kode_kendaraan','detail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KendaraanRequest $request)
    {

        if(Auth::user()->Bengkel->id_jenis_bengkel == '1'){
            $kendaraan = new MasterDataKendaraan;
            $kendaraan->kode_kendaraan = $request->kode_kendaraan;
            $kendaraan->nama_kendaraan = $request->nama_kendaraan;
            $kendaraan->id_jenis_kendaraan = $request->id_jenis_kendaraan;
            $kendaraan->id_merk_kendaraan = $request->id_merk_kendaraan;
            $kendaraan->id_jenis_bengkel = '1';
            $kendaraan->status = 'Diajukan';
        }else if(Auth::user()->Bengkel->id_jenis_bengkel == '2'){
            $kendaraan = new MasterDataKendaraan;
            $kendaraan->kode_kendaraan = $request->kode_kendaraan;
            $kendaraan->nama_kendaraan = $request->nama_kendaraan;
            $kendaraan->id_jenis_kendaraan = $request->id_jenis_kendaraan;
            $kendaraan->id_merk_kendaraan = $request->id_merk_kendaraan;
            $kendaraan->id_jenis_bengkel = '2';
            $kendaraan->status = 'Diajukan';
        }

        $kendaraan->save();
        return redirect()->route('kendaraan.index')->with('messageberhasil', 'Data Kendaraan Berhasil diajukan - Mohon tunggu untuk Approval');
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
    public function edit($id_kendaraan)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_kendaraan)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kendaraan)
    {
        
    }
}
