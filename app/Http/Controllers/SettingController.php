<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jackiedo\DotenvEditor\Facades\DotenvEditor;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    public function mailSetting(){
        return view('admin.settings.mail_setting');
    }

    public function mailUpdate(Request $request){
        $input = $request->all();

        $env_keys_save = DotenvEditor::setKeys([
            'MAIL_FROM_NAME' => $input['MAIL_FROM_NAME'],
            'MAIL_DRIVER' => $input['MAIL_DRIVER'],
            'MAIL_FROM_ADDRESS' => $input['MAIL_FROM_ADDRESS'],
            'MAIL_HOST' => $input['MAIL_HOST'],
            'MAIL_PORT' => $input['MAIL_PORT'],
            'MAIL_USERNAME' => $input['MAIL_USERNAME'],
            'MAIL_PASSWORD' => $input['MAIL_PASSWORD'],
            'MAIL_ENCRYPTION' => $input['MAIL_ENCRYPTION'],
        ]);

        $env_keys_save->save();

        Alert::toast('Mail settings has been updated !','success');
        return redirect()->back();
    }
}
