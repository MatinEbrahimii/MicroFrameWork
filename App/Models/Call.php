<?php

namespace App\Models;

use App\Models\Contract\BaseModel;

class Call extends BaseModel
{
    public static $table = 'calls';

    public function getLatestMaleCalls($count)
    {
        // $this->query()
    }
}
