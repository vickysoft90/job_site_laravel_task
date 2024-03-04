<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;
class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $faker = Faker::create();
        DB::table('users')
        ->insert([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'role' => 1,
            'location_id' => rand(1,9),
            'password' => '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi',//Sai@1234
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ]); 
        DB::table('users')
        ->insert([
            'name' => "user",
            'email' => "user@gmail.com",
            'role' => 2,
            'location_id' => rand(1,9),
            'password' => '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi',//Sai@1234
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ]); 		
        foreach(range(1,4) as $key=>$value)
		{
            DB::table('users')
            ->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'role' => 2,
                'location_id' => rand(1,9),
                'password' => '$2y$10$Y4BFQ7c8Pb1PbFMdmoCJ/erTRdNKKBL512pdA/vlIEKuHezks.gOi',//Sai@1234
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()

            ]); 
                      
		}
       
       
    }
}
