<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

class ApprovalStageRepository implements ApprovalStageRepositoryInterface
{
    public function createApprovalStage(array $data): ApprovalStage
    {
        return ApprovalStage::create($data);
    }
}