<?php

namespace App\Repositories;

use App\Models\Approver;

class ApproverRepository implements ApproverRepositoryInterface
{
    public function createApprover(array $data): Approver
    {
        return Approver::create($data);
    }
}