<?php

namespace App\TothBoard\FrontControl;

use App\WebNavigator\UnitFrontControl;
use App\WebNavigator\WorkSpaceOption;

use Illuminate\Support\Collection;
/*
use App\TothBoard\Model\Project;
use App\TothBoard\Entity\ProjectEntity;

use App\TothBoard\Iterator\ProjectTreeChildrenIterator;
*/


class BoardUpdateFrontControl extends UnitFrontControl
{
    public function __construct(Board $board_unit)
    {
        parent::__construct($board_unit);
	}
}

?>