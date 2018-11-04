<?php

use Illuminate\Database\Seeder;
use App\Model\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <5 ; $i++) { 
        	$p = new Product();
        	$p->name = 'KTM'.$i;
        	$p->quantily = $i;
			$p->save(); 
        }
    }
}
