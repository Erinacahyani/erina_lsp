<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;


class CategoryController extends Controller
{
    public function index()
    {
    $categories = Category::orderBy('created_at', 'DESC');
    return view('categories.index', compact('categories'));
    }

    public function add(Request $request)
    {
        $categories = new categories;
        $categories->nama = $request->nama;
        $categories->save();
        return redirect('/categories');
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        return view('categories.edit')->with('categories', $categories);
    }

    public function update(Request $request)
    {
        $categories = Category::find($request->$id);
        $categories->nama = $request->nama;
        $categories->save();
        return redirect('/categories');
    }

    public function delete($id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return redirect(url('/categories'));
    }
}
