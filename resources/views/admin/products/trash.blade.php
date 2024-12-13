<x-layout>

    <x-breadcrumb :value="__('Proucts / Trash')" :title="__('Trash')"></x-breadcrumb>

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


    <a href="{{route('products.index')}}" class="btn btn-outline-primary mx-4 my-3">
        back
    </a>
    {{-- <a href="{{route('products.trash')}}" class="btn btn-outline-dark mx-4 my-3">
        Trash
    </a> --}}


    <table class="table">
        <tr>
            <td></td>
            <td>ID</td>
            <td>Name</td>
            <td>Store</td>
            <td>Category</td>
            <td>Deleted_at</td>
            <td>Restore</td>
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
                <td>{{$product->store_id ?? 'Not Exist'}}</td>
                <td>{{$product->category_id ?? 'Not Exist'}}</td>
                <td>{{$product->created_at}}</td>
                <td>
                    <form action="{{route('products.restore',$product->id)}}" method="post">
                        @csrf
                        @method('put')
                        <input type="submit" class="btn btn-outline-info" value="Restore">
                    </form>
                </td>
                <td>
                    <form action="{{route('products.force-delete',$product->id)}}" method="post">
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
