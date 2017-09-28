<?php

namespace Observers;

use Framework\Builder;
use Framework\Observer;

class TestObserver implements Observer
{

    public function handle(Builder $builder, $data)
    {
        \file_put_contents(
            __DIR__ . '/../cache/' . __FUNCTION__,
            \json_encode($data)
        );
    }

}
