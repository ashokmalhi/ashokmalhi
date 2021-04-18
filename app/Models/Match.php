<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['first_team', 'second_team', 'name'];

    public function addMatch($input){

        return self::create([
            'first_team' => $input['first_team'],
            'second_team' => $input['second_team'],
            'name' => $input['name']
        ]);
    }
}
