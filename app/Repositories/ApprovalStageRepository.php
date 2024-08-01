<?php

namespace App\Repositories;

use App\Models\ApprovalStage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    public function update($id, $approver_id)
    {
        $approvalStage = $this->find($id);

        // Cek jika approvalStage tidak ditemukan
        if (!$approvalStage) {
            throw new ModelNotFoundException('Approval stage not found.');
        }

        $approvalStage->update(['approver_id' => $approver_id]);

        return $approvalStage;
    }
}