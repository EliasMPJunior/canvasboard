<?php

namespace App\WebNavigator;

use Illuminate\Database\Eloquent\Model;


abstract class CreateFrontControl extends WebPageFrontControl
{
	public $sent_data = array();

	public function __construct()
	{
	}
}

?>