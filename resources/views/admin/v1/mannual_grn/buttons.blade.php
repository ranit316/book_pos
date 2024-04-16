{{-- <form class="text-center" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}"> --}}


    {{-- EDIT BUTTON --}}
    <button type="button" class="btn btn-warning btn-sm tooltip1"
        onclick="editForm('{{ route($route . '.edit', $item->id) }}', 'edit_form')" data-bs-toggle="modal"
        data-bs-target="#edit">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </button>

    <div class="dropdown d-inline-block">
        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-file-alt"></i>
        </button>
        <ul class="dropdown-menu dropdown-menu-end" style="">
           <li><a class="dropdown-item" target="_blank" href="{{ route('grn.pdf.download', [$item->id]) }}">Download PDF</a></li>
           <li><a class="dropdown-item" target="_blank" href="{{ route('grn.print', [$item->id]) }}">Print</a></li>
        </ul>
    </div>

    {{-- @csrf
    <input type="hidden" name="_method" value="DELETE">
    <button type="button" id="delete{{ $item->id }}"
        onclick="deleteRow('edit{{ $item->id }}','delete{{ $item->id }}')"
        class="btn btn-danger btn-sm tooltip1"><i class="fas fa-trash-alt"></i> <span> Delete {{ $page }}
        </span>
    </button>

    <select type="button" id="status{{ $item->id }}" class="btn btn-primary  btn-sm tooltip1">
        <option {{ $item->status == 'pedding' ? 'selected' : '' }} value="{{ $item->status }}">{{ $item->status }}</option>


    </select> --}} 
{{-- </form> --}}
