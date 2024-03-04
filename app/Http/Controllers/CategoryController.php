<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(Request $request){

        $request->validate([
            'name' => 'required'
        ]);

        $new_category = new Category;
        $new_category->name = $request->input('name');
        $new_category->save();

        return response()->json([
            'status' => 200,
            'message' => 'Categoria creada'
        ]);
    }

    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->update();

        return response()->json([
            'status' => 200,
            'message' => 'Category updated'
        ]);
    }

    public function list(){

        $categories = Category::with('tasks')->get();

        return response()->json([
            'status' => 200,
            'categories' => $categories
        ]);
    }

    public function delete($id){

        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Category deleted'
        ]);
    }
}
