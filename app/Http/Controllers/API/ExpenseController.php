<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

    public function store(StoreExpenseRequest $request): JsonResponse
    {
        $expense = $this->expenseRepository->createExpense([
            'amount' => $request->validated()['amount'],
            'status_id' => Status::where('name', 'menunggu persetujuan')->first()->id,
        ]);

        return response()->json($expense, 201);
    }

    public function show($id): JsonResponse
    {
        $expense = $this->expenseRepository->getExpenseById($id);
        return response()->json($expense);
    }
}

