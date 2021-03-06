<?php

namespace Database\Seeders;

use App\Models\BranchOffice;
use App\Models\User;
use Database\Factories\BranchOfficeFactory;
use Illuminate\Database\Seeder;

class BranchOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sucursales = BranchOffice::Factory(1)->create();
    }
}
