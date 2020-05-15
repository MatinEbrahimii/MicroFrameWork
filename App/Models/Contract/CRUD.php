<?php

namespace App\Models\Contract;

interface CRUD
{
    public function create($data);
    public function read($columns, $where);
    public function update($data, $where);
    public function delete($where);
    public function query($query);
}
