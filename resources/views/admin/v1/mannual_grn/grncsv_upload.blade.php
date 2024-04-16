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
                                        <h4 class="card-title">{{ $page }}</h4>
                                    </div>

                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('grncsv.download') }}"><i
                                            class="mdi mdi-plus me-1"></i>Download CSV</a>

                                     <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2" href="{{ route('grncsv.upload') }}"><i
                                            class="mdi mdi-plus me-1"></i>Upload CSV</a>  
                                  
                                </div>

                                <div class="card-body">
                                    <form id="form_data" action="{{ route('grncsv.upload.submit') }}" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            @csrf
                                            
                                            
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">CSV</label>
                                                    <input title="upload csv file"
                                                        required class="form-control" type="file" name="csv_file"
                                                        placeholder="Enter csv" accept=".csv">
                                                </div>
                                            </div>

                                            

                                           

                                           

                                            <hr>
                                            <div class="col-sm-12 mt-3 text-center">
                                              

                                                    <button  onclick="chk_csv_upload()" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"  data-bs-toggle="modal"
                                                    data-bs-target="#confirm-csv-chk">Upload CSV</a>
                                            </div>
                                        </div>

                                    </form>
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
<div class="modal fade" id="confirm-csv-chk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">CSV Confirm Upload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="csv_confirm">
                
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function chk_csv_upload() {
       // alert('gg');
        var form = document.getElementById('form_data');
            var method = "POST";
            var formdata = new FormData(form);
            var formdata = new FormData(form);
            var formElements_button = Array.from(form.elements).pop();
            preloader(formElements_button);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //alert(this.responseText);
                    $('#csv_confirm').empty();
                    // Populate the Book dropdown with new options
                    document.getElementById('csv_confirm').innerHTML = this.responseText;
                    // Refresh the selectpicker to reflect the changes                
                 stopPreloader(formElements_button);
                }
                else
                {
                    //alert('err');
                }
                 method;
                };
            xhttp.open(method, '{{ route('chk.grncsv.upload.submit') }}', true);
            xhttp.send(formdata);
           // $('#confirm-csv-chk').modal.show();

    }

    function csv_proceed() {
        //alert('1111');
        selectDrop('form_data', '{{ route('grncsv.upload.submit') }}','csv_confirm');
        //alert('2222');
        //$('#confirm-csv-chk').modal('hide');
        //alert(url);
        var myTimeout = setTimeout(redirectPage, 5000);
    }
    function redirectPage()
    {
        var url ="{{route('grncsv.index')}}"; 
        window.location.href = url;
    }
</script>