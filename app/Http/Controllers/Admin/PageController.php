<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function storeAbout(Request $request){
        $request->validate(['content'=>'required']);

        $page = Page::first();
        $page->about = $request->content;
        $page->save();

        if($page){
            toast('About content updated','success');
        }
        else{
            toast('something went wrong!');
        }

        return redirect()->back();
    }
    public function storeContact(Request $request){
        $request->validate(['content'=>'required']);

        $page = Page::first();
        $page->contact = $request->content;
        $page->save();

        if($page){
            toast('Contact content updated','success');
        }
        else{
            toast('something went wrong!');
        }

        return redirect()->back();
    }
    public function storePolicy(Request $request){
        $request->validate(['content'=>'required']);

        $page = Page::first();
        $page->policy = $request->content;
        $page->save();

        if($page){
            toast('Policy content updated','success');
        }
        else{
            toast('something went wrong!');
        }

        return redirect()->back();
    }
    public function storeTerm(Request $request){
        $request->validate(['content'=>'required']);

        $page = Page::first();
        $page->t_and_c = $request->content;
        $page->save();

        if($page){
            toast('Terms and Conditions  content updated','success');
        }
        else{
            toast('something went wrong!');
        }

        return redirect()->back();
    }
    public function storeRRC(Request $request){
        $request->validate(['content'=>'required']);

        $page = Page::first();
        $page->rrc = $request->content;
        $page->save();

        if($page){
            toast('Refund, Return and Cancellation content updated','success');
        }
        else{
            toast('something went wrong!');
        }

        return redirect()->back();
    }
}
