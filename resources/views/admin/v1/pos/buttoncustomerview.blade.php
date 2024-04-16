{{-- <a type="button" class="btn btn-outline-success btn-sm tooltip1" href="{{ route($route . '.transaction', $item->id) }}">
    <i class="fas fa-eye"></i> <span> View {{ $page }} </span>
</a> --}}


<a type="button" data-bs-toggle="modal" data-bs-target="#edit" class="btn btn-outline-success btn-sm tooltip1" onclick="editForm('{{ route($route . '.transaction', $item->id)}}','edit_form')">
    <i class="fas fa-eye"></i> <span> View {{$page2}} </span>
</a>
