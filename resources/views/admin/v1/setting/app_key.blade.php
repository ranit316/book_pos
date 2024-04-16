<x-layout>
    @slot('title')
    @slot('body')
    <div class="main-content">
        <div class="page-content">
        <script>
            @if (Session::has('failure'))
                toastr.options = {
                    "closeButton": true,
                    "positionClass": "toast-top-center",
                    "showDuration": "300",
                }
                toastr.error("{{ session('failure') }}");
            @endif
        </script>

<div class="container-fluid">
                <div class="row">

                    <div class="col-xl-12">
                          <!-- end card header -->
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                aria-orientation="vertical">
                                                <a class="nav-link mb-2" href="{{route('admin.setting')}}">General</a>
                                                <a class="nav-link mb-2" href="{{route('admin.companyinfo')}}">Company Info</a>
                                                <a class="nav-link mb-2" href="{{route('admin.finance')}}">Finance</a>
                                                <a class="nav-link active mb-2" href="{{route('admin.appkey')}}">App Keys</a>
                                                <a class="nav-link mb-2" href="{{route('admin.miscellaneous')}}">Miscellaneous</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">

                                        <div class="card tab-pane active" id="v-pills-home" role="tabpanel"
                                            aria-labelledby="v-pills-home-tab">

                                            <div class="card-header d-flex justify-content-between">
                                                <div class="header-title">
                                                    <h4 class="card-title text-capitalize">API Keys</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="" name="app_setting"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">API Keys :</h3>
                                           
                                                        <div class="form-group">
                                                            <label for="s_key">Software Key :</label>  
                                                            <input type="hidden" value="{{ $api_setting->id ?? '' }}" name="id" id="id">
                                                            <div class="row">
                                                                <div class="col-9">
                                                                    <input type="text" class="form-control"
                                                                    value="{{ $api_setting->api_key ?? '' }}" name="s_key" id="s_key">
                                                                </div>
                                                                <div class="col-3">
                                                                    <button type="button" id="generate" class="btn btn-primary add-list btn-sm text-white">Generate</button>
                                                                    <button type="button" id="reset" class="btn btn-danger add-list btn-sm text-white">Reset</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="form-group">
                                                            <label for="google_key"> Google keys :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $api_setting->google_key ?? '' }}"
                                                                name="google_key" id="google_key">
                                                        </div>

                                                                          
                                                   
                                                 <div class="col-sm-12 text-center">
                                                    <button type="submit"
                                                    class="btn btn-primary add-list btn-md text-white">Save</button>
                                                 </div> 
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end col -->

                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->


            </div>
        </div>

 
        </div>
    </div>
@endslot
</x-layout>

@section('scripts')
    <script>
        /* $('#generate_api_key').on('click', function () {
            const id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            $('#api_key').val(id);
        }); */
    </script>
@endsection

