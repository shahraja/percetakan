<?php

namespace App\Services;

use App\Services\Midtrans;
use Exception;
use Midtrans\Transaction;

class TransactionService extends Midtrans
{
    private $orderId;

    public function __construct($orderId)
    {
        parent::__construct();
        $this->orderId = $orderId;
    }

    /**
     * @return object
     */
    public function getTransactionStatus()
    {
        try {
            return Transaction::status($this->orderId);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}