<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MemoStatusOverall extends Model
{
    use HasFactory;

    protected $table = 'memo_status_overalls';

    protected $fillable = [
        'memo_client_prospect_data_id',
        'module_name',
        'module_status',
        'note',
        'user_id',
    ];



    // ============ RELATIONSHIPS ============


    // Relasi ke memo_client_prospect_data
    public function memoClientProspectData(): BelongsTo
    {
        return $this->belongsTo(MemoClientProspectData::class, 'memo_client_prospect_data_id');
    }

    // Relasi ke user yang melakukan perubahan status
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Tambahkan scope sederhana jika perlu
    public function scopeByModule($query, $moduleName)
    {
        return $query->where('module_name', $moduleName);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('module_status', $status);
    }
}
