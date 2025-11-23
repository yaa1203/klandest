<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    // app/Models/Kategori.php

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}