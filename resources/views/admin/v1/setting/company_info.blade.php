<x-layout>
    @slot('title')
    @slot('body')




        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">CMS Page List</h4>
                                    </div>


                                    <a href="{{route('admin.cms-add')}}" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        class="btn btn-primary"><i class="mdi mdi-plus me-1"></i>Add Page
                                    </a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <table class=" datatable table table-striped  " id="student-table">
                                            <thead>
                                                <tr class="ligth">
                                                    <th>S.No</th>
                                                    <th>Title</th>
                                                    <th>Link</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cms_page as $page)
                                                <tr>
                                                    <th>{{$page->id}}</th>
                                                    <td>{{$page->name}}</td>
                                                    <td>{{$page->description}}</td>
                                                    <td class="text-center"><a class="btn btn-sm btn-outline-danger" href="{{ route('cms.delete', ['id' => $page->id]) }}"><i class="uil-trash-alt"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                </div>
            </div>
        </div>


    {{-- <div class="modal fade" id="add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="edit">Add Page</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="add_form">

                </div>
            </div>
        </div>
    </div> --}}

    @endslot
</x-layout>
