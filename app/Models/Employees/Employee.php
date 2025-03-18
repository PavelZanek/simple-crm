<?php

namespace App\Models\Employees;

use App\Enums\CastTypeEnum;
use App\Enums\Employees\EmployeeStatusEnum;
use App\Enums\Employees\EmploymentRelationTypeEnum;
use App\Enums\Employees\ResidencePermitTypeEnum;
use App\Enums\Employees\WorkPermitTypeEnum;
use App\Enums\GenderEnum;
use App\Models\Country;
use App\Models\Nationality;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @mixin IdeHelperEmployee
 */
class Employee extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Employees\EmployeeFactory> */
    use HasFactory, InteractsWithMedia, LogsActivity, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'is_created_from_import',
        'first_name',
        'last_name',
        'id_number',
        'vat_number',
        'family_name',
        'status',
        'gender',
        'passport_number',
        'issuing_authority_name',
        'visa_number',
        'residence_permit_type',
        'health_insurance',
        'birth_date',
        'birth_number',
        'street',
        'house_number',
        'city',
        'postal_code',
        'country',
        'country_id',
        'nationality',
        'nationality_id',
        'hostel_cr_street',
        'hostel_cr_house_number',
        'hostel_cr_city',
        'hostel_cr_postal_code',
        'telephone_abroad',
        'telephone_cr',
        'shoe_size',
        't_shirt_size',
        'achieved_education',
        'field_of_education',
        'previous_experience',
        'is_first_job_cr',
        'account_number_cr',
        'languages',
        'work_permit_type',
        'work_permit_validity',
        'registration_number_cssz',
        'date_of_employment',
        'date_of_termination_of_employment',
        'actual_date_of_last_shift',
        'start_date_hpp',
        'end_date_hpp',
        'start_date_dpc',
        'end_date_dpc',
        'start_date_dpp',
        'end_date_dpp',
        'employment_relationship_type',
        'temporary_assignment_user_company_name',
        'employee_company_id',
        'work_address_street',
        'work_address_house_number',
        'work_address_city',
        'work_address_postal_code',
        'classification_cz_isco',
        'profession_code_cz_isco',
        'classification_cz_nace',
        'note',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_id' => CastTypeEnum::INT,
            'country_id' => CastTypeEnum::INT,
            'nationality_id' => CastTypeEnum::INT,
            'employee_company_id' => CastTypeEnum::INT,
            'is_created_from_import' => CastTypeEnum::BOOL,
            'status' => EmployeeStatusEnum::class,
            'gender' => GenderEnum::class,
            'residence_permit_type' => ResidencePermitTypeEnum::class,
            'birth_date' => CastTypeEnum::DATE,
            'is_first_job_cr' => CastTypeEnum::BOOL,
            'work_permit_type' => WorkPermitTypeEnum::class,
            'work_permit_validity' => CastTypeEnum::DATE,
            'date_of_employment' => CastTypeEnum::DATE,
            'date_of_termination_of_employment' => CastTypeEnum::DATE,
            'actual_date_of_last_shift' => CastTypeEnum::DATE,
            'start_date_hpp' => CastTypeEnum::DATE,
            'end_date_hpp' => CastTypeEnum::DATE,
            'start_date_dpc' => CastTypeEnum::DATE,
            'end_date_dpc' => CastTypeEnum::DATE,
            'start_date_dpp' => CastTypeEnum::DATE,
            'end_date_dpp' => CastTypeEnum::DATE,
            'employment_relationship_type' => EmploymentRelationTypeEnum::class,
        ];
    }

    /**
     * Get the activity log configuration for the model.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->useLogName('employee')
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
        //->setDescriptionForEvent(fn (string $eventName) => "Employee has been {$eventName}");
    }

    /**
     * @return BelongsTo<User>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Country>
     */
    public function employeeCompany(): BelongsTo
    {
        return $this->belongsTo(EmployeeCompany::class);
    }

    /**
     * @return BelongsTo<Country>
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return BelongsTo<Nationality>
     */
    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Nationality::class);
    }
}
