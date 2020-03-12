<?php

namespace App\TothBoard\FrontControl;

use App\WebNavigator\WebPageFrontControl;
use App\WebNavigator\WebPageNavigationOption;

/*
use Illuminate\Support\Collection;
*/


class TothBoardFrontControlMenu extends WebPageFrontControl
{
    static public function setMenuBar(WebPageFrontControl $front_control) : WebPageFrontControl
    {
        $option = new WebPageNavigationOption('index', 'canvases', 'Canvas');
        $front_control->menu_bar[$option->route] = $option;

        return $front_control;
    }

    private function setWorkSpaceBar(WebPageFrontControl $front_control) : WebPageFrontControl
    {
        $option = new WebPageNavigationOption('index', 'canvases', 'Histórico');
        $option->icon_name = 'book';

        $front_control->workspace_bar[$option->route] = $option;

        return $front_control;
    }

    private function setWorkSpaceBarForUnit(WebPageFrontControl $front_control) : WebPageFrontControl
    {
        $front_control = $this->setWorkSpaceBar($front_control);

        $option = new WebPageNavigationOption('edit', 'projects', $front_control->object_unit->name);
        $option->icon_name = 'key';

        $front_control->workspace_bar[$option->route] = $option;

        return $front_control;
    }
}