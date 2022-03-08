<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    protected $table = "outlet";
    protected $fillable = [
        "id_user",
        "alamat"];
    protected $primaryKey = "id_outlet";

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user', 'id_user');
    }
}
