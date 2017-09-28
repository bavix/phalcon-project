<?php

namespace Framework;

interface Observer
{
    public function handle(Builder $builder, $data);
}
