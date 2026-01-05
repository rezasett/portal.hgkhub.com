<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoClientProspectData extends Model
{
    /**
     * Get all personnel allocations for this client prospect data.
     */
    public function personnelAllocations()
    {
        return $this->hasMany(\App\Models\MemoPersonelAllocation::class, 'memo_client_prospect_data_id');
    }

    /**
     * Get cost estimation total for this client prospect data.
     */
    public function costEstimationTotal()
    {
        return $this->hasOne(MemoCpdCostEstTotal::class, 'memo_client_prospect_data_id');
    }

    /**
     * Get EQCR recommendation for this client prospect data.
     */
    public function eqcrRecommendation()
    {
        return $this->hasOne(MemoCpdEqcrRecommendation::class, 'memo_client_prospect_data_id');
    }

    /**
     * Get all negotiation logs for this client prospect data.
     */
    public function negotiationLogs()
    {
        return $this->hasMany(CprNegoLog::class, 'memo_client_prospect_data_id');
    }

    /**
     * Get accepted client engagement record.
     */
    public function acceptedClient()
    {
        return $this->hasOne(MemoAcceptedClient::class, 'memo_client_prospect_data_id');
    }

    /**
     * Get CPD letters for this client prospect data.
     */
    public function cpdLetters()
    {
        return $this->hasOne(CpdLetter::class, 'memo_client_prospect_data_id');
    }
    
    protected $table = "memo_client_prospect_datas";
    protected $fillable = [
        'office_location_id',
        'memo_engagement_type_id',
        'audit_standard',
        'manager_id',
        'partner_id',
        'partner_signed_id',
        'eqr_id',
        'client_name',
        'initials',
        'npwp',
        'established_year',
        'ownership_status_id',
        'industri_sector_id',
        'financing_status_id',
        'accounting_standar_id',
        'engagement_periode',
        'engagement_service_id',
        'engagement_date',
        'address',
        'city',
        'province_id',
        'postal_code',
        'country',
        'office_telephone',
        'email',
        'website',
        'pic_name',
        'pic_email',
        'pic_phone',
        'created_by',
     
    ];

    protected $appends = ['province_name']; // agar ikut terserialisasi


    public function cpdQuestionareForms()
    {
        return $this->hasMany(MemoCpdQuestionareForm::class, 'memo_client_prospect_data_id');
    }

    public function cpdShareholders()
    {
        return $this->hasMany(CpdShareholder::class, 'memo_client_prospect_data_id');
    }

    public function cpdBodBocs()
    {
        return $this->hasMany(CpdBodBoc::class, 'memo_client_prospect_data_id');
    }

    public function cpdAuditCommittees()
    {
        return $this->hasMany(CpdAuditCommittee::class, 'memo_client_prospect_data_id');
    }
    
    public function province()
    {
        return $this->belongsTo(Provinsi::class, 'province_id');
    }

    public function getProvinceNameAttribute()
    {
        return $this->province->provinsi_indonesia ?? null;
    }

    public function officeLocation()
    {
        return $this->belongsTo(OfficeLocation::class, 'office_location_id');
    }

    public function engagementType()
    {
        return $this->belongsTo(MemoEngagementType::class, 'memo_engagement_type_id');
    }

    public function engagementService()
    {
        return $this->belongsTo(MemoEngagementService::class, 'engagement_service_id');
    }

    public function manager()
    {
        return $this->belongsTo(UserDetail::class, 'manager_id');
    }

    public function partner()
    {
        return $this->belongsTo(UserDetail::class, 'partner_id');
    }

    public function partnerSigned()
    {
        return $this->belongsTo(UserDetail::class, 'partner_signed_id');
    }

    public function eqrAssign()
    {
        return $this->belongsTo(EqrAssign::class, 'eqr_id');
    }

    public function ownershipStatus()
    {
        return $this->belongsTo(MemoOwnershipStatus::class, 'ownership_status_id');
    }

    public function industriSector()
    {
        return $this->belongsTo(GlosariumIndustri::class, 'industri_sector_id');
    }

    public function financingStatus()
    {
        return $this->belongsTo(MemoFinancingStatus::class, 'financing_status_id');
    }

    public function accountingStandar()
    {
        return $this->belongsTo(GlosariumStandarAkuntansi::class, 'accounting_standar_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function clientFinancial()
    {
        return $this->hasOne(MemoClientFinancial::class, 'client_id');
    }

    // ============ PMPJ RELATIONSHIPS ============
    
    /**
     * PMPJ data untuk memo ini
     */
    public function pmpj()
    {
        return $this->hasOne(MemoPmpj::class, 'memo_client_prospect_data_id');
    }

    // ============ MEMO STATUS OVERALL RELATIONSHIPS ============

    /**
     * Semua status untuk memo ini
     */
    public function statusOveralls()
    {
        return $this->hasMany(MemoStatusOverall::class, 'memo_client_prospect_data_id');
    }

    /**
     * Status terbaru untuk setiap modul
     */
    public function latestStatusByModule()
    {
        return $this->statusOveralls()
                    ->selectRaw('*, ROW_NUMBER() OVER (PARTITION BY module_name ORDER BY created_at DESC) as rn')
                    ->having('rn', 1);
    }

    /**
     * Get status untuk modul tertentu (yang terbaru)
     */
    public function getModuleStatus($moduleName)
    {
        return $this->statusOveralls()
                    ->where('module_name', $moduleName)
                    ->latest()
                    ->first();
    }

    /**
     * Check apakah modul sudah sampai status tertentu
     */
    public function hasModuleReachedStatus($moduleName, $status)
    {
        $currentStatus = $this->getModuleStatus($moduleName);
        
        if (!$currentStatus) return false;
        
        $statusHierarchy = [
            'Save' => 1,
            'Validate' => 2,
            'Reviewed' => 3,
            'Approved' => 4,
            'QC Passed' => 5
        ];
        
        $currentLevel = $statusHierarchy[$currentStatus->module_status] ?? 0;
        $targetLevel = $statusHierarchy[$status] ?? 0;
        
        return $currentLevel >= $targetLevel;
    }

    /**
     * Get overall progress percentage
     */
    public function getOverallProgressAttribute()
    {
        $modules = ['pre_engagement', 'risk_assessment', 'risk_responses', 'completing'];
        $totalModules = count($modules);
        $completedModules = 0;
        
        foreach ($modules as $module) {
            if ($this->hasModuleReachedStatus($module, 'QC Passed')) {
                $completedModules++;
            }
        }
        
        return ($completedModules / $totalModules) * 100;
    }
}
