<?php

namespace App\Services;

use App\Models\Voucher;
use App\Exceptions\BusinessRuleException;
use Auth;

class VoucherService
{
    protected $voucher;
    
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function getVoucherByUserId($request, $id)
    {
        $voucher = $this->voucher->where('user_id', $id)
                            ->orderBy('created_at', 'desc' )
                            ->paginate($request->input('per_page') ?? 20, ['*'], 'page', $request->input('current_page'));;

        return $voucher;
    }

    public function createVoucher($request)
    {
        // Check if the user has exceeded the voucher limit
        if ($this->hasExceededVoucherLimit($request->user_id)) {
            throw BusinessRuleException::invoke(message: 'You have already created 10 vouchers.');
        }
        // Create a new Voucher with the generated code
        $voucher = $this->voucher->create([
            'code' => $this->generateVoucher($request->word),
            // If the user is authenticated, associate it with the voucher
            'user_id' => $request->user_id
        ]);

        return $voucher;
    
    }

    public function updateVoucher($request, $voucher)
    {

        $voucher->update([
            'code' => $this->generateVoucher($request->word),
        ]);

        return $voucher->code;
    }

    public function deleteVoucher($voucher)
    {
        try {

            return $voucher->delete();

        } catch (\Exception $e) {
            throw BusinessRuleException::invoke(message: $e->getMessage());
        }
    }

    private function generateVoucher($word)
    {
        // Get the current timestamp
        $timestamp = now()->timestamp;

        // Combine the word and the timestamp
        $input = $word . $timestamp;

        return substr(hash('sha256', $input), 0, 10);
    }

    private function hasExceededVoucherLimit($userId)
    {
        // Count the number of vouchers already created by this user
        $voucherCount = $this->voucher->where('user_id', $userId)->count();

        // Return true if the user has created 10 or more vouchers
        return $voucherCount >= 10;
    }
}
