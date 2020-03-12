<?php

namespace App\TothBoard\FrontControl;

use App\WebNavigator\CreateFrontControl;
use App\WebNavigator\WorkSpaceOption;

use Illuminate\Support\Collection;


class CanvasCreateFrontControl extends CreateFrontControl
{
	public $type_of_board_list = array();

	public function __construct(Collection $type_of_board_list)
	{
        parent::__construct();

		foreach ($type_of_board_list->all() as $type_of_board) {
			$this->type_of_board_list[$type_of_board->id] = $type_of_board;
		}
	}
}

?>