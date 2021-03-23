<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;

class DashboardController extends Controller
{
    public function dashboard(){
        
        $userId = Auth::user()->id;
        $player = Player::where('fk_user',$userId)->first();
        $age = '';
        session(['player' => $player]);
        if(isset($player->date_of_birth) && !empty($player->date_of_birth)){
            $age = calculateAge($player->date_of_birth);
        }
        return view('dashboard',compact('player','age'));
    }
    
    public function dashboard1(){
        
        return view('dashboard1');
    }

    public function getStats(){
        $result = array();
        $response = array(
            'label'=>array('S.Jones','P.Stephenson','J.Weitering','J.Davis', 'K.Williams', 'J.Jeremy', 'J.Jeremy'),
            'value'=>array(4,5,2,1,8,7,9)
            );

        $count1 = 7;
        $response['value'][0] = $count1;
        array_push($result,$response);

        $label   = array(
            'label'=>array('Walk', 'Jog', 'Run'),
            'value'=>array(3,2,1)
            );

        array_push($result,$label);
        return $result;
    }
}
