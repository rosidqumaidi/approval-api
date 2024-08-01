<?php

namespace App\Repositories;

use App\Models\Approver;

interface ApproverRepositoryInterface
{
    public function createApprover(array $data): Approver;
}