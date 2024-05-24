<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    private $category;

    public function __construct(Category $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    public function index()
    {
        $all_categories = $this->category->orderBy('name')->get();

        // count uncategorized posts
        $all_posts = $this->post->all();
        $count = 0;
        foreach($all_posts as $post){
            if($post->categoryPosts->count() == 0){
                $count++;
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
                                            ->with('uncategorized_count', $count);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:50|unique:categories,name'
        ]);
        $this->category->name = ucwords($request->name); //technology => Technology
        $this->category->save();
        return redirect()->back();
    }

    public function edit($id){
        $category = $this->category->findOrFail($id);

        return view('admin.categories.edit')->with('all_categories', $all_categories)->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categ_name' => 'required|max:50|unique:categories,name,'. $id
            // don't use "category" because it's already used store()
        ]);

        $categ = $this->category->findOrFail($id);
        $categ->name = $request->categ_name;
        // [new_category]->[mysql_column]=$request->[new_category_name]

        $categ->save();

        return redirect()->back();
    }

    public function destroy($id){

        $category = $this->category->findOrFail($id);
        $category->forceDelete(); //permanent delete
        
        return redirect()->back();
    }
}
