<?php

namespace App\Controller;

use Framework\Controller;
use Observers\TestQueue;
use Models\User;

class IndexController extends Controller
{
    public function indexAction()
    {
//        $user = new User();
//
//        $user->update();
//
//        var_dump($user->toArray());
//        die;

        $this->builder->app()->queue(TestQueue::class, [
            'hello' => 'world',
            'time'  => \date('d.m.Y H:i:s', \time())
        ]);
    }

}
