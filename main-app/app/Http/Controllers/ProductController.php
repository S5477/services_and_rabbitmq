<?php

namespace App\Http\Controllers;

use App\Jobs\ProductLikedJob;
use App\Models\Product;
use App\Models\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function like($id, Request $request) {
       $res = Http::get(config('app.admin_app').'/api/user');
       $user = $res->json();

       $productUser = ProductUser::create([
           'user_id' => $user['id'],
           'product_id' => $id
       ]);

       ProductLikedJob::dispatch($productUser->product_id)->onQueue('admin_queue');

       return true;
    }
}
