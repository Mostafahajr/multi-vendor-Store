<x-layout>

    <x-breadcrumb :value="__('Categories/trash')" :title="__('Trash')"></x-breadcrumb>

    @if (session()->has('deleted'))
        <div class="alert alert-danger" role="alert">
            {{session('deleted')}}
        </div>
    @endif



    <a href="{{route('categories.index')}}" class="btn btn-outline-primary mx-4 my-3">
        back
    </a>


    <table class="table">
        <tr>
            <td></td>
            <td>ID</td>
            <td>Name</td>
            <td>Status</td>
            <td>deleted_at</td>
            <td>Restore</td>
            <td>Delete</td>
        </tr>
        @forelse ($categories as $category )
            <tr>

                <td>
                    @if ($category->image)
                      <img src="{{asset('storage/' . $category->image)}}" class="rounded" alt="" style="width: 40px;height:40px">

                    @endif
                </td>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>{{$category->status}}</td>
                <td>{{$category->deleted_at}}</td>
                <td>
                    <form action="{{route('categories.restore',$category->id)}}" method="post">
                        @csrf
                        @method('put')
                        <input type="submit" class="btn btn-outline-info" value="Restore">
                    </form>
                </td>
                <td>
                    <form action="{{route('categories.force-delete',$category->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" class="btn btn-outline-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="ps-5 text-danger fs-3">categories not exist</td>
            </tr>
        @endforelse

    </table>



</x-layout>
