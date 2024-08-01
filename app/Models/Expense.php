<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['status_id', 'amount'];
    use HasFactory;

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function approvals()
    {
        return $this->hasMany(Approval::class);
    }
}
