<?php

namespace Observers;

use Framework\Observer;

class User extends Observer
{

    public function save($data = null, $whiteList = null)
    {
        var_dump(__FUNCTION__, $data, $whiteList);
        die;
    }

    public function create($data = null, $whiteList = null)
    {
        var_dump(__FUNCTION__, $data, $whiteList);
        die;
    }

    public function update($data = null, $whiteList = null)
    {
        var_dump(__FUNCTION__, $data, $whiteList);
        die;
    }

    public function delete()
    {
        var_dump(__FUNCTION__);
        die;
    }

}
