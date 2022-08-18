<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',//password
            'address'=>$this->faker->address(),
            'birth_date'=>$this->faker->date(),
            'phone'=>$this->faker->phoneNumber(),
            'ns'=>'4523JHYD829',
            'CURP'=>'FEPM890204HASRRN08',
            'gender'=>$this->faker->regexify('[01]{1}'),
            'occupation'=>$this->faker->company(),
            'marita_status'=>'Casado',
            'status'=>$this->faker->randomElements(['Activo', 'Despedido','Retirado'])[0],
            'weight'=>random_int(40,140),
            'height'=>random_int(130,190),
            'cetificate_number'=>'4523JHYD829',
            'phone_sec'=>$this->faker->phoneNumber(),
            'salary'=>random_int(4000,10000),

        ];
    }
}
