<?php

namespace Database\Factories\Employees;

use App\Enums\Employees\EmployeeStatusEnum;
use App\Enums\Employees\EmploymentRelationTypeEnum;
use App\Enums\Employees\ResidencePermitTypeEnum;
use App\Enums\Employees\WorkPermitTypeEnum;
use App\Enums\GenderEnum;
use App\Models\Company;
use App\Models\Country;
use App\Models\Employees\Employee;
use App\Models\Employees\EmployeeCompany;
use App\Models\Nationality;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'id_number' => $this->faker->numerify('##########'),
            'vat_number' => $this->faker->numerify('CZ#########'),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'family_name' => $this->faker->lastName,
            'status' => $this->faker->randomElement(EmployeeStatusEnum::allForFilter()->keys()->toArray()),
            'gender' => $this->faker->randomElement(GenderEnum::allForFilter()->keys()->toArray()),
            'passport_number' => Str::upper($this->faker->bothify('??#######')),
            'issuing_authority_name' => $this->faker->company,
            'visa_number' => Str::upper($this->faker->bothify('??#######')),
            'residence_permit_type' => $this->faker->randomElement(ResidencePermitTypeEnum::allForFilter()->keys()->toArray()),
            'health_insurance' => $this->faker->company,
            'birth_date' => $this->faker->date,
            'birth_number' => $this->faker->numerify('######/####'),
            'street' => $this->faker->streetName,
            'house_number' => $this->faker->buildingNumber,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'country' => $this->faker->country,
            'country_id' => Country::query()->count()
                ? Country::query()->inRandomOrder()->first()->id
                : Country::factory(),
            'nationality' => $this->faker->country,
            'nationality_id' => Nationality::query()->count()
                ? Nationality::query()->inRandomOrder()->first()->id
                : Nationality::factory(),
            'hostel_cr_street' => $this->faker->streetName,
            'hostel_cr_house_number' => $this->faker->buildingNumber,
            'hostel_cr_city' => $this->faker->city,
            'hostel_cr_postal_code' => $this->faker->postcode,
            'telephone_abroad' => $this->faker->phoneNumber,
            'telephone_cr' => $this->faker->phoneNumber,
            'shoe_size' => $this->faker->numberBetween(35, 47),
            't_shirt_size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'achieved_education' => $this->faker->randomElement(['Vysoká škola', 'Střední škola', 'Základní škola']),
            'field_of_education' => $this->faker->jobTitle,
            'previous_experience' => $this->faker->sentence,
            'is_first_job_cr' => $this->faker->boolean,
            'account_number_cr' => $this->faker->bankAccountNumber,
            'languages' => $this->faker->randomElement(['Čeština', 'Angličtina', 'Němčina']),
            'work_permit_type' => $this->faker->randomElement(WorkPermitTypeEnum::allForFilter()->keys()->toArray()),
            'work_permit_validity' => $this->faker->date,
            'registration_number_cssz' => $this->faker->numerify('########'),
            'date_of_employment' => $this->faker->date,
            'date_of_termination_of_employment' => $this->faker->optional()->date,
            'actual_date_of_last_shift' => $this->faker->optional()->date,
            'employment_relationship_type' => $this->faker->randomElement(EmploymentRelationTypeEnum::allForFilter()->keys()->toArray()),
            'employee_company_id' => EmployeeCompany::query()->count()
                ? EmployeeCompany::query()->inRandomOrder()->first()->id
                : EmployeeCompany::factory(),
            'work_address_street' => $this->faker->streetName,
            'work_address_house_number' => $this->faker->buildingNumber,
            'work_address_city' => $this->faker->city,
            'work_address_postal_code' => $this->faker->postcode,
            'classification_cz_isco' => $this->faker->randomElement(['111', '222', '333']),
            'profession_code_cz_isco' => $this->faker->randomElement(['1234', '5678']),
            'classification_cz_nace' => $this->faker->randomElement(['A', 'B', 'C']),
        ];
    }
}
