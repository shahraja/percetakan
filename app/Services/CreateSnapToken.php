<?php

namespace App\Services;

use App\Services\Midtrans;
use Midtrans\Snap;
use Midtrans\Transaction;

class CreateSnapToken extends Midtrans
{
    protected $params;

    public function __construct($params)
    {
        parent::__construct();
        $this->params = $params;
    }

    public function getSnapToken()
    {
        return Snap::getSnapToken($this->params);
    }

    public function getTransactionStatus($id)
    {
        return Transaction::status($id);
    }
}