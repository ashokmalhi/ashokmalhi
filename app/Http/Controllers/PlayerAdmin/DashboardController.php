<?php

namespace App\Http\Controllers\PlayerAdmin;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Models\MatchDetail;
use App\Models\MatchStatDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Player;

class DashboardController extends Controller
{
    public function dashboard(){

        $player = Auth::user();

        $matchDetails = (MatchDetail::getMatchDetailsById(0,0,0,6));

        $matchDetails = $matchDetails == null ?? $matchDetails[0];



        //$DistByDate = $this->getIntervalByDate();

        //$DistByMin = MatchStatDetail::getIntervalByMinute($player->id,1);

        //$topStats = $this->getStats();
        return view('player_admin.dashboard',compact('matchDetails','player'));
    }

    public function dashboard1(){

        return view('dashboard1');
    }


    public function getDistanceInterval(){
        $player = Auth::user();

        $dt = MatchStatDetail::getIntervalByDate($player->id);

        return $dt;
    }

    public function getIntervalByMin(){

    }
}
