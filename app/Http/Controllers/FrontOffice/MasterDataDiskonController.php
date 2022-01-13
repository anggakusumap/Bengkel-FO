<?php

namespace App\Http\Controllers\FrontOffice;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontOffice\Diskonrequest;
use App\Model\FrontOffice\Detaildiskon;
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
        $diskon = MasterDataDiskon::where('status_diskon','=','Diskon Umum')->get();
        $voucher = MasterDataDiskon::where('status_diskon','=','Diskon Khusus')->get();

        $id = MasterDataDiskon::getId();
        foreach ($id as $value);
        $idlama = $value->id_diskon;
        $idbaru = $idlama + 1;
        $blt = date('m');

        $jenis_sparepart = Jenissparepart::get();
        $kode_diskon = 'E-BengkelDisc' . '/' . $blt . '-' . $idbaru;

        return view('pages.frontoffice.masterdata.diskon.index', compact('diskon','voucher', 'kode_diskon','jenis_sparepart'));
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

        if($request->status_diskon == 'Diskon Umum'){
            $diskon = new MasterDataDiskon;
            $diskon->kode_diskon = $request->kode_diskon;
            $diskon->nama_diskon = $request->nama_diskon;
            $diskon->jumlah_diskon = $request->jumlah_diskon;
            $diskon->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;
            $diskon->status_diskon = 'Diskon Umum';
            
            $diskon->save();
            $diskon->Detail()->sync($request->jenis);
            return $diskon;

        }else if($request->status_diskon == 'Diskon Khusus'){
            
            $diskon = new MasterDataDiskon;
            $diskon->kode_diskon = $request->kode_diskon;
            $diskon->nama_diskon = $request->nama_diskon;
            $diskon->jumlah_diskon = $request->jumlah_diskon;
            $diskon->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;
            $diskon->status_diskon = 'Diskon Khusus';
            $diskon->min_order = $request->min_order;
            
            $diskon->save();
            return $diskon;
        }



     
        
        // $request['id_bengkel'] = Auth::user()->id_bengkel;
        // $data = $request->all();

        // MasterDataDiskon::create($data);
        // return redirect()->route('diskon.index')->with('messageberhasil', 'Data Diskon Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MasterDataDiskon  $masterDataDiskon
     * @return \Illuminate\Http\Response
     */
    public function show($id_diskon)
    {
        $item = MasterDataDiskon::with('Detail')->find($id_diskon);
        return view('pages.frontoffice.masterdata.diskon.detail', compact('item'));
    
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
        if($diskon->status_diskon == 'Diskon Umum'){
            Detaildiskon::where('id_diskon', $id_diskon)->delete();
            $diskon->delete();
        }else{
            $diskon->delete();
        }
      

        return redirect()->back()->with('messagehapus', 'Data Diskon Diskon Berhasil dihapus');
    }
}
