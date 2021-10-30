<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BranchOfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> 'Matriz',
            'street'=> 'Av central',
            'suburb'=> 'Calvario',
            'postal_code'=> 20478,
            'ext_number'=> 120,
            'int_number'=> 407,
            'city'=> 'Tuxtla Gutierrez',
            'state'=> 'Chiapas',
            'country'=> 'Mexico',
        ];
    }
}
