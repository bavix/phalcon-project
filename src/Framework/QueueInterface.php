<?php

namespace Framework;

interface QueueInterface
{
    public function handle(Builder $builder, $data);
}
