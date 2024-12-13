
@props(['label','name','value'])

<div class="mb-3">
    <label class="form-label">{{$label}}</label>
    <textarea   @class([
        'form-control',
        'is-invalid'=> $errors->has($name)
        ]) name="{{$name}}">
        {{old($name,$value)}}
    </textarea>
    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
