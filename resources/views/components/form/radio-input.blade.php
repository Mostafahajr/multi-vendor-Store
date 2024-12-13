
@props(['name','options','selected'])

<div class="d-flex justify-content-start align-items-center">
    @foreach ($options as $key=>$value)
    <div class="form-check my-3 me-3">

        <input  @class([
            'form-check-input',
            'is-invalid'=> $errors->has($name)
            ]) type="radio" name="{{$name}}" value="{{$value}}" @checked(old($name,$selected) == $value)
            >
        <label class="form-check-label">
          {{$key}}
        </label>

    </div>
    @endforeach
</div>


