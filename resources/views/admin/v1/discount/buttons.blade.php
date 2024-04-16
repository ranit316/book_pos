<form class="text-center btn-group" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">
    {{-- EDIT BUTTON --}}
    <button type="button" class="btn btn-outline-primary btn-sm tooltip1"
        onclick="editForm('{{ route($route . '.edit', $item->id) }}', 'edit_form')"  data-bs-toggle="modal" data-bs-target="#edit"  >
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </button>

    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')" class="btn btn-outline-danger btn-sm tooltip1"><i
        class="fas fa-trash-alt"></i> <span> Delete {{ $page }} </span>
    </button>


   
   

    
</form>



