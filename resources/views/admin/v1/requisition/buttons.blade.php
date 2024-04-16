<form class="text-center " id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">
    
@if ($item->status == 'approved')
        {{-- EDIT BUTTON --}}
        <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route . '.show', $item->id) }}">
            <i class="fas fa-eye"></i> <span> View {{ $page }} </span>
        </a>
       
    @endif

    @if ($item->status == 'pending')
        {{-- EDIT BUTTON --}}
        <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route . '.edit', $item->id) }}">
            <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
        </a>

        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="button" id="delete{{ $item->id }}"
            onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
            class="btn btn-danger btn-sm tooltip1"><i class="fas fa-trash-alt"></i> <span> Delete {{ $page }}
            </span>
        </button> 
    @endif

    

</form>
