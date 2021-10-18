<?php

namespace App\Http\Controllers\FrontOffice;

use App\Model\FrontOffice\CustomerBengkel;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontOffice\CustomerBengkelRequest;
use App\Model\FrontOffice\PenjualanSparepart;
use App\Model\Service\PenerimaanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerBengkelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = CustomerBengkel::get();
        return view('pages.frontoffice.customer_terdaftar.main', compact('customer'));
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
    public function store(CustomerBengkelRequest $request)
    {
        $data = $request->all();

        CustomerBengkel::create($data);
        return redirect()->back()->with('messageberhasil', 'Data Customer Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerBengkel  $customerBengkel
     * @return \Illuminate\Http\Response
     */
    public function show($id_customer_bengkel)
    {
        $customer = CustomerBengkel::find($id_customer_bengkel);

        $service = PenerimaanService::with('detail_sparepart','detail_perbaikan','kendaraan','bengkel')->join('tb_marketplace_bengkel','tb_service_advisor.id_bengkel','tb_marketplace_bengkel.id_bengkel')
        ->where('tb_service_advisor.id_customer_bengkel', $id_customer_bengkel)->where('tb_service_advisor.status','=','selesai_pembayaran')
        ->get();


        // return $service;


        // return $service;

        $penjualan = PenjualanSparepart::with('Detailsparepart')->join('tb_fo_customer_bengkel','tb_fo_penjualan_sparepart.id_customer_bengkel','tb_fo_customer_bengkel.id_customer_bengkel')
        ->where('tb_fo_penjualan_sparepart.id_customer_bengkel', $id_customer_bengkel)->where('tb_fo_penjualan_sparepart.status_bayar','=', 'Lunas')
        ->get();

        return view('pages.frontoffice.customer_terdaftar.detail',compact('service','penjualan','customer'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerBengkel  $customerBengkel
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerBengkelRequest $request, $id_customer_bengkel)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerBengkel  $customerBengkel
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerBengkelRequest $request, $id_customer_bengkel)
    {
        $customer = CustomerBengkel::findOrFail($id_customer_bengkel);
        $customer->nama_customer = $request->nama_customer;
        $customer->email_customer = $request->email_customer;
        $customer->nohp_customer = $request->nohp_customer;
        $customer->alamat_customer = $request->alamat_customer;

        $customer->update();
        return redirect()->back()->with('messageberhasil', 'Data Customer Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerBengkel  $customerBengkel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_customer_bengkel)
    {
        $customer = CustomerBengkel::findOrFail($id_customer_bengkel);
        $customer->delete();

        return redirect()->back()->with('messagehapus', 'Data Jenis Customer Berhasil dihapus');
    }
}
