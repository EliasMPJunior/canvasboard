<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\WebNavigator\WebPageFrontControl;
use App\WebNavigator\WebPageNavigationOption;

use App\TothBoard\FrontControl\CanvasListFrontControl;
use App\TothBoard\FrontControl\CanvasCreateFrontControl;
use App\TothBoard\FrontControl\CanvasUpdateFrontControl;
use App\TothBoard\FrontControl\CanvasShowFrontControl;
use App\TothBoard\FrontControl\TothBoardFrontControlMenu;

use App\TothBoard\Model\Canvas;
use App\TothBoard\Model\User;
use App\TothBoard\Model\TypeOfCanvas;
use App\TothBoard\Model\DefaultParam;

use Symfony\Component\Debug\Exception\FatalThrowableError;


class CanvasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $canvases = User::findOrFail(Auth::id())->canvases;
        $front_control = TothBoardFrontControlMenu::setMenuBar(new CanvasListFrontControl($canvases));

        $option = new WebPageNavigationOption('create', 'canvases', 'Create now');
        $front_control->workspace_bar[$option->route] = $option;

        $option = new WebPageNavigationOption('show', 'canvases', 'View canvas');
        $front_control->workspace_bar[$option->route] = $option;

        return view('canvases.index', ['front_control' => $front_control]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $front_control = TothBoardFrontControlMenu::setMenuBar(new CanvasCreateFrontControl(TypeOfCanvas::all()));

        $option = new WebPageNavigationOption('store', 'canvases', 'Create now');
        $front_control->workspace_bar[$option->route] = $option;

        if (session()->has('canvas_data')) {
            $front_control->sent_data = session()->get('canvas_data');          
        }

        return view('canvases.create', ['front_control' => $front_control]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        session()->flash('canvas_data', array('name' => $request->input('name'), 'type' => $request->input('type'), 'description' => $request->input('description')));

        $validatedData = $request->validate([
            'name' => ['required'],
            'type' => ['exists:mysql_config.type_of_canvas,uuid'],
        ]);

        $canvas = new Canvas();
        $canvas->type = $request->input('type');
        $canvas->user_id = Auth::id();
	    $canvas->content = [];

        $canvas->name = $request->input('name');
        $canvas->description = $request->input('description');

        $canvas->save();

        return redirect(route('canvases.show', $canvas->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $canvas = Canvas::findOrFail($id)->where('user_id','=',Auth::id())->where('id',$id)->first();
        $front_control = TothBoardFrontControlMenu::setMenuBar(new CanvasShowFrontControl($canvas));

        $option = new WebPageNavigationOption('edit', 'canvases', 'Edit');
        $front_control->workspace_bar[$option->route] = $option;

        $option = new WebPageNavigationOption('delete', 'canvases', 'Delete');
        $front_control->workspace_bar[$option->route] = $option;

        $option = new WebPageNavigationOption('store', 'canvases.edit.cardvalues', '+');
        $front_control->workspace_bar[$option->route] = $option;

        $option = new WebPageNavigationOption('delete', 'canvases.edit.cardvalues', 'x');
        $front_control->workspace_bar[$option->route] = $option;

        if (session()->has('card_value_for_deletion')) {
            $delete = session()->get('card_value_for_deletion');
            if ($delete['canvas_id'] == $id) {
                $option = new WebPageNavigationOption('destroy', 'canvases.edit.cardvalues', 'delete');
                $front_control->workspace_bar[$option->route.'.'.$delete['card_id'].'_'.$delete['value_order']] = $option;
            }
        } elseif (session()->has('canvas_for_deletion')) {
            $delete = session()->get('canvas_for_deletion');
            if ($delete['canvas_id'] == $id) {
                $option = new WebPageNavigationOption('destroy', 'canvases', 'Confirm');
                $front_control->workspace_bar[$option->route] = $option;
            }
        }

        return view('canvases.show', ['front_control' => $front_control]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $canvas = Canvas::findOrFail($id)->where('user_id','=',Auth::id())->where('id',$id)->first();
        $front_control = TothBoardFrontControlMenu::setMenuBar(new CanvasUpdateFrontControl($canvas, TypeOfCanvas::all()));

        $option = new WebPageNavigationOption('update', 'canvases', 'Update now');
        $front_control->workspace_bar[$option->route] = $option;

        if (session()->has('canvas_data')) {
            $front_control->sent_data = session()->get('canvas_data');          
        }

        return view('canvases.edit', ['front_control' => $front_control]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {

        session()->flash('canvas_data', array('name' => $request->input('name'), 'type' => $request->input('type'), 'description' => $request->input('description')));

        $validatedData = $request->validate([
            'name' => ['required'],
            'type' => ['exists:mysql_config.type_of_canvas,uuid'],
        ]);

        $canvas = Canvas::findOrFail($id)->where('user_id','=',Auth::id())->where('id',$id)->first();
        $canvas->name = $request->input('name');
        $canvas->description = $request->input('description');

        $canvas->save();

        return redirect(route('canvases.show', $canvas->id));
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        session()->flash('canvas_for_deletion', array('canvas_id' => $id));

        return redirect(route('canvases.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $canvas = Canvas::findOrFail($id)->where('user_id','=',Auth::id())->where('id',$id)->first();

        $canvas->delete();

        return redirect(route('canvases.index'));
    }
}
