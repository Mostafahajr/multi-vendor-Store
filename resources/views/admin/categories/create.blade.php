<x-layout>

    <x-breadcrumb :value="__('Categories / Create')" :title="__('Create Category')"></x-breadcrumb>

    


    @if (session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{session('msg')}}
        </div>
    @endif


    <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf

        @include('admin.categories._form')

    </form>

</x-layout>
