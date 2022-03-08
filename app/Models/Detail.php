<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = "detail";
    protected $fillable = [
        "id_transaksi",
        "id_paket",
        "qty"];
    protected $primaryKey = "id_detail";

    public function paket()
    {
        return $this->belongsTo('App\Models\Paket', 'id_paket', 'id_paket');
    }
}
