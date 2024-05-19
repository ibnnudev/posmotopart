<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function groupByStore($transactionCode); // transaction detail id
    public function getByTransactionCode($transactionCode);
}
