<?php

namespace Database\Seeders;

use App\Models\Outlet;
use Illuminate\Database\Seeder;

class OutletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            'id' => 2,
            'tlp' => '082278356472',
            'nama' => 'pagar2',
            'alamat' => 'asdasdasd',
        ]);
    }
}
