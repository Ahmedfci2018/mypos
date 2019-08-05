<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['Ahmed Ali' , 'Mohamed Ali'];

        foreach ($clients as $client) {

            \App\Client::create([

                'name'=> $client,
                'phone'=>'01145250977',
                'address'=> 'Minya, Egypt',
            ]);
        }

    } //end of run

}// end of seeder
