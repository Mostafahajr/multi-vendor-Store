

<x-form.input :type="'text'" :name="'name'" :value="old('name',$product->name)" :label="'Name'">

</x-form.input>


<x-form.select name="category_id" label="Category" :value="$categories" :selected="$product->category_id"></x-form.select>

<x-form.select name="store_id" label="Store" :value="$stores" :selected="$product->store_id"></x-form.select>

{{-- <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Parent Category</label>
    <select name="category_id" id="" @class([
        'form-control',
        'form-select',
        'is-invalid'=> $errors->has('category_id')
        ])>
        <option value="">choose value</option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}" @selected(old('category_id',$category->id) == $category->id)>{{$category->name}}</option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div> --}}

<x-form.input :type="'text'" :name="'price'" :value="old('price',$product->price)" :label="'Price'">


</x-form.input>

<x-form.input :type="'text'" name="compare_price" :value="old('compare_price',$product->compare_price)" :label="'Compare Price'">


</x-form.input>

<x-form.input :type="'file'" :name="'image'" :value="old('image',$product->image)" :label="'Image'">
</x-form.input>
@if ($product->image)

    <img src="{{asset('storage/' . $product->image)}}" class="img-thumbnail rounded my-3" style="width: 200px;height:200px" alt="...">

@endif

<x-form.textarea :name="'description'" :value="old('description',$product->description)" :label="'Description'">
</x-form.textarea>



<x-form.radio-input name="status" :options="['Active'=>'active','Archived'=>'archived','Draft' => 'draft']" :selected="old('status',$product->status)"></x-form.radio-input>


<x-form.input :type="'text'" name="tags" :value="old('tags',$tags)" :label="'Tags'" />


{{-- <div class="form-check">
    <input @class([
        'form-check-input',
        'is-invalid'=> $errors->has('status')
        ]) type="radio" value="archived" name="status" @checked(old('status',$product->status) == 'archived')>
    <label class="form-check-label" >
      Archive
    </label>
    @error('status')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div> --}}




<button type="submit" class="btn btn-primary">{{$button_label ?? 'Submit'}}</button>
