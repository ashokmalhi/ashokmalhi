<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\StatDetail;
use Image;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Models\Role;

class CoachController extends Controller
{
    public function index()
    {
        return view('coaches.list');
    }

    public function allCoaches(Request $request){

        $input = $request->all();
        $limit = $request->input('length');
        $start = $request->input('start');

        $data = array();
        
        $coaches = Coach::totalCoaches($input)->offset($start)
                ->limit($limit)
                ->get();
                    
        if(!empty($coaches))
        {
            foreach ($coaches as $coach)
            {
                $nestedData['name'] = $coach->first_name .' '.$coach->last_name;
                $nestedData['email'] = $coach->email;
                $nestedData['mobile'] = $coach->mobile;
                $nestedData['height'] = $coach->height ?? "NA";
                $nestedData['weight'] = $coach->weight ?? "NA";
                $nestedData['actions'] = '<a href="/coaches/'.$coach->id.'/edit" class="btn btn-primary btn-sm">Edit</a>';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval(count($coaches)),
            "recordsFiltered" => intval(count($coaches)),
            "data"            => $data
        );
        echo json_encode($json_data);
    }

    public function create()
    {
        //
        $roles = Role::where('id','!=',1)->get();
        return view('coaches.create',compact('roles'));
    }

  
    public function store(Request $request)
    {
        $this->validate($request, [
                    'first_name'	=> 'required',
                    'email'			=> 'required|email|unique:users,email'
            ]);
        $input = $request->except('_token');
        if ($request->hasFile('image')) {
            $basePath = 'images/coaches/';
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $input['image_path'] = $basePath.$fileName;
            $img = Image::make($image->getRealPath());
            Storage::disk('local')->put('public/'.$basePath.'/'.$fileName, $img->stream(), 'public');
        }

        $input['role_id'] = 2;
        $result = User::addUser($input);
        
        $result = Coach::addCoach($input,$result->id,true);
        
        if(isset($result->id)){
            return redirect('/coaches')->with('success', 'Coach created successfully!');
        }else{
            return back()->withInput()->with('error', 'Something went wront while creating new coach!');
        }
    }
    
    public function edit($id)
    {
        $coach = Coach::with('user')->find($id);
        $roles = Role::where('id','!=',1)->get();
        return view('coaches.edit',compact('coach','id','roles'));
    }

    
    public function update(Request $request, $id)
    {
        //
        $coach = Coach::find($id);
        if ($coach) {
            $input = $request->except('_token','_method');
            if ($request->hasFile('image')) {
                $basePath = 'images/coaches/';
                $image = $request->file('image');
                $fileName = time() . '.' . $image->getClientOriginalExtension();
                $input['image_path'] = $basePath . $fileName;
                $img = Image::make($image->getRealPath());
                Storage::disk('local')->put('public/' . $basePath . '/' . $fileName, $img->stream(), 'public');
            }

            $updateUserRes = User::updateUser($input,$coach->fk_user);

            $updateCoachRes = Coach::updateCoach($input, $coach->id);

            return redirect('/coaches')->with('success', 'Coach updated successfully!');
            
        } else {
            return redirect('/coaches')->with('error', 'Coach not found against the provided ID!');
        }
    }

    
    public function destroy($id)
    {
        //
    }
}
