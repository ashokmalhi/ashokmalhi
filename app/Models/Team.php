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
        
        $roleId = Auth()->user()->role_id;
        $player = Player::where('fk_user',Auth()->user()->id)->select('id')->first();
        if($roleId != 1){
            $query = self::join('team_players as tm','tm.team_id','teams.id');
            if($roleId == 2){
                $query = $query->where('tm.player_id',$player->id)->where('tm.is_coach',1);
            }else if($roleId == 3){
                $query = $query->where('tm.player_id',$player->id)->where('tm.is_manager',1);
            }
            return $query->select('teams.*')->orderBy('teams.created_at', 'DESC');
        }else{
            return self::select("*")->orderBy('created_at', 'DESC');
        }
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
