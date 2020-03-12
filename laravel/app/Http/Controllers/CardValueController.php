<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\WebNavigator\WebPageFrontControl;
use App\WebNavigator\WorkSpaceOption;

use App\TothBoard\FrontControl\CanvasListFrontControl;
use App\TothBoard\FrontControl\CanvasCreateFrontControl;
use App\TothBoard\FrontControl\CanvasUpdateFrontControl;

use App\TothBoard\Model\Canvas;
use App\TothBoard\Model\TypeOfCanvas;
use App\TothBoard\Model\DefaultParam;

use App\TothBoard\Iterator\CanvasContentBuilderIterator;


class CardValueController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $canvas_id, int $card_id, Request $request)
    {
        $front_control = new CanvasUpdateFrontControl(Canvas::findOrFail($canvas_id), TypeOfCanvas::all());
        $front_control->canvas_content[$card_id]->card_value[count($front_control->canvas_content[$card_id]->card_value)] = $request->input('new_card_value');

        $canvas = $front_control->object_unit;
        $canvas->content = CanvasContentBuilderIterator::exportToJson($front_control->canvas_content);

        $canvas->save();

        return redirect(route('canvases.show', $canvas->id));
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $canvas_id, int $card_id, int $value_order)
    {
        session()->flash('card_value_for_deletion', array('canvas_id' => $canvas_id, 'card_id' => $card_id, 'value_order' => $value_order));

        return redirect(route('canvases.show', $canvas_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $canvas_id, int $card_id, int $value_order)
    {
        $front_control = new CanvasUpdateFrontControl(Canvas::findOrFail($canvas_id), TypeOfCanvas::all());
        unset($front_control->canvas_content[$card_id]->card_value[$value_order]);

        $card_value_array = $front_control->canvas_content[$card_id]->card_value;
        $front_control->canvas_content[$card_id]->card_value = array();
        foreach ($card_value_array as $card_value) {
            $front_control->canvas_content[$card_id]->card_value[count($front_control->canvas_content[$card_id]->card_value)] = $card_value;
        }

        $canvas = $front_control->object_unit;
        $canvas->content = CanvasContentBuilderIterator::exportToJson($front_control->canvas_content);

        $canvas->save();

        return redirect(route('canvases.show', $canvas_id));
    }
}