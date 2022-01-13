<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontOffice\Diskonrequest;
use Illuminate\Http\Request;
use App\Model\FrontOffice\MasterDataDiskon;
use App\Model\Inventory\Jenissparepart;
use Illuminate\Support\Facades\Auth;

class MasterDataDiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diskon = MasterDataDiskon::get();

        $id = MasterDataDiskon::getId();
        foreach ($id as $value);
        $idlama = $value->id_diskon;
        $idbaru = $idlama + 1;
        $blt = date('m');

        $jenis_spareaprt = Jenissparepart::get();
        $kode_diskon = 'E-BengkelDisc' . '/' . $blt . '-' . $idbaru;

        return view('pages.frontoffice.masterdata.diskon.index', compact('diskon', 'kode_diskon','jenis_sparepart'));
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
    public function store(Diskonrequest $request)
    {
        $request['id_bengkel'] = Auth::user()->id_bengkel;
        $data = $request->all();

        MasterDataDiskon::create($data);
        return redirect()->route('diskon.index')->with('messageberhasil', 'Data Diskon Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterDataDiskon  $masterDataDiskon
     * @return \Illuminate\Http\Response
     */
    public function show(MasterDataDiskon $masterDataDiskon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MasterDataDiskon  $masterDataDiskon
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterDataDiskon $masterDataDiskon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MasterDataDiskon  $masterDataDiskon
     * @return \Illuminate\Http\Response
     */
    public function update(Diskonrequest $request, $id_diskon)
    {
        $diskon = MasterDataDiskon::findOrFail($id_diskon);
        $diskon->nama_diskon = $request->nama_diskon;
        $diskon->jumlah_diskon = $request->jumlah_diskon;

        $diskon->update();

        return redirect()->back()->with('messageberhasil', 'Data Diskon Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MasterDataDiskon  $masterDataDiskon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_diskon)
    {
        $diskon = MasterDataDiskon::findOrFail($id_diskon);
        $diskon->delete();

        return redirect()->back()->with('messagehapus', 'Data Diskon Diskon Berhasil dihapus');
    }
}
