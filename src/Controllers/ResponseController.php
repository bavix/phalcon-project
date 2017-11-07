<?php

namespace Controllers;

use Framework\ControllerBase;

class ResponseController extends ControllerBase
{

    public function notFoundAction()
    {
        return '404';
    }

}
