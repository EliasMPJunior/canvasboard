<?php

namespace App\WebNavigator;

use Illuminate\Support\Collection;


abstract class ListFrontControl extends WebPageFrontControl
{
	public $object_list = array();

	public function __construct(Collection $object_list)
	{
		foreach ($object_list->all() as $object) {
			$this->object_list[$object->id] = $object;
		}
	}
}

?>