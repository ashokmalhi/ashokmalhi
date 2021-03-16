<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];

    public function teamPlayer(){
        return $this->hasMany('App\Models\TeamPlayer','team_id','id');
    }
    
    public static function addTeam($input){
        
        $team = self::create($input);
        return $team;
    }

    public static function getAllTeams($filter){
        
        return self::select("*")->orderBy('created_at', 'DESC');

    }

    public static function updateTeam($input,$id){
        $team = self::find($id);
        $team->name = $input['name'];
        $team->sport_id = $input['sport_id'];
        if(isset($input['image'])){
            $team->image = $input['image'];
        }
        
        $team->save();
        return $team;
    }
}
