<?php

namespace App\Interfaces;

interface TransactionInterface
{
    public function getAll();
    public function getById($id);
    public function store($data);
    public function groupByStore($transactionCode); // transaction detail id
    public function getTransactionDetailByTransactionCode($transactionCode);
    public function getByTransactionCode($transactionCode);

    public function confirmOrder($id, $data);
    public function changeStatus($id, $data);

    public function uploadPaymentProof($id, $data);
    public function verificationPayment($id);
    public function confirmReceive($id, $data);
}
