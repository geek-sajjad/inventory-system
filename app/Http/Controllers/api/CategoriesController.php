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
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $cats = ProductCategory::all();
        return CategoriesResource::collection($cats);
    }
}
