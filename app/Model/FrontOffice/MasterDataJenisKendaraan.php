<?php

namespace App\Model\FrontOffice;

use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MasterDataJenisKendaraan extends Model
{
    protected $table = "tb_fo_master_jenis_kendaraan";

    protected $primaryKey = 'id_jenis_kendaraan';

    protected $fillable = [
        'jenis_kendaraan', 'keterangan'
    ];

    protected $hidden = [];

    public $timestamps = false;

}
