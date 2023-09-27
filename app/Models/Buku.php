<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = "buku";
    protected $fillable = ['judul', 'pengarang','tanggal_publikasi'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
