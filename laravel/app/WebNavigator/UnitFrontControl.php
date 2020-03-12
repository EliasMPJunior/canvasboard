<?php

namespace App\WebNavigator;

use Illuminate\Database\Eloquent\Model;


abstract class UnitFrontControl extends WebPageFrontControl
{
	public $object_unit;

	public function __construct(Model $object_unit)
	{
		$this->object_unit = $object_unit;
	}
}

?>