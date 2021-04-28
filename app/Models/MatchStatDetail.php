<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchStatDetail extends Model
{
    protected $fillable = ['match_id','player_id','time_played', 'x_position', 'y_position', 'lat', 'long', 'speed', 'hr', 'num_sat' ,'h_dop'];

    public static function addBulkStat($input){

        return MatchStatDetail::insert($input);
    }
}
