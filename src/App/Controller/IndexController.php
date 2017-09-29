<?php

namespace App\Controller;

use Framework\Controller;
use Observers\TestObserver;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->builder->app()->queue(TestObserver::class, [
            'hello' => 'world',
            'time'  => \date('d.m.Y H:i:s', \time())
        ]);
    }

}
