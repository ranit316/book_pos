
<form class="text-center" id="adjust{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">


                
      


<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
       
        <li>  
        @if (!empty($item->adjust_master_stock))<a type="button"
        href="{{ route('view.adjust.stock', [$item->id]) }}"
        id="status{{ $item->id }}"
        class="btn btn-sm dropdown-item tooltip1">
 View Adjustment 
        </a>
        @endif
        <a type="button"
        href="{{ route('adjust.stock', $item->id) }}"
        id="status{{ $item->id }}"
        class="btn btn-sm dropdown-item tooltip1">
       Adjust 
        </a></li>
   </ul>
</div>
</form>

