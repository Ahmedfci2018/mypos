<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::when($request->search , function ($q) use ($request){

            return $q->where('name' , 'like' , '%' .$request->search . '%' );
        })->latest()->paginate(3);
        return view('dashboard.categories.index',compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {
        //array for validations
        $rules=[];

        foreach (config('translatable.locales') as $locale){

            $rules += [$locale . '.name' => ['required' , Rule::unique('category_translations' , 'name')]];

        } // end of foreach

        $request->validate($rules);

        Category::create($request->all());

        //Noty
        session()->flash('success',__('site.added_successfully'));
        return redirect()->route('dashboard.categories.index');

    } //end of store function

    public function show(Category $category)
    {

    }

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        //array for validations
        $rules=[];

        foreach (config('translatable.locales') as $locale){

            $rules += [$locale . '.name' => ['required' , Rule::unique('category_translations' , 'name')->ignore($category->id , 'category_id')]];

        } // end of foreach

        $request->validate($rules);

        $category->update($request->all());

        session()->flash('success',__('site.updated_successfully'));
        return redirect()->route('dashboard.categories.index');

    } // end of update method

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
    } //end of destroy
}
