@props(['label','name','value','type'])



<div class="mb-3">
    <label class="form-label">{{$label}}</label>
    <input type="{{$type}}" {{$attributes}} @class([
        'form-control',
        'is-invalid'=> $errors->has($name)
        ])
        name="{{$name}}" value="{{old($name,$value)}}"
    >
    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
