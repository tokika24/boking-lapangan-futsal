<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'nama_team', 'penanggung', 'no_telp', 'alamat'];

    //relasli
    public function boking(){
        return $this->hasMany(boking::class,'id');
    }

}
