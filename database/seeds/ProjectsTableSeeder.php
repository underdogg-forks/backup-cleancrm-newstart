<?php




use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $projects = factory(Modules\Projects\Models\Project::class, 1000)->create();
    }
}
