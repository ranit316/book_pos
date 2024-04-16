<form class="text-center" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">
    @if ($item->status == 'draft')
        <a class="btn btn-warning btn-sm tooltip1" href="{{ route($route . '.edit', [$item->id]) }}">
            <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
        </a>
    @else
        <!-- <a href="{{ route($route . '.show', [$item->invoice_no]) }}" onclick="get_invoice_details({{ $item->invoice_no }})" -->
        {{-- <a href="#" onclick="get_invoice_details('{{$item->invoice_no}}')"
        class="btn btn-primary btn-sm tooltip1"><i class="fas fa-eye"></i> <span> See Details 
        </span>
    </a> --}}
        <!-- <div class="dropdown">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="far fa-file-pdf
"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" style="">
              
                <li><a href="#" onclick="get_invoice_details('{{ $item->invoice_no }}')" class="dropdown-item">
                        See Details
                    </a></li>
                <li><a class="dropdown-item" target="_blank" href="{{route('dprint.sale.get_cus.invoice',['cusid'=>$item->invoice_no])}}" >Print</a></li>
            </ul>
            
        </div> -->

<div class="dropdown d-inline-block">
   <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
   <i class="uil uil-ellipsis-h
      "></i>
   </button>
   <ul class="dropdown-menu dropdown-menu-end" style="">
      <li><a class="dropdown-item" href="#" onclick="get_invoice_details('{{ $item->invoice_no }}')">View</a></li>
      <li><a class="dropdown-item" href="#">Edit</a></li>
      <li><a class="dropdown-item" href="#">Delete</a></li>
   </ul>
</div>
    @endif
    {{-- @if ($item->status != 'approved')
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

    <select type="button" id="status{{ $item->id }}" class="btn btn-primary  btn-sm tooltip1">
        <option {{ $item->status == 'pedding' ? 'selected' : '' }} value="{{ $item->status }}">{{ $item->status }}
        </option>
    </select> --}}


</form>
