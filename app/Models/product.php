<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    //
    protected $fillable = ['nama_barang','harga','stok','deskripsi'];
}
