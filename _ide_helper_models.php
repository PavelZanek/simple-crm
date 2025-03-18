<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\CountryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Country withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperCountry {}
}

namespace App\Models\Employees{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property bool $is_created_from_import
 * @property string $first_name
 * @property string $last_name
 * @property string|null $family_name
 * @property \App\Enums\Employees\EmployeeStatusEnum $status
 * @property \App\Enums\GenderEnum $gender
 * @property string|null $id_number
 * @property string|null $vat_number
 * @property string|null $passport_number
 * @property string|null $issuing_authority_name
 * @property string|null $visa_number
 * @property \App\Enums\Employees\ResidencePermitTypeEnum|null $residence_permit_type
 * @property string|null $health_insurance
 * @property \Carbon\CarbonImmutable|null $birth_date
 * @property string|null $birth_number
 * @property string|null $street
 * @property string|null $house_number
 * @property string|null $city
 * @property string|null $postal_code
 * @property \App\Models\Country|null $country
 * @property int|null $country_id
 * @property \App\Models\Nationality|null $nationality
 * @property int|null $nationality_id
 * @property string|null $hostel_cr_street
 * @property string|null $hostel_cr_house_number
 * @property string|null $hostel_cr_city
 * @property string|null $hostel_cr_postal_code
 * @property string|null $telephone_abroad
 * @property string|null $telephone_cr
 * @property string|null $shoe_size
 * @property string|null $t_shirt_size
 * @property string|null $achieved_education
 * @property string|null $field_of_education
 * @property string|null $previous_experience
 * @property bool $is_first_job_cr
 * @property string|null $account_number_cr
 * @property string|null $languages
 * @property \App\Enums\Employees\WorkPermitTypeEnum|null $work_permit_type
 * @property \Carbon\CarbonImmutable|null $work_permit_validity
 * @property string|null $registration_number_cssz
 * @property \Carbon\CarbonImmutable|null $date_of_employment
 * @property \Carbon\CarbonImmutable|null $date_of_termination_of_employment
 * @property \Carbon\CarbonImmutable|null $actual_date_of_last_shift
 * @property \App\Enums\Employees\EmploymentRelationTypeEnum|null $employment_relationship_type
 * @property string|null $temporary_assignment_user_company_name
 * @property int|null $employee_company_id
 * @property string|null $work_address_street
 * @property string|null $work_address_house_number
 * @property string|null $work_address_city
 * @property string|null $work_address_postal_code
 * @property string|null $classification_cz_isco
 * @property string|null $profession_code_cz_isco
 * @property string|null $classification_cz_nace
 * @property string|null $note
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Employees\EmployeeCompany|null $employeeCompany
 * @property-read \App\Models\Employees\TFactory|null $use_factory
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\Employees\EmployeeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAccountNumberCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereAchievedEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereActualDateOfLastShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereBirthNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereClassificationCzIsco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereClassificationCzNace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDateOfEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDateOfTerminationOfEmployment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereEmployeeCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereEmploymentRelationshipType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFamilyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFieldOfEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHealthInsurance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHostelCrCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHostelCrHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHostelCrPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHostelCrStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIdNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIsCreatedFromImport($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIsFirstJobCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIssuingAuthorityName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereLanguages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNationalityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePassportNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePreviousExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereProfessionCodeCzIsco($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereRegistrationNumberCssz($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereResidencePermitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereShoeSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereTShirtSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereTelephoneAbroad($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereTelephoneCr($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereTemporaryAssignmentUserCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereVatNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereVisaNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkAddressCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkAddressHouseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkAddressPostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkAddressStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkPermitType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkPermitValidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEmployee {}
}

namespace App\Models\Employees{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employees\Employee> $employees
 * @property-read int|null $employees_count
 * @property-read \App\Models\Employees\TFactory|null $use_factory
 * @method static \Database\Factories\Employees\EmployeeCompanyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeCompany withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEmployeeCompany {}
}

namespace App\Models\Employees{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read \App\Models\Employees\TFactory|null $use_factory
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @method static \Database\Factories\Employees\EmployeeDocumentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmployeeDocument withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEmployeeDocument {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @method static \Database\Factories\NationalityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Nationality withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperNationality {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\PermissionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Permission withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	final class IdeHelperPermission {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property bool $is_default
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RoleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereIsDefault($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role withoutPermission($permissions)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperRole {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Carbon\CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property \Carbon\CarbonImmutable|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Employees\Employee> $employees
 * @property-read int|null $employees_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Workspace> $workspaces
 * @property-read int|null $workspaces_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\CarbonImmutable|null $created_at
 * @property \Carbon\CarbonImmutable|null $updated_at
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\WorkspaceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Workspace whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	final class IdeHelperWorkspace {}
}

