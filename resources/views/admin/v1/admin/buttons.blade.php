<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><button type="button" class="dropdown-item"
        onclick="editForm('{{ route($route . '.show', $item->id) }}', 'show_form')" data-bs-toggle="modal"
        data-bs-target="#show"> View </button></li>

        <li><button type="button" class="dropdown-item"
            onclick="editForm('{{ route($route . '.changepassword', $item->id) }}', 'password_change_form')"
            data-bs-toggle="modal" data-bs-target="#password_change">
            change Password </button></li>

           @if(isAdmin()) 
        <li><button type="button" id="delete{{ $item->id }}"
            onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
            class="dropdown-item"> Delete </button></li>
            @endif
   </ul>
</div>

{{-- <form class="text-center clinic-button" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">


    <button type="button" class="btn btn-warning btn-sm tooltip1"
        onclick="editForm('{{ route($route . '.show', $item->id) }}', 'show_form')" data-bs-toggle="modal"
        data-bs-target="#show">
        <i class="fas fa-eye"></i> <span> View {{ $page }} </span>
    </button>

    <button type="button" class="btn btn-warning btn-sm tooltip1"
        onclick="editForm('{{ route($route . '.changepassword', $item->id) }}', 'password_change_form')"
        data-bs-toggle="modal" data-bs-target="#password_change">
        <i class="fas fa-lock"></i> <span> Password change of {{ $item->name }} </span>
    </button>

    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
        class="btn btn-danger btn-sm tooltip1"><i class="fas fa-trash-alt"></i> <span> Delete {{ $page }}
        </span>
    </button>
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
</form> --}}