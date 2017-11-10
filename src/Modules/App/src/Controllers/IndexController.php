<?php

namespace Modules\App\Controllers;

use Framework\ControllerBase;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        return $this->view->render('index', 'index');
    }

    public function apiAction()
    {
        return [
            'hello' => 'world'
        ];
    }

}
