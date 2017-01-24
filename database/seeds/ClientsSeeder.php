<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 10.01.2017
 * Time: 16:19
 */
namespace Database\Seeds;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsSeeder extends  Seeder
{
    public function run()
    {
        // TODO: Implement run() method.
        DB::table('clients')->delete();

        Client::create([
            'name' => 'Арутов Марат Валерьевич',
            'phone' => '89657564546',
            'email' => 'artur@mail.ru'
        ]);
        Client::create([
            'name' => 'Макаров Артур Тигранович',
            'phone' => '89652456789',
            'email' => 'makar@mail.ru'
        ]);
        Client::create([
            'name' => 'ООО "Ромашка"',
            'phone' => '345678',
            'email' => 'romashka@mail.ru'
        ]);
    }
}