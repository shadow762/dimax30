<?php

use Illuminate\Database\Seeder;
use App\Models\Lmodel;

class LmodelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lmodels')->delete();
        factory(Lmodel::class, 20)->create();
    }
}
