<x-layout>
    <x-breadcrumb :value="__($category->name.' / products')" :title="__($category->name.' products')"></x-breadcrumb>


    <table class="table">
        <tr>
            <td></td>
            <td>ID</td>
            <td>Name</td>
            <td>Store</td>
            <td>Category</td>
            <td>Created_at</td>

        </tr>
        @php
            $products = $category->products()->with(['store','category'])->paginate(5)
        @endphp
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

            </tr>
        @empty
            <tr>
                <td colspan="6" class="ps-5 text-danger fs-3">products not exist</td>
            </tr>
        @endforelse

    </table>

    {{$products->links()}}
</x-layout>




