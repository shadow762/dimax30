<?php

use Illuminate\Database\Seeder;
use App\Models\Brend;

class BrendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brends')->delete();
        factory(Brend::class, 10)->create();
    }
}
