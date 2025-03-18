<?php

use App\Enums\EmployeeStatusEnum;
use App\Enums\GenderEnum;
use App\Models\Country;
use App\Models\Employees\EmployeeCompany;
use App\Models\Nationality;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained();
            $table->boolean('is_created_from_import')->default(false);

            $table->string('first_name');
            $table->string('last_name');
            $table->string('family_name')->nullable();
            $table->string('status');
            $table->string('gender');
            $table->string('id_number')->nullable();
            $table->string('vat_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('issuing_authority_name')->nullable();
            $table->string('visa_number')->nullable();
            $table->string('residence_permit_type')->nullable();
            $table->string('health_insurance')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_number')->nullable();
            $table->string('street')->nullable();
            $table->string('house_number')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->foreignIdFor(Country::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('nationality')->nullable();
            $table->foreignIdFor(Nationality::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('hostel_cr_street')->nullable();
            $table->string('hostel_cr_house_number')->nullable();
            $table->string('hostel_cr_city')->nullable();
            $table->string('hostel_cr_postal_code')->nullable();
            $table->string('telephone_abroad')->nullable();
            $table->string('telephone_cr')->nullable();
            $table->string('shoe_size')->nullable();
            $table->string('t_shirt_size')->nullable();
            $table->string('achieved_education')->nullable();
            $table->string('field_of_education')->nullable();
            $table->string('previous_experience')->nullable();
            $table->boolean('is_first_job_cr')->default(true);
            $table->string('account_number_cr')->nullable();
            $table->string('languages')->nullable();
            $table->string('work_permit_type')->nullable();
            $table->date('work_permit_validity')->nullable();
            $table->string('registration_number_cssz')->nullable();
            $table->date('date_of_employment')->nullable();
            $table->date('date_of_termination_of_employment')->nullable();
            $table->date('actual_date_of_last_shift')->nullable();
            $table->date('start_date_hpp')->nullable();
            $table->date('end_date_hpp')->nullable();
            $table->date('start_date_dpc')->nullable();
            $table->date('end_date_dpc')->nullable();
            $table->date('start_date_dpp')->nullable();
            $table->date('end_date_dpp')->nullable();
            $table->string('employment_relationship_type')->nullable();
            $table->string('temporary_assignment_user_company_name')->nullable();
            $table->foreignIdFor(EmployeeCompany::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->string('work_address_street')->nullable();
            $table->string('work_address_house_number')->nullable();
            $table->string('work_address_city')->nullable();
            $table->string('work_address_postal_code')->nullable();
            $table->string('classification_cz_isco')->nullable();
            $table->string('profession_code_cz_isco')->nullable();
            $table->string('classification_cz_nace')->nullable();
            $table->text('note')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
