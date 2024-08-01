<?php

namespace App\Repositories;

use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Expense;
use App\Models\Status;

class ApprovalRepository implements ApprovalRepositoryInterface
{
    public function approveExpense(int $expenseId, int $approverId): Expense
    {
        $expense = Expense::findOrFail($expenseId);

        $currentStage = ApprovalStage::where('approver_id', $approverId)->first();
        if (!$currentStage) {
            throw new \Exception('Approver tidak valid untuk tahap ini.');
        }

        $previousStage = ApprovalStage::where('stage', '<', $currentStage->stage)
            ->orderBy('stage', 'desc')
            ->first();

        if ($previousStage) {
            $previousApproval = Approval::where('expense_id', $expense->id)
                ->where('approver_id', $previousStage->approver_id)
                ->first();

            if (!$previousApproval || $previousApproval->status_id != Status::where('name', 'disetujui')->first()->id) {
                throw new \Exception('Approval sebelumnya belum disetujui.');
            }
        }

        $approval = Approval::create([
            'expense_id' => $expense->id,
            'approver_id' => $approverId,
            'status_id' => Status::where('name', 'disetujui')->first()->id,
        ]);

        if (ApprovalStage::count() == Approval::where('expense_id', $expense->id)->count()) {
            $expense->status_id = Status::where('name', 'disetujui')->first()->id;
            $expense->save();
        }

        return $expense;
    }
}

