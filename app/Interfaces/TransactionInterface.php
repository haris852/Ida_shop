<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function getAll();
    public function getById($id);
    public function getTransactionByUserId($userId);
    public function store($attributes);
    public function destroy($id);
    public function confirm($id, $attributes);
}
