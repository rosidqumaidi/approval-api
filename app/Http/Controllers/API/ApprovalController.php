<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApprovalStageRequest;
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

    /**
     * @OA\Post(
     *   path="/api/approval-stages",
     *   summary="Create Approval Stages",
     *   description="Create an Approval Stage",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="approver_id",
     *           description="Approver ID ref approvers table",
     *           type="integer",
     *           example=1
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Approval stage created successfully",
     *     @OA\JsonContent(
     *       @OA\Property(property="success", type="integer", example="Approval stage created successfully"),
     *     )
     *   ),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=500, description="Internal Server Error")
     * 
     * )
     */
    public function storeApprovalStage(StoreApprovalStageRequest $request): JsonResponse
    {
        try {
            $approvalStage = $this->approvalStageRepository->createApprovalStage($request->validated());
    
            return $this->successResponse('Approval stage created successfully', 201);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    // // Metode untuk mengupdate tahap approval
    public function updateApprovalStage(UpdateApprovalStageRequest $request, $id)
    {
        try {
            // $approver_id = $request->validated()['approver_id'];

            $updatedApprovalStage = $this->approvalStageRepository->update($id, $request->approver_id);
    
            return $this->successResponse($updatedApprovalStage);
        } catch (Exception $e) {
            return $this->errorResponse('Terjadi kesalahan saat memperbarui data.', 500);
        }
    }
}
