<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlosariumLeadAccount extends Model
{
    protected $fillable = [
        'nama_lead_akun',
        'glosarium_account_element_id',
        'glosarium_industris_id',
    ];

    public function account()
    {
        return $this->belongsTo(GlosariumAccountElement::class, 'glosarium_account_element_id');
    }

    public function industri()
    {
    return $this->belongsTo(GlosariumIndustri::class, 'glosarium_industris_id');
    }

    public function artikelSaksSubAkun()
    {
        return $this->hasMany(ArtikelSak::class, 'sub_akun_id');
    }

    public function artikelSaksSubAkunIndustri()
    {
        return $this->hasMany(ArtikelSak::class, 'sub_akun_industri_id');
    }

    public function tbMappings()
    {
        return $this->hasMany(RaTbMapping::class, 'glosarium_lead_accounts_id');
    }
}
