<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\VoucherService;
use App\Traits\ResponseFormatterTrait;
use App\Http\Requests\Voucher\VoucherPostRequest;
use App\Http\Requests\Voucher\VoucherUpdateRequest;

use App\Models\Voucher;

class VoucherController extends Controller
{
    use ResponseFormatterTrait;
    protected $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
    }

    public function show(Request $request, $id)
    {
        return $this->responseSuccess(
            message: "Voucher successfully retreived!",
            data: $this->voucherService->getVoucherByUserId($request, $id)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoucherPostRequest $request)
    {
        return $this->responseSuccess(
            message: "Voucher successfully created!",
            data: $this->voucherService->createVoucher($request)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoucherUpdateRequest $request,Voucher $voucher)
    {
        return $this->responseSuccess(
            message: 'Voucher successfully updated.',
            data: $this->voucherService->updateVoucher($request, $voucher)
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Voucher $voucher)
    {
        return $this->responseSuccess(
            message: 'Voucher successfully deleted.',
            data: $this->voucherService->deleteVoucher($voucher)
        );
    }
}
