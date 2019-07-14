<?php

namespace App\Http\Controllers\api;

use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductCategory;
use App\Http\Resources\ProductCategory as CategoriesResource;
use Tymon\JWTAuth\JWTAuth;

class CategoriesController extends Controller
{
//    protected $user;


//    public function __construct()
//    {
//        $this->user = JWTAuth::parseToken()->authenticate();
//    }

    public function index(Request $request)
    {
        $jwt = new JWTAuth();
        dd($jwt->parseToken()->authenticate());
        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user_not_found'], 404);
        }
        if (!auth()->check()) {
            return response('login required', 421);
        }
//        return $this->user;
//        $credentials = $request->only('token');
//
//        if(auth()->validate($credentials)) {
//            // credentials are validtj
//            return "hello";
//        }


        $cats = ProductCategory::all();
        return CategoriesResource::collection($cats);
    }
}
