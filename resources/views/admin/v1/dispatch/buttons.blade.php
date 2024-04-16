<form class="text-center" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">


    {{-- EDIT BUTTON --}} 
    {{-- <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route . '.edit', $item->id) }}">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </a> --}}
    <a type="button" class="btn btn-info btn-sm tooltip1" href="{{ route($route . '.show', $item->id) }}">
        <i class="fas fa-eye"></i> <span> show {{ $page }} </span>
    </a>

    <div class="dropdown d-inline-block">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-file-alt"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="">
           <li><a class="dropdown-item" target="_blank" href="{{ route('dispatch.pdf.download', [$item->id]) }}">Download PDF</a></li>
           <li><a class="dropdown-item" target="_blank" href="{{ route('dispatch.print', [$item->id]) }}">Print</a></li>
        </ul>
    </div>

    @csrf
    {{-- <input type="hidden" name="_method" value="DELETE">
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
    </button> --}}
</form>
