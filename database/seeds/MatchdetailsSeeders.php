<?php

use App\Models\Match;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


class MatchdetailsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //
        $faker = Faker::create();
//
//        for($i = 1 ; $i <= 10 ; $i++){
//            DB::table('match')->insert([
//                'name' => $faker->title(),
//                'first_team' => 1,
//                'second_team' => 2,
//                'match_date'=>$faker->dateTimeInInterval('--1 years','+5 days'),
//                'created_at' =>$faker->dateTimeInInterval('--1 years','+5 days'),
//                'Updated_at' => $faker->dateTimeInInterval('--1 years','+5 days'),
//            ]);
//        }
//
//
//        factory(\App\Models\MatchDetail::class, 10)->create([
//
//
//            ])->each(function ($match) {
//                $match->matches()->save(factory(Match::class)->create([
//                    'name' => $faker->title(),
//                    'first_team' => 1,
//                    'second_team' => 2,
//                    'match_date'=>$faker->dateTimeInInterval('--1 years','+5 days'),
//                    'created_at' =>$faker->dateTimeInInterval('--1 years','+5 days'),
//                    'Updated_at' => $faker->dateTimeInInterval('--1 years','+5 days'),
//                ]));
//            });

        factory(Match::class, 3)
            ->create([
                'name' => $faker->title(),
                'first_team' => 1,
                'second_team' => 2,
                'match_date'=>$faker->dateTimeInInterval('--1 years','+5 days'),
                'created_at' =>$faker->dateTimeInInterval('--1 years','+5 days'),
                'Updated_at' => $faker->dateTimeInInterval('--1 years','+5 days'),
            ])
            ->each(function ($match)use($faker) {
                $match->matchDetails()->createMany(
                    [
                        'team_id'=>1,
                        'player_id'=>1 ,
                        'sensor'=>1,
                        'player_position'=>null,
                        'time_played'=>$faker->time('00:20:00'),
                        'distance_km'=>$faker->randomFloat(2),
                        'hid_distance_15_km'=>$faker->randomFloat(2),
                        'distance_speed_range_15_km'=>$faker->randomFloat(2),
                        'distance_speed_range_15_20_km'=>$faker->randomFloat(2),
                        'distance_speed_range_20_25_km'=>$faker->randomFloat(2),
                        'distance_speed_range_25_30_km'=>$faker->randomFloat(2),
                        'distance_speed_range_greater_30_km'=>$faker->randomFloat(2),
                        'no_of_sprint_greater_25_km'=>$faker->randomFloat(2),
                        'avg_speed_km'=>$faker->randomFloat(2),
                        'max_speed_km'=>$faker->randomFloat(2),
                        'max_acceleration'=>$faker->randomFloat(2),
                        'no_of_acceleration_3'=>$faker->randomFloat(2),
                        'no_of_acceleration_4'=>$faker->randomFloat(2),
                        'no_of_deceleration_3'=>$faker->randomFloat(2),
                        'no_of_deceleration_4'=>$faker->randomFloat(2),
                        'is_summary'=>0,
                        'period'=>1
                    ],
                    [
                        'team_id'=>1,
                        'player_id'=>1 ,
                        'sensor'=>1,
                        'player_position'=>null,
                        'time_played'=>$faker->time('00:20:00'),
                        'distance_km'=>$faker->randomFloat(2),
                        'hid_distance_15_km'=>$faker->randomFloat(2),
                        'distance_speed_range_15_km'=>$faker->randomFloat(2),
                        'distance_speed_range_15_20_km'=>$faker->randomFloat(2),
                        'distance_speed_range_20_25_km'=>$faker->randomFloat(2),
                        'distance_speed_range_25_30_km'=>$faker->randomFloat(2),
                        'distance_speed_range_greater_30_km'=>$faker->randomFloat(2),
                        'no_of_sprint_greater_25_km'=>$faker->randomFloat(2),
                        'avg_speed_km'=>$faker->randomFloat(2),
                        'max_speed_km'=>$faker->randomFloat(2),
                        'max_acceleration'=>$faker->randomFloat(2),
                        'no_of_acceleration_3'=>$faker->randomFloat(2),
                        'no_of_acceleration_4'=>$faker->randomFloat(2),
                        'no_of_deceleration_3'=>$faker->randomFloat(2),
                        'no_of_deceleration_4'=>$faker->randomFloat(2),
                        'is_summary'=>0,
                        'period'=>2
                    ]

                );
            });

    }

}
