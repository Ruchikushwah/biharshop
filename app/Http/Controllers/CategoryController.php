<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $categories = Category::all();
       $mainCategory = Category::where('parent_id',null)->get();
        return view('admin.managecategories')->with('categories',$categories)->with('mainCategories',$mainCategory);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //no need
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([

        'cat_title' => 'required|max:255',
        'cat_description'=> 'required|max:255',
    
    ]);
    $cat = new Category();
    $cat->cat_title = $request->cat_title;
    $cat->cat_slug = str::slug($request->cat_title);
    $cat->cat_description = $request->cat_description;
    $cat->parent_id = $request->parent_id;
    $cat->save();

    return redirect()->route('category.index')->with('success', ' category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([

            'cat_title' => 'required|max:255',
            'cat_description'=> 'required|max:255',
            
    
    
    
        ]);
        $cat = $category;
        $cat->cat_title = $request->cat_title;
        $cat->cat_slug = str::slug($request->cat_title);
        $cat->cat_description = $request->cat_description;
        $cat->parent_id = $request->parent_id;
        $cat->save();
    
        return redirect()->route('category.index')->with('success', ' category updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->Children()->exists()){
            return redirect()->route('category.index')->with('error','this category has  subcategories please delete them first.');

        }
        $category->delete();
        return redirect()->route('category.index')->with('success','category deleted successfully.');
    }
}
