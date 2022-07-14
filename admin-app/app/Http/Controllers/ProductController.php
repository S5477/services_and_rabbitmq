<?php

namespace App\Http\Controllers;

use App\Jobs\CreateProductJob;
use App\Jobs\DeleteProductJob;
use App\Jobs\UpdateProductJob;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return Product::all();
    }

    public function show($id) {
        return Product::find($id);
    }

    public function store(Request $request) {
        $product = Product::create($request->all());

        CreateProductJob::dispatch($product->toArray())->onQueue('main_queue');

        return $product;
    }

    public function update($id, Request $request) {
        $product = Product::find($id);
        $product->update($request->all());
        $product->refresh();

        UpdateProductJob::dispatch($product)->onQueue('main_queue');

        return $product;
    }

    public function destroy($id) {
        Product::destroy($id);

        DeleteProductJob::dispatch($id)->onQueue('main_queue');

        return true;
    }
}
