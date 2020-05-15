<?php


namespace App\Repos;

use App\Models\User;
use App\Repos\Contract\BaseRepo;

class UserRepo extends BaseRepo
{
    public $model = User::class;  // \App\Models\User

    public function read($columns = '*', $where = array())
    {
        return $this->model::read($columns, $where);
    }
}
