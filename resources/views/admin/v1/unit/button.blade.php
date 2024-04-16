<div class="dropdown text-center">
    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="uil uil-ellipsis-h"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" style="">
        {{-- <li><button class="dropdown-item" onclick="editForm( '{{route('company.view',$item->id)}}','modal_body')" data-bs-target="#view_modal" data-bs-toggle="modal" href="#">View</button></li> --}}
        <li><a button class="dropdown-item"  href="" data-bs-toggle="modal" data-bs-target="#edit" onclick="editForm('{{route('unit.edit',['id' => $item->id])}}','edit_form')">Edit</a></button></li>
        <li><a button class="dropdown-item" id="delete"  onclick="delete_entity('{{ route('admin.unit auth',$item->id) }}')" href="">Delete</a></button></li>
   </ul>
</div>
<script>
function delete_entity(url, targetId)
{
    if (confirm("Are you sure to Delete?")) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                // Handle the response here, e.g., update button text or styles
                $('#'+targetId).html(response);
                $('#datatable').DataTable().ajax.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
}

</script>
