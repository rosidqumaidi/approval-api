<?php

namespace App\Repositories;

use App\Models\ApprovalStage;

interface ApprovalStageRepositoryInterface
{
    public function all();
    public function find($id);
    public function createApprovalStage(array $data): ApprovalStage;
    public function update($id, $approver_id);
}