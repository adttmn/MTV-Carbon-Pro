<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = "kategori";
    // protected $fillable = ['nama_kategori'];
    protected $guarded = ['id'];
}
