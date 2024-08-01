<?php

namespace App\Rules;

use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Expense;
use Illuminate\Contracts\Validation\Rule;

class ApprovalRule implements Rule
{
    private $approverId;
    private $errorMessage;
    private $expenseId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($expenseId, $approverId)
    {
        $this->approverId = $approverId;
        $this->expenseId = $expenseId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $approvalStages = ApprovalStage::orderBy('id')->get();

        $currentStage = $approvalStages->firstWhere('approver_id', $this->approverId);

        if (!$currentStage) {
            $this->errorMessage = 'Approver not found in any approval stage.';
            return false;
        }

        $previousStages = $approvalStages->where('id', '<', $currentStage->id);
        foreach ($previousStages as $stage) {
            $approval = Approval::where('expense_id', $this->expenseId)
                ->where('approver_id', $stage->approver_id)
                ->first();
            if (!$approval || $approval->status_id != 2) { 
                $this->errorMessage = 'Previous stages must be approved first.';
                return false;
            }
        }

        $currentApproval = Approval::where('expense_id', $this->expenseId)
            ->where('approver_id', $this->approverId)
            ->first();

        if ($currentApproval && $currentApproval->status_id == 2) { 
            $this->errorMessage = 'This stage is already approved.';
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->errorMessage ?: 'The validation error message.';
    }
}
