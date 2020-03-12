<?php

namespace App\Http\Controllers;

use App\WebNavigator\WebPageFrontControl;
use App\WebNavigator\WorkSpaceOption;

use App\TothBoard\FrontControl\BoardListFrontControl;
//use App\OrcaPronto\FrontControl\ProjectUpdateFrontControl;

use App\TothBoard\Model\Board;
use App\TothBoard\Model\DefaultParam;


class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
        $default_param = DefaultParam::where('uuid', '=', 'project_tree')->get();
        */

        //$front_control = $this->setWorkSpaceBar(new ProjectListFrontControl(Project::all()));
        //$front_control->workspace_bar['projects.index']->active = true;
        $front_control = new BoardListFrontControl(Board::all());

        return view('boards.index', ['front_control' => $front_control]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $front_control = $this->setWorkSpaceBarForUnit(new ProjectUpdateFrontControl(Project::findOrFail($id)));
        $front_control->workspace_bar['projects.edit']->active = true;

        return view('projects.edit', ['front_control' => $front_control]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Show the form for deleting the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
    }

    private function setWorkSpaceBar(WebPageFrontControl $front_control) : WebPageFrontControl
    {
        $option = new WorkSpaceOption('index', 'projects', 'Histórico');
        $option->icon_name = 'book';

        $front_control->workspace_bar[$option->route] = $option;

        return $front_control;
    }

    private function setWorkSpaceBarForUnit(WebPageFrontControl $front_control) : WebPageFrontControl
    {
        $front_control = $this->setWorkSpaceBar($front_control);

        $option = new WorkSpaceOption('edit', 'projects', $front_control->object_unit->name);
        $option->icon_name = 'key';

        $front_control->workspace_bar[$option->route] = $option;

        return $front_control;
    }
}