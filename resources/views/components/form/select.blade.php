
@props(['name','label','value','selected'])



<div class="mb-3">
    <label  class="form-label">{{$label}}</label>
    <select name="{{$name}}" id="" @class([
        'form-control',
        'form-select',
        'is-invalid'=> $errors->has($name)
        ])>
        <option value="">choose value</option>
        @foreach ($value as $category)
            <option value="{{$category->id}}" @selected(old($name,$category->id) == $selected)>{{$category->name}}</option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
