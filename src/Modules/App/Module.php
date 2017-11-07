<?php

namespace Modules\App;

class Module extends \Framework\Module
{

    public function moduleDir(): string
    {
        return __DIR__;
    }

    public function namespace(): string
    {
        return __NAMESPACE__;
    }

}
