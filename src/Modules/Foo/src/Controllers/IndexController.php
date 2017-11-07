<?php

namespace Modules\Foo\Controllers;

use Bavix\Helpers\Str;
use Framework\ControllerBase;

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        return Str::random();
    }

}
