<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserSearchActivity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSearchActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activities = [
            [
                'user_id' => 1,
                'search_term' => 'test',
                'results_count' => 1,
            ],
            [
                'user_id' => 1,
                'search_term' => 'test',
                'results_count' => 1,
            ],
            [
                'user_id' => 1,
                'search_term' => 'test',
                'results_count' => 1,
            ],
        ];

        foreach ($activities as $activity) {
            UserSearchActivity::create($activity);
        }
    }
}
