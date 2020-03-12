<?php

namespace App\Http\Controllers;

use App\TothBoard\FrontControl\TothBoardFrontControlMenu;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect(route('canvases.index'));
        /*
        $front_control = TothBoardFrontControlMenu::setMenuBar(new TothBoardFrontControlMenu());

        return view('home', ['front_control' => $front_control]);
        */
    }
}
