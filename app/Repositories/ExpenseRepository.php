<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Models\Status;
use App\Models\Approval;
class ExpenseRepository implements ExpenseRepositoryInterface
{
    public function all()
    {
        return Expense::all();
    }

    public function find($id)
    {
        return Expense::with('status', 'approvals.approver', 'approvals.status')->find($id);
    }

    public function createExpense(array $data): Expense
    {
        $data['status_id'] = Status::where('name', 'menunggu persetujuan')->first()->id;
        return Expense::create($data);
    }

    public function getExpenseById(int $id): Expense
    {
        return Expense::with('status', 'approvals.approver')->findOrFail($id);
    }

    public function approve($id, $approverId)
    {
        $expense = $this->find($id);

        $currentStage = Approval::where('expense_id', $id)->orderBy('id', 'desc')->first();
        $nextStage = Approval::where('expense_id', $id)->where('id', '>', $currentStage->id)->first();

        if ($currentStage->approver_id != $approverId) {
            return response()->json(['error' => 'Not authorized to approve this stage'], 403);
        }

        $currentStage->update(['status_id' => 2]); // Assuming 2 is the ID for 'disetujui'

        if ($nextStage) {
            return $currentStage;
        }

        $expense->update(['status_id' => 2]);

        return $currentStage;
    }
}

