<x-layout>
    @slot('title',$page )
    @slot('body')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Notification List</h4>
                                    </div>  
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class="datatable table table-striped table-bordered">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>Sl.No</th>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Create On</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <script type="text/javascript">
                                                    $(function() {
                                                        var i = 1;
                                                        var table = $('.datatable').DataTable({
                                                            processing: true,
                                                            serverSide: true,
                                                            ajax: "{{ route('list.view') }}",

                                                            buttons: [
                                                             {
                                                                extend: 'collection',
                                                                text:    'Export',
                                                                buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                                className: 'custom-exp-btn',
                                                              },
                                                            ],
                                                            columns: [{
                                                                    data: 'DT_RowIndex',
                                                                    name: 'DT_RowIndex'
                                                                },
                                                                {
                                                                    data: 'pubnotic.store_name',
                                                                    name: 'pubnotic.store_name',
                                                                },
                                                                {
                                                                    data: 'message',
                                                                    name: 'message'
                                                                },
                                                                {
                                                                    data: 'created_at',
                                                                    name: 'created_at'
                                                                },
                                                                {
                                                                    data: 'is_read',
                                                                    name: 'is_read',
                                                                    "render": function(data, type, full, meta) {
                                                                        if (data.toLowerCase() == 'read') {
                                                                            return "<span class='badge bg-success'>Read</span>";
                                                                        } 
                                                                        else {
                                                                              return "<span class='badge bg-warning'>Active</span>";
                                                                        } 
                                                                    }
                                                                },
                                                                {
                                                                    data: 'action',
                                                                    name: 'action',
                                                                    orderable: false,
                                                                    searchable: false,
                                                                },
                                                            ],
                                                            colReorder: true,
                                                            dom: 'lBfrtip',
                                                            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, 100]],
                                                            select: true,
                                                          
                                                        });
        
                                                    });
                                                </script>
                                            </tbody>
                                        </table>
                                
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    {{-- -----------------------------------View modal start----------------------------------------------- --}}
        <div class="modal fade" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="view">View {{ $page }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="view_form">

                </div>

            </div>
         </div>
      </div>
{{-- -----------------------------------View modal start----------------------------------------------- --}}

    @endslot
</x-layout>
