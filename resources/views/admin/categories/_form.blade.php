<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" @class([
        'form-control',
        'is-invalid'=> $errors->has('name')
        ])
        name="name" value="{{old('name',$category->name)}}"
    >
    @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
<div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Parent Category</label>
    <select name="parent_id" id="" @class([
        'form-control',
        'form-select',
        'is-invalid'=> $errors->has('parent_id')
        ])>
        <option value="">choose value</option>
        @foreach ($parents as $parent)
            <option value="{{$parent->id}}" @selected(old('parent_id',$category->id) == $parent->id)>{{$parent->name}}</option>
        @endforeach
    </select>
    @error('parent_id')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Image</label>
    <input type="file"  @class([
        'form-control',
        'is-invalid'=> $errors->has('image')
        ]) name="image">
    @error('image')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
    @if ($category->image)
        <img src="{{asset('storage/' . $category->image)}}" class="img-thumbnail rounded" style="width: 200px;height:200px" alt="...">
    @endif
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea   @class([
        'form-control',
        'is-invalid'=> $errors->has('description')
        ]) name="description">
        {{old('description',$category->description)}}
    </textarea>
    @error('description')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<div class="form-check">
    <input  @class([
        'form-check-input',
        'is-invalid'=> $errors->has('status')
        ]) type="radio" name="status" value="active" @checked(old('status',$category->status) == 'active')
        >
    <label class="form-check-label">
      Active
    </label>
</div>
<div class="form-check">
    <input @class([
        'form-check-input',
        'is-invalid'=> $errors->has('status')
        ]) type="radio" value="archived" name="status" @checked(old('status',$category->status) == 'archived')>
    <label class="form-check-label" >
      Archive
    </label>
    @error('status')
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>

<button type="submit" class="btn btn-primary">{{$button_label ?? 'Submit'}}</button>
