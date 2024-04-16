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
                                                <a class="nav-link active mb-2" href="{{route('admin.setting')}}">General</a>
                                                {{-- <a class="nav-link mb-2" href="{{route('admin.company-info')}}">Software</a> --}}
                                                {{-- <a class="nav-link mb-2" href="{{route('admin.finance')}}">Finance</a> --}}
                                                {{-- <a class="nav-link mb-2" href="{{route('admin.api-key')}}">App Keys</a> --}}
                                                {{-- <a class="nav-link mb-2" href="{{route('admin.miscellaneous')}}">Miscellaneous</a> --}}
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
                                                    <h4 class="card-title text-capitalize">App Settings</h4>
                                                </div>

                                            </div>
                                            <div class="card-header">
                                                <form action="{{route('admin.post.set')}}" name="app_setting"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <h3 class="mb-2 text-muted t_muted">App Info :</h3>
                                                    <div class="">
                                                        <div class="form-group">
                                                            <label for="app_title">Title :</label>
                                                            <input type="hidden" value="{{ $app_setting->id ?? '' }}"
                                                                name="id" id="id">
                                                            <input type="text" class="form-control"
                                                                value="{{ $app_setting->title ?? '' }}" name="app_title"
                                                                id="app_title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="app_description">Description :</label>
                                                            <textarea class="form-control" name="app_description" id="app_description" style="min-height: 80px;">{{ $app_setting->description ?? '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="app_version">Version :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->version) ? $app_setting->version : '' }}"
                                                                name="app_version" id="app_version">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="beta_url">Footer left :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->footer_left) ? $app_setting->footer_left : '' }}"
                                                                name="footer_left" id="footer_left">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email_name">Email Sign Name :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->email_sign_name) ? $app_setting->email_sign_name : '' }}"
                                                                name="email_name" id="email_name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="cc">CC :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->cc) ? $app_setting->cc : '' }}"
                                                                name="cc" id="cc">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="bcc">Bcc :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->bcc) ? $app_setting->bcc : '' }}"
                                                                name="bcc" id="bcc">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email2">Email For Tech :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->email2) ? $app_setting->email2 : '' }}"
                                                                name="email2" id="email2">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email For General :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->email) ? $app_setting->email : '' }}"
                                                                name="email" id="email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="live_url">App Url :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ !empty($app_setting->live_url) ? $app_setting->live_url : '' }}"
                                                                name="live_url" id="live_url">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="form-group">
                                                        <label for="app_logo">Large Logo :</label>
                                                        <input onchange="image_check(this, 100)" type="file" class="form-control"
                                                            value="{{ $app_setting->logo ?? '' }}" name="app_logo"
                                                            id="app_logo">
                                                        @if (!empty($app_setting->logo))
                                                            <img src="{{ url($app_setting->logo) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dark_logo">Small Logo :</label>
                                                        <input onchange="image_check(this, 100)" type="file" class="form-control"
                                                            value="{{ $app_setting->dark_logo ?? '' }}" name="dark_logo"
                                                            id="dark_logo">
                                                        @if (!empty($app_setting->dark_logo))
                                                            <img src="{{ url($app_setting->dark_logo) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fab_icon">Favicon Icon :</label>
                                                        <input onchange="image_check(this, 100)" type="file" class="form-control"
                                                            value="{{ $app_setting->fav_icon ?? '' }}" name="fab_icon"
                                                            id="fab_icon">
                                                        @if (!empty($app_setting->fav_icon))
                                                            <img src="{{ url($app_setting->fav_icon) }}"
                                                                class="img-thumbnail my-2" height="250" width="250">
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                            <label for="purchase_tnc">Purchase T&C :</label>
                                                            <textarea class="form-control" name="purchase_tnc" id="purchase_tnc" style="min-height: 120px;">{{ $app_setting->purchase_tnc ?? '' }}</textarea>
                                                    </div>

                                                    <div class="form-group">
                                                            <label for="sale_tnc">Sale T&C :</label>
                                                            <textarea class="form-control" name="sale_tnc" id="sale_tnc" style="min-height: 120px;">{{ $app_setting->sale_tnc ?? '' }}</textarea>
                                                    </div>
                                  
                                          
                                            <div class="col-sm-12 text-center">
                                                <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Save Changes</button>
                                            </div>
                                    
                                        </form>                             

                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </div><!-- end card body -->
                </div><!-- end card -->




</div>
</div>
</div>
</div>
<script>
      ClassicEditor
        .create( document.querySelector('#purchase_tnc'))
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
        .create( document.querySelector('#sale_tnc'))
        .catch( error => {
            console.error( error );
        } );
</script>

@endslot
</x-layout>
{{-- <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script> --}}
@section('scripts')
    <script>
        /* $('#generate_api_key').on('click', function () {
            const id = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            $('#api_key').val(id);
        }); */
    </script>
@endsection

