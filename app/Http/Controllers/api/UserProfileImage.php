<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileImage extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:api');
    }

    public function getImage(){
        $user = auth()->user();

        return $imagePath =  asset('images/'. $user->avatar);
        return response()->download($imagePath, 'avatar_image');
    }

    public function uploadImage(Request $request){
        request()->validate([
            'user_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('user_photo');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $path = $image->move(public_path("/images"), $fileName);
        $photoUrl = url('/images/' . $fileName);

        $user = auth()->user();
        $user->avatar = $fileName;
        $user->save();
        return response()->json(['url' => $photoUrl], 200);
    }
}
