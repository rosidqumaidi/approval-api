<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Approver;

class ApproverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $approvers = [
            ['name' => 'Approver A'],
            ['name' => 'Approver B'],
            ['name' => 'Approver C'],
        ];

        foreach ($approvers as $approver) {
            Approver::create($approver);
        }
    }
}
