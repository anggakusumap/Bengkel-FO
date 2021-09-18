<?php

namespace App\Model\Inventory;

use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;

class DetailSparepart extends Model
{
    protected $table = "tb_inventory_detail_sparepart";

    protected $primaryKey = 'id_detail_sparepart';

    protected $fillable = [
    	'id_sparepart',
        'id_bengkel',
        'id_gudang',
        'id_rak',
        'qty_stok',
        'stok_min',
        'status_jumlah',
        'harga_market',
        'keterangan'
    ];

    protected $hidden =[ 

    ];

    public $timestamps = false;

    public function Sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'id_sparepart', 'id_sparepart');
    }

    public function Gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang', 'id_gudang');
    }

    public function Rak()
    {
        return $this->belongsTo(Rak::class, 'id_rak', 'id_rak');
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
