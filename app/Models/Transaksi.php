<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $fillable = [
        "id_member",
        "id_user",
        "id_outlet",
        "tgl_diterima",
        "batas_waktu",
        "tgl_bayar",
        "status",
        "dibayar"
    ];
    protected $primaryKey = "id_transaksi";

    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'id_member', 'id_member');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id_user');
    }

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet', 'id_outlet', 'id_outlet');
    }

    public function detail()
    {
        return $this->hasMany('App\Models\Detail', 'id_transaksi', 'id_transaksi');
    }
}
