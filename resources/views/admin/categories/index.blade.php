<x-layout>

    <x-breadcrumb :value="__('Categories')" :title="__('Categories')"></x-breadcrumb>

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


    <a href="{{route('categories.create')}}" class="btn btn-outline-primary mx-4 my-3">
        create
    </a>
    <a href="{{route('categories.trash')}}" class="btn btn-outline-dark mx-4 my-3">
        Trash
    </a>


    <table class="table">
        <tr>
            <td></td>
            <td>ID</td>
            <td>Name</td>
            <td>Parent_id</td>
            <td>Products #</td>
            <td>Created_at</td>
            <td>Edit</td>
            <td>Delete</td>
        </tr>
        @forelse ($categories as $category )
            <tr>

                <td>
                    @if (Storage::exists('storage/' . $category->image))
                      <img src="{{asset('storage/' . $category->image) ?? $category->image}}" class="rounded" alt="" style="width: 40px;height:40px">

                    @endif
                </td>
                <td>{{$category->id}}</td>
                <td>
                    <a href="{{route('categories.show',$category)}}" class="nav-link">
                        {{$category->name}}
                    </a>

                </td>
                <td>{{$category->parent->name ?? 'Not Exist'}}</td>
                <td>{{$category->products_count}}</td>
                <td>{{$category->created_at}}</td>
                <td>
                    <a href="{{route('categories.edit',$category->id)}}" class="btn btn-outline-warning">Edit</a>
                </td>
                <td>
                    <form action="{{route('categories.destroy',$category->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-outline-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="ps-5 text-danger fs-3">categories not exist</td>
            </tr>
        @endforelse

    </table>

    {{$categories->links()}}

</x-layout>
