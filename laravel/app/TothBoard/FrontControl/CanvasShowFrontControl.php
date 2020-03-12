<?php

namespace App\TothBoard\FrontControl;

use App\WebNavigator\UnitFrontControl;
use App\WebNavigator\WorkSpaceOption;

use Illuminate\Support\Collection;

use App\TothBoard\Model\Canvas;
use App\TothBoard\Model\TypeOfCanvas;

use App\TothBoard\Iterator\CanvasContentBuilderIterator;


class CanvasShowFrontControl extends UnitFrontControl
{
	public $type_of_canvas;
	public $canvas_content = array();

    public function __construct(Canvas $canvas_unit)
    {
        parent::__construct($canvas_unit);

        $this->type_of_canvas = TypeOfCanvas::where('uuid', $canvas_unit->type)->first();
        $this->canvas_content = CanvasContentBuilderIterator::buildFromType($canvas_unit->content, $this->type_of_canvas->content);
	}
}

?>