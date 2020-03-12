<?php

namespace App\TothBoard\FrontControl;

use App\WebNavigator\UpdateFrontControl;
use App\WebNavigator\WorkSpaceOption;

use Illuminate\Support\Collection;

use App\TothBoard\Model\Canvas;
use App\TothBoard\Model\TypeOfCanvas;

use App\TothBoard\Iterator\CanvasContentBuilderIterator;


class CanvasUpdateFrontControl extends UpdateFrontControl
{
	public $type_of_canvas;
	public $canvas_content = array();
	public $type_of_board_list = array();

    public function __construct(Canvas $canvas_unit, Collection $type_of_board_list)
    {
        parent::__construct($canvas_unit);

        $this->type_of_canvas = TypeOfCanvas::where('uuid', $canvas_unit->type)->first();
        $this->canvas_content = CanvasContentBuilderIterator::buildFromType($canvas_unit->content, $this->type_of_canvas->content);

		foreach ($type_of_board_list->all() as $type_of_board) {
			$this->type_of_board_list[$type_of_board->id] = $type_of_board;
		}
	}
}

?>