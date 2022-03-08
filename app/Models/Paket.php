<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $table = "paket";
    protected $fillable = [
        "jenis",
        "harga"];
    protected $primaryKey = "id_paket";

    // public function FunctionName()
    // {
    //     return $this->belongsTo('App\Models\name', '', '');
    // }
}
