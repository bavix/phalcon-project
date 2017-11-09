<?php

namespace Modules\App\Controllers;

use Framework\ControllerBase;
use Models\User;

class IndexController extends ControllerBase
{

    public function indexAction()
    {

        $user = User::findFirst();

        var_dump($user->password);

        die;

        return $this->view->render('index', 'index');
    }

    public function apiAction()
    {
        return [
            'hello' => 'world'
        ];
    }

}
