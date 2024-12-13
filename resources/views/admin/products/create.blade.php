<x-layout>

    <x-breadcrumb :value="__('products / Create')" :title="__('Create Product')"></x-breadcrumb>




    @if (session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{session('msg')}}
        </div>
    @endif




    <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf

        @include('admin.products._form')

    </form>

</x-layout>
