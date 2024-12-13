<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //


        $request = request();



        $categories = Category::with(['parent'])
        ->withCount('products')
        ->latest()
        ->paginate(6);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Category::all();
        $category = new Category();

        return view('admin.categories.create',compact('parents','category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //dd($request);
        //$request->validate(Category::rules());
        $request->merge(
            [
                'slug' => Str::slug($request->post('name'))
            ]
        );

        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);

        Category::create($data);

        return redirect()->back()->with('msg','Category was Added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $category = Category::findorfail($id);

        $parents = Category::where("id",'<>',$id)
        ->where('parent_id','<>',$id)
        ->get();
        return view('admin.categories.update',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request,$id)
    {
        //
        // $request->validate(Category::rules($id));
        $category  = Category::findorfail($id);

        $old_image = $category->image;

        $data = $request->except('image');
        $new_image = $this->uploadImage($request);

        if ($new_image) {
            # code...
            $data['image'] = $new_image;
        }




        $category->update($data);

        if ($old_image && isset($new_image)) {
            # code...
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('categories.index')->with('msg','update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $category = Category::findorfail($id);

        $category->delete();

        return redirect()->back()->with('deleted','Deleted successfully');
    }


    protected function uploadImage(CategoryRequest $request) {

        if (!$request->hasFile('image')) {
            # code...
            return;
        }

        $file = $request->file('image');
        $path = $file->store('uploads/categories',[
            'disk'=>'public',
        ]);

        return $path;

    }

    public function trash(){
        $categories = Category::onlyTrashed()->paginate();

        return view('admin.categories.trash',compact('categories'));
    }

    public function restore(Request $request,$id){
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->restore();

        return redirect()->route('categories.index')->with('msg',"category {{$category->name}} is restored");
    }

    public function forceDelete($id){
        $category = Category::onlyTrashed()->findOrFail($id);

        $category->forceDelete();

        $old_image = $category->image;
        if ($old_image) {
            # code...
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('categories.trash')->with('deleted',"category $category->name is Deleted forever");
    }

}
