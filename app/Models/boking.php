<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class boking extends Model
{
    use HasFactory;
    protected $table = 'boking';
    protected $primaryKey = 'id';
    protected $fillable = ['id','id_customer', 'id_lapangan', 'jenis_lapangan', 'lama_sewa', 'total_bayar'];

    // relasi table dari customer dengan id_customer(foreign_key)
    public function customer(){
        return $this->belongsTo(Customer::class, 'id_customer');
    }
    // relasi table dari lapangan dengan id_lapangan(foreign_key)
    public function lapangan(){
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }
}
