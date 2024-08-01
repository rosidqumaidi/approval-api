<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

interface ApprovalStageRepositoryInterface
{
    public function createApprovalStage(array $data): ApprovalStage;

    public function editApprovalStage(int $id, array $approver_id): ApprovalStage;
}