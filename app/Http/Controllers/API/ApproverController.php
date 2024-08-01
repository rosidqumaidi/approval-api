<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApproverRequest;
use App\Repositories\ApproverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponseTrait;
use Exception;

class ApproverController extends Controller
{
    use ApiResponseTrait;

    protected $approverRepository;

    public function __construct(
        ApproverRepositoryInterface $approverRepository
    )
    {
        $this->approverRepository = $approverRepository;
    }

    // Metode untuk menyimpan approver
    public function storeApprover(StoreApproverRequest $request): JsonResponse
    {
        try {
            $approver = $this->approverRepository->createApprover($request->validated());

            return $this->successResponse($approver, 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
