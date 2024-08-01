<?php

namespace App\Repositories;

use App\Models\Expense;

interface ApprovalRepositoryInterface
{
    public function approveExpense(int $expenseId, int $approverId): Expense;
}
