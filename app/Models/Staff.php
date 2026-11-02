<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'staff';
    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'lang_id',
        'department_id',
        'staff_designation_id',
        'specialist',
        'qualification',
        'work_exp',
        'specialization',
        'name',
        'surname',
        'father_name',
        'mother_name',
        'contact_no',
        'emergency_contact_no',
        'email',
        'dob',
        'marital_status',
        'date_of_joining',
        'date_of_leaving',
        'local_address',
        'permanent_address',
        'note',
        'image',
        'password',
        'gender',
        'blood_group',
        'account_title',
        'bank_account_no',
        'bank_name',
        'ifsc_code',
        'bank_branch',
        'payscale',
        'basic_salary',
        'epf_no',
        'contract_type',
        'shift',
        'location',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'resume',
        'joining_letter',
        'resignation_letter',
        'other_document_name',
        'other_document_file',
        'is_active',
        'verification_code',
        'zoom_api_key',
        'zoom_api_secret',
    ];

    protected $hidden = [
        'password',
        'verification_code',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'staff_roles', 'staff_id', 'role_id');
    }

    public function getFullNameAttribute()
    {
        return trim($this->name . ' ' . $this->surname);
    }
}
