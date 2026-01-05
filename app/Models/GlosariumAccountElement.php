<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlosariumAccountElement extends Model
{
    protected $fillable = ['nama_akun'];

    public function leadAccounts()
    {
        return $this->hasMany(GlosariumLeadAccount::class, 'glosarium_account_element_id');
    }

    public function tbMappings()
    {
        return $this->hasMany(RaTbMapping::class, 'glosarium_account_elements_id');
    }
}
