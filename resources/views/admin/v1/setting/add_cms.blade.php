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

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">{{ $page }} List</h4>
                                    </div>

                                    <a href="{{ route('admin.cms-page') }}"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        type="button"><i class="uil-arrow-left me-2 me-2"></i>Back to List</a>
                                    {{-- <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('books.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a> --}}
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('admin.post') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="title" class="required">Title</label>
                                                    <input type="text" id="title" required class="form-control"
                                                        placeholder="Enter Title" name="title">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="price" class="required">Description</label>
                                                    <input  type="url" id="description" required class="form-control"
                                                        placeholder="Enter Link" name="description">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>
                                            Save Cms Page</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endslot
</x-layout>
<!-- // model -->
