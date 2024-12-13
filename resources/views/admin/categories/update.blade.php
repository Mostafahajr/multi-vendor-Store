<x-layout>

    <x-breadcrumb :value="__('Categories / Edit')" :title="__('Edit Category')"></x-breadcrumb>

    


    @if (session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{session('msg')}}
        </div>
    @endif


    <form action="{{route('categories.update',$category->id)}}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf
        @method('put')

        @include('admin.categories._form',
        [
            'button_label'=>'update'
        ])

    </form>

</x-layout>
