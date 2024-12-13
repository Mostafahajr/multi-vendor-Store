<x-layout>

    <x-breadcrumb :value="__('profile')" :title="__('My Profile')"></x-breadcrumb>




    @if (session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{session('msg')}}
        </div>
    @endif




    <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf
        @method('patch')

        <x-form.input :type="'text'" :name="'first_name'" :value="$user->profile->first_name ?? ''" label="First Name" />
        <x-form.input :type="'text'" :name="'last_name'" :value="$user->profile->last_name ?? ''" label="Last Name" />
        <x-form.input :type="'date'" name="birthday" :value="$user->profile->birthday ?? ''" label="Birthday" />
        <x-form.radio-input name="gender" :options="['Male'=>'male','Female'=>'female']" :selected="$user->profile->gender ?? ''" />

        <x-form.input :type="'text'" name="street_address" :value="old('street_address',$user->profile->street_address  ?? '' )" label="Street Address" />
        <x-form.input :type="'text'" name="city" :value="old('city',$user->profile->city ?? '')" label="City" />
        <x-form.input :type="'text'" name="state" :value="old('state',$user->profile->city ?? '')" label="State" />
        <x-form.input :type="'text'" name="postal_code" :value="old('postal_code',$user->profile->postal_code ?? '')" label="Postal Code" />

        {{-- <x-form.select name="country" label="Country" :value="$countries" :selected="$user->profile->country" /> --}}
            <div class="mb-3">

                <label  class="form-label">Country</label>
                <select name="country" id="" @class([
                    'form-control',
                    'form-select',
                    'is-invalid'=> $errors->has('country')
                    ])>

                    <option value="">choose value</option>
                    @foreach ($countries as $value => $text)
                        <option value="{{$value}}" @if ($user->profile)
                            @selected($value == $user->profile->country)
                        @endif >{{$text}}</option>
                    @endforeach
                </select>
                @error('country')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
        {{-- <x-form.select name="locale" label="Local" :value="$locales" :selected="$user->profile->locale" /> --}}

            <div class="mb-3">
                <label  class="form-label">Local</label>
                <select name="locale" id="" @class([
                    'form-control',
                    'form-select',
                    'is-invalid'=> $errors->has('locale')
                    ])>
                    <option value="">choose value</option>
                    @foreach ($locales as $value => $text)
                        <option value="{{$value}}" @if ($user->profile)
                             @selected($value == $user->profile->locale)
                        @endif >{{$text}}</option>
                    @endforeach
                </select>
                @error('locale')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

        <button type="submit" class="btn btn-primary">{{$button_label ?? 'Submit'}}</button>

    </form>

</x-layout>
