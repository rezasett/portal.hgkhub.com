<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlosariumIndustri extends Model
{
    protected $table = 'glosarium_industris';
    protected $fillable = ['nama_industri',
        'deskripsi',
        'risk_score',
        'eqr_priority',
    ];

   /**
     * Relasi ke User
     */
    public function users()
    {
        return $this->hasMany(User::class, 'glosarium_industri_id');
    }
}
