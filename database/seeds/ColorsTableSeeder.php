<?php

use Illuminate\Database\Seeder;
use App\Color;


class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::truncate();
        Color::create(['name'=>'LiteBlue','color'=>'#ADD8E6','description'=>'Light blue']);
        Color::create(['name'=>'Blue','color'=>'#5c5cff','description'=>'Blue']);
        Color::create(['name'=>'Warning','color'=>'#F88017','description'=>'Color of warnings']);
        Color::create(['name'=>'Magenta','color'=>'#be32d0','description'=>'Magents']);
        Color::create(['name'=>'LiteCyan','color'=>'#168092','description'=>'Light cyan']);
        Color::create(['name'=>'Cyan','color'=>'#0d7ea2','description'=>'Cyan']);
        Color::create(['name'=>'LiteGrey','color'=>'#757575','description'=>'Light grey']);
        Color::create(['name'=>'Grey','color'=>'#71767a','description'=>'Grey']);
        Color::create(['name'=>'SvrtyBest','color'=>'#008817','description'=>'Severity best']);
        Color::create(['name'=>'SvrtyGood','color'=>'#008817','description'=>'Severity good']);
        Color::create(['name'=>'SvrtyLow','color'=>'#a86437','description'=>'Severity low']);
        Color::create(['name'=>'SvrtyMedium','color'=>'#F88017','description'=>'Severity medium']);
        Color::create(['name'=>'SvrtyHigh','color'=>'#FF0000','description'=>'Severity high']);
        Color::create(['name'=>'SvrtyCritical','color'=>'#FF0000','description'=>'Severity critical']);
    }
}