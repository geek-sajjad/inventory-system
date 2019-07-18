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
}
