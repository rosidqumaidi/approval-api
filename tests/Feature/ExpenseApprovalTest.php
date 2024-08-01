<?php

namespace Tests\Feature;

use App\Models\Approver;
use App\Models\Approval;
use App\Models\ApprovalStage;
use App\Models\Expense;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseApprovalTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    protected $approverA;
    protected $approverB;
    protected $approverC;

    protected $statusPending;
    protected $statusApproved;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statusPending = Status::create(['name' => 'menunggu persetujuan']);
        $this->statusApproved = Status::create(['name' => 'disetujui']);

        $this->approverA = Approver::create(['name' => 'Ana']);
        $this->approverB = Approver::create(['name' => 'Ani']);
        $this->approverC = Approver::create(['name' => 'Ina']);

        ApprovalStage::create(['approver_id' => $this->approverA->id, 'stage' => 1]);
        ApprovalStage::create(['approver_id' => $this->approverB->id, 'stage' => 2]);
        ApprovalStage::create(['approver_id' => $this->approverC->id, 'stage' => 3]);
    }

    public function it_creates_expense_and_approves_it()
    {
        $response = $this->postJson('/api/expense', ['amount' => 100]);
        $response->assertStatus(201);

        $expense = $response->json();
        $this->assertEquals($this->statusPending->id, $expense['status_id']);

        $response = $this->patchJson("/api/expense/{$expense['id']}/approve", ['approver_id' => $this->approverA->id]);
        $response->assertStatus(200);
        $response = $this->patchJson("/api/expense/{$expense['id']}/approve", ['approver_id' => $this->approverB->id]);
        $response->assertStatus(200);
        $response = $this->patchJson("/api/expense/{$expense['id']}/approve", ['approver_id' => $this->approverC->id]);
        $response->assertStatus(200);

        $expense = Expense::find($expense['id']);
        $this->assertEquals($this->statusApproved->id, $expense->status_id);
    }

    public function it_approves_expense_by_two_approvers_only()
    {
        $response = $this->postJson('/api/expense', ['amount' => 200]);
        $response->assertStatus(201);

        $expense = $response->json();
        $this->assertEquals($this->statusPending->id, $expense['status_id']);

        $response = $this->patchJson("/api/expense/{$expense['id']}/approve", ['approver_id' => $this->approverA->id]);
        $response->assertStatus(200);
        $response = $this->patchJson("/api/expense/{$expense['id']}/approve", ['approver_id' => $this->approverB->id]);
        $response->assertStatus(200);

        $expense = Expense::find($expense['id']);
        $this->assertEquals($this->statusPending->id, $expense->status_id);
    }

    public function it_approves_expense_by_one_approver_only()
    {
        $response = $this->postJson('/api/expense', ['amount' => 300]);
        $response->assertStatus(201);

        $expense = $response->json();
        $this->assertEquals($this->statusPending->id, $expense['status_id']);

        $response = $this->patchJson("/api/expense/{$expense['id']}/approve", ['approver_id' => $this->approverA->id]);
        $response->assertStatus(200);

        $expense = Expense::find($expense['id']);
        $this->assertEquals($this->statusPending->id, $expense->status_id);
    }

    public function it_does_not_approve_expense_without_any_approvers()
    {
        $response = $this->postJson('/api/expense', ['amount' => 400]);
        $response->assertStatus(201);

        $expense = $response->json();
        $this->assertEquals($this->statusPending->id, $expense['status_id']);

        $expense = Expense::find($expense['id']);
        $this->assertEquals($this->statusPending->id, $expense->status_id);
    }
}
