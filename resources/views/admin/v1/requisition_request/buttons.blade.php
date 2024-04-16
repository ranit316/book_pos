<form class="text-center" id="edit{{ $item->id }}" action="{{ route($route . '.destroy', $item->id) }}">


    {{-- EDIT BUTTON --}}
    <?php if($item->status=='pending'){ ?>
    <a type="button" class="btn btn-warning btn-sm tooltip1" href="{{ route($route . '.edit', $item->id) }}">
        <i class="fas fa-edit"></i> <span> Edit {{ $page }} </span>
    </a>
    <?php } ?> 

    @csrf
   
</form>