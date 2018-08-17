<?php

namespace Modules\Hrm\Database\Seeds;


use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $employees = factory(Modules\Hrm\Models\Employee::class, 1000)->create();
    }
}
