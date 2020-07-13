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
        Color::create(['name'=>'LiteBlue','color'=>'#ADD8E6']);
        Color::create(['name'=>'Blue','color'=>'#5c5cff']);
        Color::create(['name'=>'Warning','color'=>'#ff00ff']);
        Color::create(['name'=>'Magenta','color'=>'#0000ee']);
        Color::create(['name'=>'LiteCyan','color'=>'#00cdcd']);
        Color::create(['name'=>'Cyan','color'=>'#00ffff']);
        Color::create(['name'=>'LiteGrey','color'=>'#a9a9a9']);
        Color::create(['name'=>'Grey','color'=>'#7f7f7f']);
        Color::create(['name'=>'SvrtyBest','color'=>'#bfff00']);
        Color::create(['name'=>'SvrtyGood','color'=>'#00cd00']);
        Color::create(['name'=>'SvrtyLow','color'=>'#cdcd00']);
        Color::create(['name'=>'SvrtyMedium','color'=>'#cd8000']);
        Color::create(['name'=>'SvrtyHigh','color'=>'#cd0000']);
        Color::create(['name'=>'SvrtyCritical','color'=>'#ff0000']);
    }
}