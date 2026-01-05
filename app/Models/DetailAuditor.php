<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAuditor extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_induk',
        'nama_auditor',
        'inisial',
        'jabatan_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(RoleJabatan::class, 'jabatan_id');
    }
}
