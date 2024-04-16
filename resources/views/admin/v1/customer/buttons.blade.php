{{-- <form class="text-center" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}"> --}}


    {{-- EDIT BUTTON --}}
    {{-- <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route.'.edit',$item->id) }}">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </a>
    

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

{{-- <div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
    <li> 
            <button type="button"
                onclick="changeStatus('{{ route($route . '.status', $item->id) }}','status{{ $item->id }}')"
                id="status{{ $item->id }}"
                class="dropdown-item">
                @if ($item->status == 'active')
                   
                    <span> Deactivate  </span>
                @else
                  
                    <span> Activate  </span>
                @endif
            </button>
        </li>
        <li><a button class="dropdown-item"  href="{{route('retail.customer.edit',[$item->customer_id])}}">Edit</a></button></li>
        <li><button class="dropdown-item" id="delete">Delete</button></li>
   </ul>
</div> --}}
               




{{-- <div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        <li><a button class="dropdown-item"  href="" data-bs-toggle="modal" data-bs-target="#edit" onclick="editForm('{{route('unit.edit',['id' => $item->id])}}','edit_form')">Edit</a></button></li>
   </ul>
</div> --}}