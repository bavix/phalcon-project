<?php

namespace Framework;

use Phalcon\DiInterface;

interface ModelEvent
{
    public function handle(DiInterface $di, Model $model);
}
