<?php

namespace App\Models;

use App\Mail\PlayerMail;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Models\PasswordReset;

class Player extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_user',
        'first_name', 'last_name','full_name','email','mobile','player_no', 'date_of_birth', 'image_path','gender', 'height', 'weight',
        'max_heart_rate','target_heart_rate','max_speed','track_heart_rate', 'sensor_no', 'position'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User','fk_user');
    }
    
    public static function addPlayer($input,$user_id,$resetPassword=false){
        
        if(isset($input['track_heart_rate'])){
            $input['track_heart_rate'] = 1;
        }else{
            $input['track_heart_rate'] = 0;
        }
        $input['fk_user'] = $user_id;
        $player = self::create($input);
        
        if($resetPassword){
            $result = PasswordReset::createToken($player->email);
            $data = ['message' => "<a href='".route('reset-password',['email'=>$player->email, 'token'=>$result->token])."'>Verify Email</a>"];
            if(env('SEND_PLAYER_EMAIL')){
                Mail::to($player->email)->send(new PlayerMail($data));
            }
        }
        
        return $player;
    }
    
    public static function updatePlayer($input, $playerId) {

        $player = Player::find($playerId);
        if ($player) {
            if (isset($input['track_heart_rate'])) {
                $input['track_heart_rate'] = 1;
            } else {
                $input['track_heart_rate'] = 0;
            }
            unset($input['image'],$input['role_id']);
            if (count($input) > 0) {
                foreach ($input as $key => $val) {
                    $player->$key = $val;
                }
                $player->save();
            }
        }

        return $player;
    }

    public static function checkIfAlreadyExists($email){
        
        return self::where('email',$email)->first();
    }
    
    public static function getOrCreatePlayer($input){
        
        $player = [];
        if(isset($input['name']) && !empty($input['name'])){
            $player = self::where('full_name', 'like', '%'.$input['name'].'%')->where('player_no',$input['player_no'])->first();
            if(!$player){
                $player = self::create([
                    'first_name' => $input['name'],
                    'last_name'  => $input['name'],
                    'full_name'  => $input['name'],
                    'player_no' => $input['player_no'],
                    'sensor_no' => $input['sensor'],
                    'position' => 0
                ]);
            }
        }
        return $player;
    }

    public static function totalPlayers($filter){
        
        $players = self::select("*");
        if(isset($filter['first_name']) && !empty($filter['first_name'])){
            $players = $players->where('first_name','like','%'.$filter['first_name'].'%');
        }
        if(isset($filter['last_name']) && !empty($filter['last_name'])){
            $players = $players->where('last_name','like','%'.$filter['last_name'].'%');
        }
        if(isset($filter['email']) && !empty($filter['email'])){
            $players = $players->where('email','like','%'.$filter['email'].'%');
        }
        return $players->orderBy('created_at', 'DESC');

    }

    public static function playerNoExists($playerNo){
        return self::where('player_no', $playerNo)->first();
    }
    
    public static function getAllPlayers(){
        
        $allPlayers = [];
        
        $players = Player::join('users','fk_user', 'users.id')
                ->select('first_name','last_name','players.email','players.id', 'users.id as user_id')
                ->get()
                ->toArray();
        
        if(count($players) > 0){
            foreach ($players as $key => $player){
                $allPlayers[$key]['label'] = $player['first_name'].' '.$player['last_name'].' ('.$player['email'].')';
                $allPlayers[$key]['value'] = $player['user_id'];
            }
        }
        return $allPlayers;
    }
}
