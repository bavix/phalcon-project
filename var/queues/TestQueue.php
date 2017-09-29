<?php

namespace Observers;

use Framework\Builder;
use Framework\QueueInterface;

class TestQueue implements QueueInterface
{

    public function handle(Builder $builder, $data)
    {
        \file_put_contents(
            __DIR__ . '/../cache/' . __FUNCTION__,
            \json_encode($data)
        );
    }

}
