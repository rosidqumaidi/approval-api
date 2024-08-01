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

    /**
     * @OA\Post(
     *   path="/api/approvers",
     *   summary="Create an Approver",
     *   description="Create an Approver",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="name",
     *           description="Approver Name",
     *           type="string",
     *           example="Ani"
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Approvar created successfully",
     *     @OA\JsonContent(
     *       @OA\Property(property="success", type="string", example="Approvar created successfully"),
     *     )
     *   ),
     *   @OA\Response(response=400, description="Bad Request"),
     *   @OA\Response(response=500, description="Internal Server Error")
     * 
     * )
     */
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
