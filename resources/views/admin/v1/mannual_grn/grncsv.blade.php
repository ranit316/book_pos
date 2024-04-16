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


                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('grncsv.download') }}"><i
                                            class="mdi mdi-plus me-1"></i>Download CSV</a>

                                     <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('grncsv.upload') }}"><i
                                            class="mdi mdi-plus me-1"></i>Upload CSV</a>
                                </div>

                               
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



       


    @endslot
</x-layout>
