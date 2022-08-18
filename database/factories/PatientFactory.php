<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'address'=>$this->faker->address(),
            'birth_date'=>$this->faker->date(),
            'phone'=>$this->faker->phoneNumber(),
            'ns'=>'4523JHYD829',
            'CURP'=>'FEPM890204HASRRN08',
            'gender'=>$this->faker->regexify('[01]{1}'),
            'occupation'=>$this->faker->company(),
            'marita_status'=>'Casado',
            'status'=>$this->faker->randomElements(['Dado de alta', 'En Tratamiento','Internado','Muerto'])[0],
            'weight'=>random_int(40,140),
            'height'=>random_int(130,190),
            'phone_sec'=>$this->faker->phoneNumber(),
        ];
    }
}
