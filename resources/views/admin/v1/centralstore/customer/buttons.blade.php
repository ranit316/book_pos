<div class="dropdown text-center">
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
        <li><a button class="dropdown-item"  href="{{route('central.customer.edit',[$item->customer_id])}}">Edit</a></button></li>
        <li><button class="dropdown-item" id="delete">Delete</button></li>
   </ul>
</div>