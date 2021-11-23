<?php

namespace App\Http\Controller\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller
{
    public function viewSizes(){
        $data['sizes'] = Size::all();
        return view('admin.products.attributes.size',$data);
    }
    public function addSize(Request $request){
        $request->validate(['size'=>'required']);

        $size = new Size();
        $size->size = $request->size;
        $size->save();

        if($size){
            toast('Size has been added!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }

    public function deleteSize(Request $request){
        $id = $request->size_id;

        if($id == null){
            return redirect()->back();
        }

        $query = Size::where('id',$id)->delete();

        if($query){
            toast('Size has been deleted!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }

    public function active_deactive(Request $request){
        $id = $request->size_id;

        $query = Size::where('id',$id)->first();

        if($query->status == true){
            $active = Size::find($id)->update(['status'=>false]);

            if($active){
                toast('Size has been Deactived!','success');
            }
            else{
                toast('something went wrong','error');
            }
        }
        else{
            $active = Size::find($id)->update(['status'=>true]);

            if($active){
                toast('Size has been actived!','success');
            }
            else{
                toast('something went wrong','error');
            }
        }

        return redirect()->back();


    }

    public function updateSize(Request $request){
        $request->validate(['size'=>'required','size_id'=>'required']);

        $size = Size::find($request->size_id);
        $size->size = $request->size;
        $size->status = $request->status;
        $size->save();

        if($size){
            toast('Size has been upated!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }
    // add color
    public function viewColors(){
        $data['colors'] = Color::get();
        return view('admin.products.attributes.colors',$data);
    }

    public function addColor(Request $request){
        $request->validate([
            'color_name'=>'required',
            'color'=>'required',
        ]);

        $color = new Color();
        $color->color_name = $request->color_name;
        $color->color = $request->color;
        if($request->status !== null){
            $color->status = $request->status;
        }
        $color->save();

        if($color){
            toast('Color has been added!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }

    public function updateColor(Request $request){
        $request->validate([
            'color_name'=>'required',
            'color'=>'required',
            'color_id'=>'required'
        ]);

        $color = Color::find($request->color_id);
        $color->color_name = $request->color_name;
        $color->color = $request->color;
        $color->status = $request->status;
        $color->save();

        if($color){
            toast('Color has been updated!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }

    public function deleteColor(Request $request){
        $id = $request->color_id;

        if($id == null){
            return redirect()->back();
        }

        $query = Color::where('id',$id)->delete();

        if($query){
            toast('Color has been deleted!','success');
        }
        else{
            toast('something went wrong','error');
        }
        return redirect()->back();
    }

    public function active_deactive_color(Request $request){
        $id = $request->color_id;

        $query = Color::where('id',$id)->first();

        if($query->status == true){
            $active = Color::find($id)->update(['status'=>false]);

            if($active){
                toast('Color has been Deactived!','success');
            }
            else{
                toast('something went wrong','error');
            }
        }
        else{
            $active = Color::find($id)->update(['status'=>true]);

            if($active){
                toast('Color has been actived!','success');
            }
            else{
                toast('something went wrong','error');
            }
        }

        return redirect()->back();

    }
}
