<?php

namespace App\TothBoard\FrontControl;

use App\WebNavigator\ListFrontControl;
use App\WebNavigator\WorkSpaceOption;

use Illuminate\Support\Collection;


class CanvasListFrontControl extends ListFrontControl
{
	public function __construct(Collection $board_list)
	{
        parent::__construct($board_list);
	}
}

?>