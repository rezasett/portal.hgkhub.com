<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assertion extends Model
{
    protected $fillable = ['nama_assertion', 'slug', 'deskripsi'];
}
