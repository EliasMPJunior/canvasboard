<?php

namespace App\WebNavigator;

use Illuminate\Database\Eloquent\Model;


abstract class UpdateFrontControl extends UnitFrontControl
{
	public $sent_data = array();

	public function __construct(Model $object_unit)
	{
		parent::__construct($object_unit);
	}
}

?>