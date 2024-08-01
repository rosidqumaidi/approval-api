<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeApprovalStageRequest;
use App\Http\Requests\updateApprovalStageRequest;
use App\Repositories\ApprovalRepositoryInterface;
use App\Repositories\ApprovalStageRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponseTrait;
use Exception;

class ApprovalController extends Controller
{
    use ApiResponseTrait;

    protected $approvalStageRepository;
    protected $approvalRepository;
    

    public function __construct(
        ApprovalStageRepositoryInterface $approvalStageRepository,
        ApprovalRepositoryInterface $approvalRepository

    )
    {
        $this->approvalStageRepository = $approvalStageRepository;
        $this->approvalRepository = $approvalRepository;
    }

    // Metode untuk menyimpan tahap approval
    public function storeApprovalStage(storeApprovalStageRequest $request): JsonResponse
    {
        try {
            $approvalStage = $this->approvalStageRepository->createApprovalStage($request->validated());
    
            return $this->successResponse($approvalStage, 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    // // Metode untuk mengupdate tahap approval
    public function updateApprovalStage(UpdateApprovalStageRequest $request, $id): JsonResponse
    {
        try {
            // $approver_id = $request->validated()['approver_id'];

            $updatedApprovalStage = $this->approvalStageRepository->editApprovalStage($id, $request->validated());
    
            return $this->successResponse($updatedApprovalStage);
        } catch (Exception $e) {
            return $this->errorResponse('Terjadi kesalahan saat memperbarui data.', 500);
        }
    }
}
