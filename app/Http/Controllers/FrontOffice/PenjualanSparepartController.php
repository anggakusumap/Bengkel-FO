<?php

namespace App\Http\Controllers\FrontOffice;

use App\Model\FrontOffice\PenjualanSparepart;
use App\Http\Controllers\Controller;
use App\Model\FrontOffice\CustomerBengkel;
use App\Model\FrontOffice\DetailPenjualanSparepart;
use App\Model\Inventory\DetailSparepart;
use App\Model\Inventory\Kartugudang\Kartugudang;
use App\Model\Inventory\Sparepart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanSparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        if(Auth::user()->pegawai->cabang == null ){
            $penjualan = PenjualanSparepart::with(['Customer', 'Pegawai','Cabang'])->where('id_bengkel', Auth::user()->bengkel->id_bengkel)->orderBy('id_penjualan_sparepart', 'DESC')->get();
        }else{
            $penjualan = PenjualanSparepart::with(['Customer', 'Pegawai','Cabang'])->where('id_bengkel', Auth::user()->bengkel->id_bengkel)->where('id_cabang', Auth::user()->pegawai->cabang->id_cabang)->orderBy('id_penjualan_sparepart', 'DESC')->get();
        }

       
        $blt = date('D, d/m/Y');
        return view('pages.frontoffice.penjualan_sparepart.main', compact('blt', 'penjualan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer = CustomerBengkel::all();
        // $sparepart = DetailSparepart::with('Kartugudangpenjualan')->where('qty_stok', '>', 0)->get();
        $sparepart = DetailSparepart::with('Sparepart', 'Kartugudangpenjualan')->where('qty_stok', '>', 0)->get();


        // ->where('nama_jabatan', '!=', 'Owner')->get();


        $today = Carbon::today();

        $id = PenjualanSparepart::getId();
        foreach ($id as $value);
        $idlama = $value->id_penjualan_sparepart;
        $idbaru = $idlama + 1;
        $blt = date('m');

        $kode_penjualan_sparepart = 'PS-' . $blt . '/' . rand(1000, 9999);


        return view('pages.frontoffice.penjualan_sparepart.create', compact('customer', 'sparepart', 'kode_penjualan_sparepart', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = CustomerBengkel::where('nama_customer', $request->nama_customer)->first();

        $penjualan = new PenjualanSparepart;
        $penjualan->kode_penjualan = $request->kode_penjualan;
        $penjualan->id_customer_bengkel = $customer->id_customer_bengkel;
        $penjualan->tanggal = $request->tanggal;
        $penjualan->status_bayar = 'Belum Bayar';
        $penjualan->id_pegawai = $request['id_pegawai'] = Auth::user()->pegawai->id_pegawai;
        $penjualan->id_bengkel = Auth::user()->id_bengkel;

        $temp = 0;
        foreach ($request->sparepart as $key => $item) {
            $temp = $temp + $item['total_harga'];

            $sparepart = DetailSparepart::where('id_sparepart', $item['id_sparepart'])->first();

            // $sparepart = Sparepart::findOrFail($item['id_sparepart']);
            $sparepart->qty_stok = $sparepart->qty_stok - $item['jumlah'];
            if ($sparepart->qty_stok >= $sparepart->stok_min) {
                $sparepart->status_jumlah = 'Cukup';
            } else if ($sparepart->qty_stok == 0) {
                $sparepart->status_jumlah = 'Habis';
            } else {
                $sparepart->status_jumlah = 'Kurang';
            }
            $sparepart->save();

            $kartu_gudang = new Kartugudang;
            $kartu_gudang->id_bengkel = $request['id_bengkel'] = Auth::user()->id_bengkel;

            $kartugudangterakhir =  $sparepart->Kartugudangsaldoakhir;
            if ($kartugudangterakhir != null)
                $kartu_gudang->saldo_akhir = $kartugudangterakhir->saldo_akhir - $item['jumlah'];

            if ($kartugudangterakhir == null)
                $kartu_gudang->saldo_akhir =  $item['jumlah'];

            $kartu_gudang->jumlah_keluar = $kartu_gudang->jumlah_keluar + $item['jumlah'];
            $kartu_gudang->id_detail_sparepart = $sparepart->id_detail_sparepart;
            $kartu_gudang->harga_beli = $kartu_gudang->harga + $item['harga'];
            $kartu_gudang->kode_transaksi = $penjualan->kode_penjualan;
            $kartu_gudang->tanggal_transaksi = $penjualan->tanggal;
            $kartu_gudang->jenis_kartu = 'Penjualan';
            $kartu_gudang->save();
        }
        $penjualan->total_bayar = $temp;

        $penjualan->save();
        $penjualan->Detailsparepart()->sync($request->sparepart);

        // return $request;
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PenjualanSparepart  $penjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function show($id_penjualan_sparepart)
    {
        $penjualan = PenjualanSparepart::with('Detailsparepart', 'Pegawai')->findOrFail($id_penjualan_sparepart);

        return view('pages.frontoffice.penjualan_sparepart.detail')->with([
            'penjualan' => $penjualan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PenjualanSparepart  $penjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function edit($id_penjualan_sparepart)
    {
        $customer = CustomerBengkel::all();
        $sparepart = DetailSparepart::with('Sparepart', 'Kartugudangpenjualan')->where('qty_stok', '>', 0)->get();
        $today = Carbon::today();
        $penjualan = PenjualanSparepart::with('Detailsparepart', 'Customer')->findOrFail($id_penjualan_sparepart);



        for ($i = 0; $i < count($penjualan->Detailsparepart); $i++) {
            for ($j = 0; $j < count($sparepart); $j++) {
                if ($penjualan->Detailsparepart[$i]->id_sparepart == $sparepart[$j]->id_sparepart) {
                    $sparepart[$j]->jumlah = $penjualan->Detailsparepart[$i]->pivot->jumlah;
                    $sparepart[$j]->harga = $penjualan->Detailsparepart[$i]->pivot->harga;
                };
            }
        }

        return view('pages.frontoffice.penjualan_sparepart.edit')->with([
            'penjualan' => $penjualan,
            'today' => $today,
            'customer' => $customer,
            'sparepart' => $sparepart
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PenjualanSparepart  $penjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenjualanSparepart $penjualanSparepart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PenjualanSparepart  $penjualanSparepart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_penjualan_sparepart)
    {
        $penjualan = PenjualanSparepart::findOrFail($id_penjualan_sparepart);
        DetailPenjualanSparepart::where('id_penjualan_sparepart', $id_penjualan_sparepart)->delete();
        $penjualan->delete();

        return redirect()->back()->with('messagehapus', 'Data Penjualan Sparepart Berhasil dihapus');
    }

    public function cetakSparepart($id_penjualan_sparepart)
    {
        $cetak_sparepart = PenjualanSparepart::with('Detailsparepart', 'Customer', 'Bengkel', 'Pegawai')->findOrFail($id_penjualan_sparepart);
        // return $pelayanan;
        $now = Carbon::now();
        return view('print.FrontOffice.cetak-sparepart', compact('cetak_sparepart', 'now'));
    }
}
