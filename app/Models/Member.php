<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = "member";
    protected $fillable = [
        "nama_member",
        "alamat",
        "jenis_kelamin",
        "telp"];
    protected $primaryKey = "id_member";

    // public function FunctionName()
    // {
    //     return $this->belongsTo('App\Models\name', '', '');
    // }
}
