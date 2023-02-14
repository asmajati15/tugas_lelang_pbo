<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    use HasFactory;
    
    protected $table = 'tb_lelang';

    protected $guarded = ['id_lelang'];

    public function barang(){

        return $this->hasMany(Barang::class);

    }
}
