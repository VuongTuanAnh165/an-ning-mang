<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Score;

class ScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        foreach ($users as $user) {
            Score::create([
                'user_id' => $user->id,
                'subject' => 'Math',
                'score' => rand(40, 100),
            ]);
            Score::create([
                'user_id' => $user->id,
                'subject' => 'English',
                'score' => rand(40, 100),
            ]);
        }
    }
}
