<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">     
        <li><button class="dropdown-item" onclick="editForm('{{route('notification.view',$item->id)}}','view_form')"  data-bs-toggle="modal" data-bs-target="#view">View</button> </li>
   </ul>
</div>