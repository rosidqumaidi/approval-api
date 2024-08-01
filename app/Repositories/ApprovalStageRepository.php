<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

class ApprovalStageRepository implements ApprovalStageRepositoryInterface
{
    public function createApprovalStage(array $data): ApprovalStage
    {
        return ApprovalStage::create($data);
    }

    public function editApprovalStage(int $id, array $approver_id): ApprovalStage
    {
        $approvalStage = ApprovalStage::find($id);
        $approvalStage->update(['approver_id' => $approver_id]);

        return $approvalStage;
    }
}