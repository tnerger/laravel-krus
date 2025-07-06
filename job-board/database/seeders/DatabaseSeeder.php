<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(300)->create();

        $users = User::all()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            Employer::factory()->create([
                // pop holt einen User aus der Kollektion und entfernt ihn auch direkt
                // so  wird verhindert, dass der selbe User zwei mal einem Employer
                // zugewiesen wird
                'user_id' => $users->pop()->id
            ]);
        }

        $employers = Employer::all();
        for ($i = 0; $i < 100; $i++) {
            Job::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        foreach ($users as $user) {
            // Jobs in zufälliger Reihenfolge und davon 0 bis 4.
            $jobs = Job::inRandomOrder()->take(rand(0, 4))->get();
            foreach ($jobs as $job) {
                JobApplication::factory()->create([
                    'user_id' => $user->id,
                    'job_id' => $job->id
                ]);
            }
        }



        /*

        Alternativer Vorschlag dazu:

        Aber leider, sieht das nur gut aus, macht aber nicht, was es soll.
        Z.B: ->for(Employer::inRandomOrder()->first()) setzt IMMER den selben User...

        // Create 20 employers, each with a related user
        Employer::factory()
            ->count(20)
            ->for(User::factory())
            ->create();

        // Create 280 additional users (so total users = 300)
        User::factory(280)->create();

        // Create 100 jobs, each assigned to a random employer
        Job::factory()
            ->count(100)
            ->for(Employer::inRandomOrder()->first())
            ->create();

        JobApplication::factory()
            ->count(600)
            ->for(User::inRandomOrder()->first())
            ->for(Job::inRandomOrder()->first())
            ->create();
        */
    }
}
