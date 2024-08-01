<?php

namespace App\Repositories;

use App\Models\Expense;

interface ExpenseRepositoryInterface
{
    public function all();
    public function find($id);
    public function createExpense(array $data): Expense;
    public function getExpenseById(int $id): Expense;
    public function approve($id, $approverId);
}

