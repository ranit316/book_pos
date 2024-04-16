<button type="button" class="btn btn-warning btn-sm tooltip1"
    onclick="editForm('{{ route($route . '.edit', $item->id) }}', 'edit_form')"  data-bs-toggle="modal" data-bs-target="#edit"> 
   <i class="fas fa-edit"></i> <span> View {{ $page }} </span>
</button>