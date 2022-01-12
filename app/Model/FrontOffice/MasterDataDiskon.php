<?php

namespace App\Model\FrontOffice;

use App\Scopes\OwnershipScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterDataDiskon extends Model
{
    protected $table = "tb_fo_master_diskon";

    protected $primaryKey = 'id_diskon';

    protected $fillable = [
        'id_bengkel', 'nama_diskon', 'jumlah_diskon', 'kode_diskon'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public $timestamps = false;

    public static function getId()
    {
        return $getId = DB::table('tb_fo_master_diskon')->orderBy('id_diskon', 'DESC')->take(1)->get();
    }

    protected static function booted()
    {
        static::addGlobalScope(new OwnershipScope);
    }
}
