
@if(isAdmin() || isPublisher())
<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><button class="dropdown-item" onclick="editForm('{{route('books.view',$item->id)}}','view_form')" data-bs-target="#view" data-bs-toggle="modal" href="#">View</button></li>
        <li><a button class="dropdown-item"  href="{{ route($route.'.edit',$item->id) }}">Edit</a></button></li>
        <!--<form class="" id="edit{{ $item->id }}" action="{{ route($route . '.delete', $item->id) }}">
        <li><button id="delete{{ $item->id }}" class="dropdown-item" onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')">Delete</button></li>
    </form>-->
    <!--<li><a   onclick="return confirm('Are you sure to delete this book?')" class="btn btn-danger btn-sm tooltip1 dropdown-item" href="{{ route('books.delete',$item->id) }}">
           Delete </li>-->
           <form id="delete_book_{{$item->id}}" method="POST" action="{{ route('books.delete',$item->id) }}">
            @csrf
        <li><a onClick="del_book({{$item->id}});"  href="javascript:void(0);" class="dropdown-item" value="Delete">Delete</a></li>
    </form>
   </ul>
</div>
@endif



{{-- <form class="text-center " id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">
    @if (isAdmin() || isPublisher())
    <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route.'.edit',$item->id) }}">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
        @else
        <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route.'.edit',$item->id) }}">
            <i class="fas fa-edit"></i> <span> view {{ $page }} </span>
            @endif
    </a>
   
    @if (isAdmin() || isPublisher())
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
        class="btn btn-danger btn-sm tooltip1" ><i class="fas fa-trash-alt"></i> <span> Delete {{ $page }}
        </span>
    </button>
     @endif 

     @if (isAdmin() || isPublisher()) 
    <button type="button"
        onclick="changeStatus('{{ route($route . '.status', $item->id) }}','status{{ $item->id }}')"
        id="status{{ $item->id }}"
        class="btn {{ $item->status == 'active' ? 'btn-success' : 'btn-secondary' }}  btn-sm tooltip1">
        @if ($item->status == 'active')
            <i class="fas fa-check-circle"></i>
            <span> DeActivate {{ $page }} </span>
        @else
            <i class="fas fa-times-circle"></i>
            <span> Activate {{ $page }} </span>
        @endif
    </button>
    @endif
</form> --}}
