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
    public function changeStatus($id, $status);
    public function listDetail();
    public function uploadPaymentCod($attributes);
    public function filterMonthly($month);
}
