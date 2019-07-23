<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories=Category::all();
        $products = Product::when($request->search , function ($q) use ($request){

            return $q->whereTranslationLike('name','%'.$request->search . '%');

        })->when($request->category_id, function ($q) use ($request){

            return $q->where('category_id' , $request->category_id);

        })->latest()->paginate(3);

        return view('dashboard.products.index',compact('categories','products'));

    }// end of index function

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create' ,compact('categories'));

    }// end of create function

    public function store(Request $request)
    {
        //validations
        $rules=[
            'category_id' =>'required',
        ];

        foreach (config('translatable.locales') as $locale){

            $rules += [
                $locale . '.name' => 'required|unique:product_translations,name' ,
                $locale . '.description' => 'required',
            ];
        }
        $rules +=[
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' =>'required',
        ];

        $request->validate($rules);
        $request_data=$request->all();

        if($request->image)
        {
            \Intervention\Image\Facades\Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image']=$request->image->hashName();

        } //end of if


        Product::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.products.index');
    }// end of store function

    public function show(Product $product)
    {
        //
    }// end of show function

    public function edit(Product $product)
    {
        $categories =Category::all();
        return view('dashboard.products.edit',compact('categories','product'));
    }// end of edit function

    public function update(Request $request, Product $product)
    {
        //validations
        $rules=[
            'category_id' =>'required',
        ];

        foreach (config('translatable.locales') as $locale){

            $rules += [
                $locale . '.name' => ['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')] ,
                $locale . '.description' => 'required',
            ];
        }
        $rules +=[
            'purchase_price' =>'required',
            'sale_price' =>'required',
            'stock' =>'required',
        ];

        $request->validate($rules);
        $request_data=$request->all();

        if($request->image)
        {
            if($product->image != 'default.png'){

                Storage::disk('public_uploads')->delete('/product_images/'. $product->image);

            }// end of if
            \Intervention\Image\Facades\Image::make($request->image)->resize(null, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('uploads/product_images/'.$request->image->hashName()));

            $request_data['image']=$request->image->hashName();

        } //end of if


        $product->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');
    }// end of update function

    public function destroy(Product $product)
    {
        if ($product->image != 'default.png'){

            Storage::disk('public_uploads')->delete('/product_images/'. $product->image);

        }//end of if

        $product->delete();

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.products.index');

    } // end of destroy function
}
