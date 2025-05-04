<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_category()
    {
        $data= Category::all();
        return view('admin.category',compact('data'));
      
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category;
       
        $category->save();
        toastr()->addSuccess('Category added successfully!');
        

        return redirect()->back();
    }

   public function delete_category($id)
    {
        $data = Category::find($id);
        $data->delete();
        toastr()->addSuccess('Category deleted successfully!');
        return redirect()->back();
    }
    public function edit_category($id)
    {
        $data = Category::find($id);
       
        return view ('admin.edit_category',compact('data'));
    }
    public function update_category(Request $request,$id){
      
        $data=Category::find($id);
        $data->category_name=$request->category;
        $data->save();
        toastr()->addSuccess('Category Updated successfully!');
        return redirect('/view_category');
    }
    public function add_product(){
        $categories = Category::all(); // Fetch all categories from the database
        return view('admin.add_product', compact('categories'));
    }
    public function upload_product(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->image = $request->image;
        $data->price = $request->price;
        $data->category = $request->category;
        $data->quantity = $request->quantity;

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('product', $filename);
            $data->image = $filename;
        }

        $data->save();
        toastr()->addSuccess('Product added successfully!');
        
        return redirect()->back();
    }
    public function view_product()
    {
        $data = Product::paginate(3);
        return view('admin.view_product', compact('data'));
    }
    public function delete_product($id)
    {
        $data = Product::find($id);
        $data->delete();
        toastr()->addSuccess('Product deleted successfully!');
        return redirect()->back();
    }
    public function update_product($id)
    {
        $data = Product::find($id);
        return view('admin.update_product', compact('data'));
    }
}
