<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStage extends Model
{
    use HasFactory;

    protected $table = 'approval_stages';

    protected $fillable = [
        'approver_id',
        'stage'
    ];

    public function approver()
    {
        return $this->belongsTo(Approver::class);
    }
}
