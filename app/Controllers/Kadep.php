<?php

namespace App\Controllers;

use App\Models\KadepModel;

class Kadep extends BaseController
{
    protected $kadepModel;

    public function __construct()
    {
        $this->kadepModel = new KadepModel();
    }

    //--------------------------------------------------------------------



}
