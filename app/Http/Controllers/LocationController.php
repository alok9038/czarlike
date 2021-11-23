<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{

    public function fetchState(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'country_id'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $data['states'] = State::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCountries(){
        $data['country'] = Country::all();
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'state_id'=>'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        $data['cities'] = City::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function countries(){
        $data['country'] = Country::all();
        return view('admin.location.country',$data);
    }
    public function states(){
        $data['states'] = State::all();
        return view('admin.location.state',$data);
    }
    public function cities(){
        $data['cities'] = City::all();
        return view('admin.location.city',$data);
    }
}
