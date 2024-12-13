<x-layout>

    <x-breadcrumb :value="__('Products / Edit')" :title="__('Edit Product')"></x-breadcrumb>




    @if (session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{session('msg')}}
        </div>
    @endif


    <form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data" class="mx-3">
        @csrf
        @method('put')

        @include('admin.products._form',
        [
            'button_label'=>'update'
        ])

    </form>

</x-layout>
