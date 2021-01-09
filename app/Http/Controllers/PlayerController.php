<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $json = '[
            {
                "id": 1,
                "username": "jon.doe@example.com",
                "email": "jon.doe@example.com",
                "external_id": "1",
                "athlete_profile": {
                    "id": 1,
                    "external_id": "e6195b18-2515-410d-a48e-1009d12f2320",
                    "first_name": "Usain",
                    "last_name": "Bolt",
                    "gender": "M",
                    "weight": 94,
                    "height": 1.95,
                    "birth_date": "1986-08-21",
                    "max_heart_rate": 140
                }
            },
            {
                "id": 2,
                "username": "md_test@gmail.com",
                "email": "md_test@gmail.com",
                "external_id": "2",
                "athlete_profile": {
                    "id": 2,
                    "external_id": "e6195b18-2515-410d-a48e-1009d12f2321",
                    "first_name": "Maha",
                    "last_name": "Dev",
                    "gender": "M",
                    "weight": 85,
                    "height": 7.2,
                    "birth_date": "1986-08-20",
                    "max_heart_rate": 125
                }
            }
        ]';
        
        $data['players'] = json_decode($json,true);
        
        return view('players.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('players.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
