<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['first_team', 'second_team', 'name', 'match_date'];

    public static function addMatch($input){

        return self::create([
            'first_team' => $input['first_team'],
            'second_team' => $input['second_team'],
            'name' => $input['name'],
            'match_date' => date("Y-m-d H:i",strtotime($input['match_date']))
        ]);
    }
    
    public function team1()
    {
        return $this->belongsTo('App\Models\Team','first_team');
    }
    
    public function team2()
    {
        return $this->belongsTo('App\Models\Team','second_team');
    }
    
    public static function totalMatches(){
        
        $matches = self::with('team1','team2')->select("*");
        return $matches->orderBy('created_at', 'DESC');

    }
}
