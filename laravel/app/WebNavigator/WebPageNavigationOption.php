<?php

namespace App\WebNavigator;


class WebPageNavigationOption
{
	public $id;
	public $name;
	public $route;
	public $icon_name;
	public $resource;
	public $active = false;

	public function __construct(string $id, string $resource, string $name)
	{
		$this->id = $id;
		$this->name = $name;
		$this->resource = $resource;
		$this->route = $this->resource.'.'.$this->id;
		$this->icon_name = $this->id;
	}
}

?>