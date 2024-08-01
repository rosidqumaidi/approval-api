<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveExpenseRequest;
use App\Http\Requests\storeApprovalStage;
use App\Http\Requests\storeApprovalStageRequest;
use App\Http\Requests\StoreApproverRequest;
use App\Models\ApprovalStage;
use App\Repositories\ApprovalRepositoryInterface;
use App\Models\Approver;
use App\Repositories\ApprovalStageRepositoryInterface;
use App\Repositories\ApproverRepositoryInterface;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponseTrait;
use Exception;

class ApprovalController extends Controller
{
    use ApiResponseTrait;

    protected $approverRepository;
    protected $approvalStageRepository;
    protected $approvalRepository;
    

    public function __construct(
        ApproverRepositoryInterface $approverRepository,
        ApprovalStageRepositoryInterface $approvalStageRepository,
        ApprovalRepositoryInterface $approvalRepository
    )
    {
        $this->approverRepository = $approverRepository;
        $this->approvalStageRepository = $approvalStageRepository;
        $this->approvalRepository = $approvalRepository;
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

    // Metode untuk menyetujui pengeluaran
    // public function approve($id, ApproveExpenseRequest $request): JsonResponse
    // {
    //     try {
    //         $expense = $this->approvalRepository->approveExpense($id, $request->input('approver_id'));
    //         return response()->json($expense);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], $e->getCode() ?: 400);
    //     }
    // }

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
    // public function updateApprovalStage($id, Request $request): JsonResponse
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'approver_id' => 'required|exists:approvers,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     $approvalStage = \App\Models\ApprovalStage::findOrFail($id);
    //     $approvalStage->update($request->all());

    //     return response()->json($approvalStage);
    // }
}
