<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lapangan extends Model
{
    use HasFactory;
    protected $table = 'lapangan';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'jenis_lapangan', 'fasilitas', 'keterangan'];

    //relasi
    public function boking(){
        return $this->hasMany(boking::class,'id');
    }
}
