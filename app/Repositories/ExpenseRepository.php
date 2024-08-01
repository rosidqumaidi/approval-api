<?php

namespace App\Repositories;

use App\Models\Expense;
use App\Models\Status;
use App\Models\Approval;
use App\Models\ApprovalStage;

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

        
        $approval = Approval::where(['expense_id' => $id, 'approver_id' => $approverId])->orderBy('id', 'desc')->first();
        $newApproval = Approval::create([
            'expense_id' => $id,
            'approver_id' => $approverId,
            'status_id' => 2,
        ]);

        // get last approval
        $lastApprover = ApprovalStage::orderBy('id', 'desc')->first();
        
        if ($approverId == $lastApprover->approver_id) {
            $e = Expense::find($id);
            $e->status_id = 2;
            $e->save();
        }
        return $newApproval;
        
        /* $currentStage = Approval::where('expense_id', $id)->orderBy('id', 'desc')->first();
        $nextStage = Approval::where('expense_id', $id)->where('id', '>', $currentStage->id)->first();

        if ($currentStage->approver_id != $approverId) {
            return response()->json(['error' => 'Not authorized to approve this stage'], 403);
        }

        $currentStage->update(['status_id' => 2]); // Assuming 2 is the ID for 'disetujui'

        if ($nextStage) {
            return $currentStage;
        }

        $expense->update(['status_id' => 2]);

        return $currentStage; */
    }
}

