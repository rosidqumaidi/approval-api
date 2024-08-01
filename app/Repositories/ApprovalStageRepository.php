<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

class ApprovalStageRepository implements ApprovalStageRepositoryInterface
{
    public function all()
    {
        return ApprovalStage::all();
    }

    public function find($id)
    {
        return ApprovalStage::find($id);
    }

    public function createApprovalStage(array $data): ApprovalStage
    {
        return ApprovalStage::create($data);
    }

    public function editApprovalStage(int $id, int $approver_id): ApprovalStage
    {
        $approvalStage = ApprovalStage::findOrFail($id);
        $approvalStage->update($approver_id);

        return $approvalStage;
    }
}