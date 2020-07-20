<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 5; $i++) { 
            $plan = new Plan();
            $name = Str::random(10);
            $plan->create([
                'name' => $name,
                'url'=> Str::kebab($name),
                'price'=> rand(0,9999).'.'.rand(0,99),
                'description'=> Str::random(50)                
            ]);
        }
    }
}
