<?php

namespace App\Services;

use App\Models\Voucher;

class VoucherService
{
    protected $voucher;
    
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function getAll()
    {

    }

    public function create($request)
    {

    }

    public function delete($id)
    {

    }
}
