<?php

namespace App\Repositories;

use App\Models\Expense;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function createExpense(array $data): Expense
    {
        return Expense::create($data);
    }

    public function getExpenseById(int $id): Expense
    {
        return Expense::with('status', 'approvals.approver')->findOrFail($id);
    }
}

