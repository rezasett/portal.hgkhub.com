<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $table = 'cerificates';

    protected $fillable = [
        'user_detail_id',
        'certificate_publisher',
        'certificate_name',
        'certificate_files',
        'year',
    ];

    public function userDetail()
    {
        return $this->belongsTo(UserDetail::class, 'user_detail_id');
    }
}
