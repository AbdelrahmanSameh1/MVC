<?php

namespace itrax\core;

class controller
{
    public function view($path, $data)
    {
        extract($data);
        require VIEWS . $path . ".php";
    }
}
