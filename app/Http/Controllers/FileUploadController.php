<?php

namespace App\Http\Controllers;

use App\User;
use Faker\Provider\File;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('auth.profile', compact('user'));
    }

    public function add(Request $request){

        request()->validate([

            'image_input' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);


        $image = $request->file('image_input');
        $input['imageName'] = time() . '.' . $image->getClientOriginalExtension();



        $destanationPath = public_path('/images');
        $image->move($destanationPath, $input['imageName']);

        $user = auth()->user();
        $user->avatar = $input['imageName'];
        $user->save();
        return redirect()->back()->with('status', 'image is uploaded successfully');
    }

    public function delete(){
        $user = auth()->user();
        if($user->avatar){

              $image_path = public_path("images/". $user->avatar);  // Value is not URL but directory file path
            if(\Illuminate\Support\Facades\File::exists($image_path)) {
                \Illuminate\Support\Facades\File::delete($image_path);
                $user->avatar = 'user.jpg';
                $user->save();
            }else{
                return redirect()->back()->with('error', 'file not found');
            }
        }else{
            return "you dont have image";
        }
        return redirect()->back()->with('status', 'profile image deleted successfully');
    }
}
