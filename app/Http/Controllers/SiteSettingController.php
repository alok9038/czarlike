<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

class SiteSettingController extends Controller
{
    public function view(){
        return view('admin.settings.site_setting');
    }

    public function logo(Request $request){
        $logo = SiteSetting::first();

        if($logo->logo !== null){
            File::delete("images/logo/".$logo->image);
        }

        $logo = time(). "." . $request->logo->extension();
        $request->logo->move(public_path("images/logo"),$logo);

        SiteSetting::first()->update([
            'logo'=>$logo
        ]);

        return redirect()->back()->with('success_msg','Logo successfully Changed!');
    }

    public function updateFavicon(Request $request){
        $logo = SiteSetting::first();

        if($logo->favicon !== null){
            File::delete("images/favicon/".$logo->image);
        }

        $logo = time(). "." . $request->favicon->extension();
        $request->favicon->move(public_path("images/favicon"),$logo);

        SiteSetting::first()->update([
            'favicon'=>$logo
        ]);

        return redirect()->back()->with('success_msg','Favicon successfully Changed!');

    }

    public function updateDetails(Request $request){

        SiteSetting::first()->update([
            'contact'=>$request->contact,
            'email'=>$request->email,
            'address'=>$request->address,
            'about'=>$request->about_us,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'github'=>$request->github,
        ]);

        Alert::toast('Site Details Successfully Updated!','success');
        return redirect()->back();
    }
}
