<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "user";
    protected $fillable = [
        "nama_user",
        "username",
        "password",
        "role"];
    protected $primaryKey = "id_user";

    // public function FunctionName()
    // {
    //     return $this->belongsTo('App\Models\name', '', '');
    // }
}
