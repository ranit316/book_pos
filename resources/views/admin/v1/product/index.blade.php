<x-layout>
    @slot('title', $page)
    @slot('body')



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header ">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="header-title">
                                                <h4 class="card-title">{{ $page }} List</h4>
                                            </div>
                                        </div>

                                        <?php 
                                if(isCentral() || isRetail())
                                {
                                
                                }else{
                                ?>
                                        <div class="col-lg-8 text-end">
                                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                                href="{{ route('books.edition12') }}"><i class="mdi mdi-plus me-1"></i>Add
                                                Edition/Reprint</a>

                                            <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                                href="{{ route('books.create') }}"><i class="mdi mdi-plus me-1"></i>Add
                                                {{ $page }}</a>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            @if (Session::has('error'))
                                <p class="alert alert-info">{{ Session::get('error') }}</p>
                            @endif


                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class=" datatable table   table-striped table-bordered ">
                                        <thead>
                                            <tr class="ligth">
                                                <th>Sys id</th>
                                                <th>Title</th>
                                                <th>Publisher</th>
                                                <th>Author</th>
                                                <th>Edition</th>
                                                {{-- <th>Publisher Name</th>
                                                    <th>Publication Date</th>
                                                    <th>Language</th> --}}
                                                {{-- <th>weight</th> --}}
                                                {{-- <th>dimensions</th> --}}

                                                <th>MRP</th>

                                                @if (isAdmin() || isPublisher())
                                                    <th>Status</th>

                                                    <th class="text-center">Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>


                                    <script type="text/javascript">
                                        $(function() {
                                            var i = 1;
                                            var table = $('.datatable').DataTable({
                                                processing: true,
                                                serverSide: true,
                                                ajax: "{{ route('books.index') }}",

                                                buttons: [{
                                                    extend: 'collection',
                                                    text: 'Export',
                                                    buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                                                    className: 'custom-exp-btn',
                                                }, ],

                                                columns: [{
                                                        data: 'id',
                                                        name: 'id'
                                                    },
                                                    {
                                                        data: 'title',
                                                        name: 'title'
                                                    },
                                                    {
                                                        data: 'bookpublisher.publisher.store_name',
                                                        name: 'bookpublisher.publisher.store_name'
                                                    },
                                                    {
                                                        data: 'bookauthor.name',
                                                        name: 'bookauthor.name'
                                                    },
                                                    {
                                                        data: 'edition',
                                                        name: 'edition'
                                                    },
                                                    {
                                                        data: 'price',
                                                        name: 'price'
                                                    },
                                                    // {
                                                    //     data: 'status',
                                                    //     name: 'status'
                                                    // },
                                                    // {
                                                    //     data: 'dimensions',
                                                    //     name: 'dimensions'
                                                    // },
                                                    // {
                                                    //     data: 'pages',
                                                    //     name: 'pages'
                                                    // },

                                                    // {
                                                    //     data: 'image',
                                                    //     name: 'image',
                                                    //     "render": function(data, type, full, meta) {
                                                    //         return "<img src=\"" + data + "\" height=\"50\"/>";
                                                    //     },
                                                    // },

                                                    @if (isAdmin() || isPublisher())

                                                        {
                                                            data: 'status',
                                                            name: 'status',
                                                            "render": function(data, type, full, meta) {
                                                                if (data.toLowerCase() == 'active') {
                                                                    return "<span class='badge bg-success'>Active</span>";
                                                                } else {
                                                                    return "<span class='badge bg-danger'>Block</span>";
                                                                }
                                                            }
                                                        }, {
                                                            data: 'action',
                                                            name: 'action',
                                                            orderable: false,
                                                            searchable: false
                                                        },
                                                    @endif
                                                ],

                                                colReorder: true,
                                                dom: 'lBfrtip',
                                                lengthMenu: [
                                                    [10, 25, 50, -1],
                                                    [10, 25, 50, 100]
                                                ],
                                                select: true,
                                                initComplete: function() {
                                                    var currentUrl = window.location.href;
                                                    var id = currentUrl.split('?')[1];


                                                    // Log the extracted ID to the console
                                                    //console.log('Extracted ID:', id);
                                                    //for global search

                                                    $.ajax({
                                                        type: "GET",
                                                        url: '{{ route('book.search.universal', ':id') }}'.replace(':id', id),
                                                        dataType: "json",
                                                        success: function(response) {
                                                            //console.log(response.title);
                                                            var searchInput = $('#DataTables_Table_0_filter input');
                                                            searchInput.val(response
                                                                .title); // Set the value of the search input field
                                                            searchInput.trigger('keyup');
                                                        }
                                                    });
                                                }
                                            });

                                        });
                                    </script>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        </div>
        <!-- End Page-content -->



        <!-- edit Modal -->
        <div class="modal fade" id="edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="edit" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit">Edit {{ $page }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="edit_form">

                    </div>

                </div>
            </div>
        </div>

        <!-- view Modal -->
        <div class="modal fade" id="view" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="view" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-dialog">
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
        </div>


    @endslot
</x-layout>

{{-- <script>
    $(document).ready(function() {
        // Get the URL parameters
        var currentUrl = window.location.href;
        var id = currentUrl.split('?')[1];


        // Log the extracted ID to the console
        //console.log('Extracted ID:', id);

        $.ajax({
            type: "GET",
            url: '{{ route('book.search.universal', ':id') }}'.replace(':id', id),
            dataType: "json",
            success: function(response) {
                //console.log(response.title);
                var searchInput = $('#DataTables_Table_0_filter input');
                searchInput.val(response
                    .title); // Set the value of the search input field
                searchInput.trigger('keyup');
            }
        });

    });
</script> --}}
