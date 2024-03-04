<?php

namespace Database\Seeders;
 
use App\Models\JobLocation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class Job_location_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('job_location')->truncate();
        $faker = Faker::create();
        $locationarr=array('Chennai','Bangalore','Cuddalore','Coimbatore','Goa','Pune','Noida','Vadalore','Singanallure','Pondy');
		foreach(range(1,9) as $key=>$value)
		{
            DB::table('job_location')
            ->insert([
                'id' => $key+1,
                'location' => $locationarr[$key],
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()

            ]);            
		}
    }
}
