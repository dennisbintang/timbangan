<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;
    protected $fillable = ['no_order','nama_alat','merek','model_type','no_seri','resolusi','rentang_ukur','nama_instansi','ruang_kalibrasi','tanggal_kalibrasi'];
}
