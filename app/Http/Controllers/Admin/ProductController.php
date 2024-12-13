<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    protected function uploadImage(Request $request){

        if(!$request->hasFile('image')){
            return;
        }

        $file = $request->file('image');
        $path = $file->store('uploads/products',[
            'disk'=>'public'
        ]);

        return $path;

    }

    protected function getTags($tags){
        $tags = explode(',',$tags);

        $saved_tags = Tag::all();

        foreach ($tags as $tag) {
            # code...
            $stored_tags = $saved_tags->where('name',$tag)->first();
            if (!$stored_tags) {
                # code...
                $stored_tags = Tag::create([
                    'name'=>$tag,
                    'slug'=>Str::slug($tag)
                ]);
            }

            $tag_id []=$stored_tags->id;
        }

        return $tag_id;

    }

    public function index()
    {
        //

        $products = Product::with(['store','category'])
        ->latest()
        ->paginate();

        return view('admin.products.index',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stores = Store::get();
        $categories = Category::get();
        $product = new Product();

        $tags = implode(',',$product->tags()->pluck('name')->toArray());


        return view('admin.products.create',compact('stores','categories','product','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        try {
            //code...
            $request->merge([
                'slug'=>Str::slug($request->post('name'))
            ]);
            $data = $request->except('tags');
            $path = $this->uploadImage($request);

            $data['image'] = $path;

            $tags = explode(',',$request->post('tags'));

            $saved_tags = Tag::all();

            foreach ($tags as $tag) {
                # code...
                $stored_tags = $saved_tags->where('name',$tag)->first();
                if (!$stored_tags) {
                    # code...
                    $stored_tags = Tag::create([
                        'name'=>$tag,
                        'slug'=>Str::slug($tag)
                    ]);
                }

                $tag_id []=$stored_tags->id;
            }

            $product = Product::create($data);

            $product->tags()->sync($tag_id);

            return redirect()->route('products.index')->with('msg','added successfully');


        } catch (Exception $th) {
            //throw $th;
            return redirect()->back()->with('msg',$th->getMessage());
        }







    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //

        $product = Product::findOrFail($id);
        $stores = Store::get();
        $categories = Category::get();

        $tags = implode(',',$product->tags()->pluck('name')->toArray());

        return view('admin.products.update',compact('product','categories','stores','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request,$id)
    {
        //
        $product = Product::findOrFail($id);

        $request->merge([
            'slug'=>Str::slug($request->post('name'))
        ]);
        $data = $request->except(['image','tags']);
        $old_image = $product->image;

        $new_image = $this->uploadImage($request);

        if($new_image){
            $data['image']=$new_image;
        }

        // $tags = $request->post('tags');

        $tags = $this->getTags($request->post('tags'));
        $product->tags()->sync($tags);
        $product->update($data);

        if ($old_image && isset($new_image)) {
            # code...
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('products.index')->with('msg','updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $product = Product::findOrFail($id);

        $product->delete();
        // if ($product->image) {
        //     # code...
        //     Storage::disk('public')->delete($product->image);
        // }

        return redirect()->route('products.index')->with('deleted',$product->name . ' deleted successfully');
    }


    public function trash(){
        $products = Product::with(['store','category'])
        ->onlyTrashed()
        // ->orderby('deleted_at')
        ->paginate();

        return view('admin.products.trash',compact('products'));

    }

    public function restore($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();

        return redirect()->back()->with('msg',$product->name . " restored successfully");
    }

    public function forceDelete($id){
        $product  = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();

        return redirect()->back()->with('deleted',$product->name . " deleted successfully");
    }
}
