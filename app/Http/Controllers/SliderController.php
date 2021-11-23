<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function viewSliders(){
        $data['sliders'] = Slider::all();
        return view('admin.slider',$data);
    }

    public function viewCreateSlider(){
        return view('admin.addSlider');
    }


    public function createSlider(Request $request){
        $request->validate([
            'slider_image' => 'required',
            // 'url' => 'required',
        ]);

        $image = time(). "." . $request->slider_image->extension();
        $request->slider_image->move(public_path("images/slider"),$image);


        $slider = new Slider();
        $slider->linked_by = $request->linked_by;
        $slider->url = $request->url;
        $slider->image = $image;
        $slider->category = $request->category;
        $slider->subcategory = $request->subcategory;
        $slider->childcategory = $request->childcategory;
        $slider->product = $request->product;
        $slider->heading_text = $request->heading;
        $slider->subheading_text = $request->subheading;
        $slider->sub_heading_color = $request->sub_heading_color;
        $slider->heading_color = $request->heading_color;
        $slider->button_text = $request->button_text;
        $slider->button_text_color = $request->button_text_color;
        $slider->button_bg_color = $request->button_bg_color;
        $slider->status = $request->status;
        $slider->save();

        toast('Slider successfully Inserted!','success');
        return redirect()->route('super.admin.slider.view');
    }

    public function viewUpdateSlider(Request $request){
        $id = $request->slider_id;
        $data['slider'] = Slider::where('id',$id)->first();
        return view('admin.editSlider',$data);
    }

    public function updateSlider(Request $request){

        $slider = Slider::find($request->slider_id);
        $slider->linked_by = $request->linked_by;
        $slider->url = $request->url;
        if($request->has('image')){
            $image = time(). "." . $request->slider_image->extension();
            $request->slider_image->move(public_path("images/slider"),$image);
            $slider->image = $image;
        }
        $slider->category = $request->category;
        $slider->subcategory = $request->subcategory;
        $slider->childcategory = $request->childcategory;
        $slider->product = $request->product;
        $slider->heading_text = $request->heading;
        $slider->subheading_text = $request->subheading;
        $slider->sub_heading_color = $request->sub_heading_color;
        $slider->heading_color = $request->heading_color;
        $slider->button_text = $request->button_text;
        $slider->button_text_color = $request->button_text_color;
        $slider->button_bg_color = $request->button_bg_color;
        $slider->status = $request->status;
        $slider->save();

        toast('Slider successfully Updated!','success');
        return redirect()->route('super.admin.slider.view');
    }

    public function deleteSlider(Request $request){
        $id = $request->slider_id;

        $query = Slider::where('id',$id)->delete();
        if($query){
            toast('slider successfully deleted','success');
        }
        else{
            toast('something went wrong','error');
        }

        return redirect()->back();
    }

    public function changeStatus(Request $request){
        $id = $request->category_id;

        if($request->status == 1){
            Slider::where('id',$id)->update([
                'status'=>'deactive',
            ]);
            toast('Slider successfully Deactivated!','success');
        }elseif($request->status == 0){
            Slider::where('id',$id)->update([
                'status'=>'active',
            ]);
            toast('Slider successfully Deactivated!','success');
        }else{
            toast('Something Went Wrong!','error');
        }

        return redirect()->back();

    }
}
