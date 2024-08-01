<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApproveExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Models\Status;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ExpenseController extends Controller
{
    protected $expenseRepository;

    public function __construct(ExpenseRepositoryInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    /**
     * @OA\Post(
     *   path="/api/expense",
     *   summary="Create Expense",
     *   description="Create a new expense with amount",
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\MediaType(
     *       mediaType="application/x-www-form-urlencoded",
     *       @OA\Schema(
     *         @OA\Property(
     *           property="amount",
     *           description="Amount of the expense",
     *           type="integer",
     *           example=100
     *         )
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Expense created successfully",
     *     @OA\JsonContent(
     *       @OA\Property(property="amount", type="integer", example=100),
     *     )
     *   ),
     *   @OA\Response(response=400, description="Bad Request")
     * )
     */
    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = $this->expenseRepository->createExpense($request->all());

        return response()->json($expense, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/expense/{id}",
     *     summary="Get Expense By ID",
     *     @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value."),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */

    public function show($id): JsonResponse
    {
        $expense = $this->expenseRepository->find($id);
        return response()->json($expense);
    }

    /**
     * @OA\Patch(
     *     path="/api/expense/{id}/approve",
     *     summary="Approve Expense By ID with Request Body",
     *     @OA\Parameter(
     *         description="ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         @OA\Examples(example="int", value="1", summary="An int value.")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/x-www-form-urlencoded",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="approver_id",
     *                     description="Approver ID of the expense",
     *                     type="integer",
     *                     example=100
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */

    public function approve(ApproveExpenseRequest $request, $id)
    {
        $approval = $this->expenseRepository->approve($id, $request->approver_id);
        return response()->json($approval, 200);
    }
}
