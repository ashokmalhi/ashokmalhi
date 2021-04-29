<?php

namespace App\Models;

use App\Mail\PlayerMail;
use Illuminate\Database\Eloquent\Model;
use Mail;
use App\Models\PasswordReset;

class Coach extends Model
{

    protected $table = 'coaches';
    
    protected $fillable = ['fk_user','first_name', 'last_name','email','mobile', 'date_of_birth', 
        'image_path','gender', 'height', 'weight'
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
    
    public static function addCoach($input,$user_id,$resetPassword=false){
        
        $input['fk_user'] = $user_id;
        $coach = self::create($input);
        
        if($resetPassword){
            $result = PasswordReset::createToken($coach->email);
            $data = ['message' => "<a href='".route('reset-password',['email'=>$coach->email, 'token'=>$result->token])."'>Verify Email</a>"];
            if(env('SEND_PLAYER_EMAIL')){
                Mail::to($coach->email)->send(new PlayerMail($data));
            }
        }
        
        return $coach;
    }
    
    public static function updateCoach($input, $coachId) {

        $coach = Coach::find($coachId);
        if ($coach) {
            unset($input['image']);
            if (count($input) > 0) {
                foreach ($input as $key => $val) {
                    $coach->$key = $val;
                }
                $coach->save();
            }
        }

        return $coach;
    }

    public static function checkIfAlreadyExists($email){
        
        return self::where('email',$email)->first();
    }
    
    public static function getOrCreateCoach($input){
        
        $coach = [];
        if(isset($input['name']) && !empty($input['name'])){
            $coach = self::where('full_name', 'like', '%'.$input['name'].'%')->where('player_no',$input['player_no'])->first();
            if(!$coach){
                $coach = self::create([
                    'first_name' => $input['name'],
                    'last_name'  => $input['name'],
                    'full_name'  => $input['name'],
                    'player_no' => $input['player_no'],
                    'sensor_no' => $input['sensor'],
                    'position' => 0
                ]);
            }
        }
        return $coach;
    }

    public static function totalCoaches($filter){
        
        $coaches = self::select("*");
        if(isset($filter['first_name']) && !empty($filter['first_name'])){
            $coaches = $coaches->where('first_name','like','%'.$filter['first_name'].'%');
        }
        if(isset($filter['last_name']) && !empty($filter['last_name'])){
            $coaches = $coaches->where('last_name','like','%'.$filter['last_name'].'%');
        }
        if(isset($filter['email']) && !empty($filter['email'])){
            $coaches = $coaches->where('email','like','%'.$filter['email'].'%');
        }
        return $coaches->orderBy('created_at', 'DESC');

    }

    public static function playerNoExists($coachNo){
        return self::where('player_no', $coachNo)->first();
    }
    
    public static function getAllCoaches(){
        
        $allCoaches = [];
        
        $coaches = Coach::join('users','fk_user', 'users.id')
                ->select('first_name','last_name','coaches.email','coaches.id', 'users.id as user_id')
                ->get()
                ->toArray();
        
        if(count($coaches) > 0){
            foreach ($coaches as $key => $coach){
                $allCoaches[$key]['label'] = $coach['first_name'].' '.$coach['last_name'].' ('.$coach['email'].')';
                $allCoaches[$key]['value'] = $coach['user_id'];
            }
        }
        return $allCoaches;
    }
}
