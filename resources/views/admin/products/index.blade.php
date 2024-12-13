<x-layout>

    <x-breadcrumb :value="__('Products')" :title="__('Products')"></x-breadcrumb>

    @if (session()->has('deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('deleted')}}
        </div>
    @endif

    @if (session()->has('msg'))
        <div class="alert alert-success" role="alert">
            {{session('msg')}}
        </div>
    @endif


    <a href="{{route('products.create')}}" class="btn btn-outline-primary mx-4 my-3">
        create
    </a>
    <a href="{{route('products.trash')}}" class="btn btn-outline-dark mx-4 my-3">
        Trash
    </a>


    <table class="table">
        <tr>
            <td></td>
            <td>ID</td>
            <td>Name</td>
            <td>Store</td>
            <td>Category</td>
            <td>Created_at</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @forelse ($products as $product )
            <tr>

                <td>
                    @if (asset('storage/' . $product->image))
                      <img src="{{asset('storage/' . $product->image) ?? $product->image}}" class="rounded" alt="" style="width: 40px;height:40px">

                    @endif
                </td>
                <td>{{$product->id}}</td>
                <td>{{$product->name}}</td>
                <td>{{$product->store->name ?? 'Not Exist'}}</td>
                <td>{{$product->category->name ?? 'Not Exist'}}</td>
                <td>{{$product->created_at}}</td>
                <td>
                    <a href="{{route('products.edit',$product->id)}}" class="btn btn-outline-warning">Edit</a>
                </td>
                <td>
                    <form action="{{route('products.destroy',$product->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-outline-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="ps-5 text-danger fs-3">products not exist</td>
            </tr>
        @endforelse

    </table>

    {{$products->links() }}

</x-layout>
