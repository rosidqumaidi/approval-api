<?php

namespace App\Repositories;

use App\Models\Expense;

interface ExpenseRepositoryInterface
{
    public function createExpense(array $data): Expense;
    public function getExpenseById(int $id): Expense;
}

