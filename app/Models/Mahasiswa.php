<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // pastikan nama tabel sesuai dengan yang ada di migration

    protected $fillable = [
        'nama',
        'nim',
        'mata_kuliah',
        'gambar'
    ];
}
