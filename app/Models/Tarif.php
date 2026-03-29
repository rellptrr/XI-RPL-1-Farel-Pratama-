<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tb_tarif'; // Kasih tahu nama tabelnya
    protected $primaryKey = 'id_tarif'; // Kasih tahu Primary Key-nya

    protected $fillable = [
        'jenis_kendaraan',
        'biaya'
    ];
}