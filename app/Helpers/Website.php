<?php
namespace App\Helpers;

use  App\Setting;
use App\Slider;
class Website{

	public static function setting(){
		return Setting::first();

	}

	public static function sliders(){
		
		return Slider::all();
	}

}