<x-layout>
    @slot('title')
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
                                            <h4 class="card-title text-capitalize">Create User </h4>
                                        </div>

                                        <a href="{{ route('admin.index') }}"
                                            class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                            type="button"><i class="uil-arrow-left me-2 me-2"></i>Back to List</a>


                                    </div>

                                    <div class="card-body">
                                        <form id="form_data" action="{{ route('admin.store') }}" method="POST">
                                            <div class="row">
                                                @csrf
                                                @if (isAdmin())
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="type" class="required">Choose User Type</label>
                                                            <select id="role" required class="form-control selectpicker"
                                                                onchange="changeusertype76(this.value);" data-live-search="true"
                                                                name="role">
                                                                <option selected disabled> - Select User Type- </option>
                                                                @foreach ($roles as $role)
                                                                    <option value="{{ $role }}">{{ $role }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (isPublisher())
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="type" class="required">Choose User Type</label>
                                                            <select id="role" required class="form-control selectpicker"
                                                                onchange="changeusertype76(this.value);" data-live-search="true"
                                                                name="role">
                                                                <option selected disabled> - Select User Type- </option>
                                                                @foreach ($roles as $role)
                                                                    @if ($role === 'publisher')
                                                                        <option value="{{ $role }}" selected>{{ $role }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-sm-4">
                                                    <div class="form-group" style="display:none;" id="publisheriddiv">
                                                        <label for="publisher_id_value" class="required">Publishers</label>
                                                        <select id="publisher_id_value" class="form-control"
                                                            name="publisher_id_value">
                                                            <option value="" disabled> - Select Publisher- </option>
                                                            @foreach ($publishers as $publisher)
                                                                <option value="{{ $publisher->id }}">
                                                                    {{ $publisher->store_name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @if(isPublisher())
                                                    <div class="form-group" style="display:block;" id="publisheriddiv">
                                                        <label for="publisher_id_value" class="required">Publishers</label>
                                                        <select id="publisher_id_value" class="form-control"
                                                            name="publisher_id_value">
                                                            <option value="" disabled> - Select Publisher- </option>
                                                            @foreach ($publishers as $publisher)
                                                                <option value="{{ $publisher->id }}">
                                                                    {{ $publisher->store_name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                    <div class="form-group" style="display:none;" id="centralstoreiddiv">
                                                        <label for="central_store_id" class="required">Central Store</label>
                                                        <select id="central_store_id" class="form-control"
                                                            name="central_store_id">
                                                            <option value="" disabled> - Select central store- </option>
                                                            @foreach ($central_stores as $central_store)
                                                                <option value="{{ $central_store->id }}">
                                                                    {{ $central_store->store_name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group" style="display:none;" id="retailstoreiddiv">
                                                        <label for="retail_store_id" class="required">Retail Store</label>
                                                        <select id="retail_store_id" class="form-control"
                                                            name="retail_store_id">
                                                            <option value="" disabled> - Select retail store- </option>
                                                            @foreach ($retail_stores as $retail_store)
                                                                <option value="{{ $retail_store->id }}">
                                                                    {{ $retail_store->store_name }} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                @if (isAdmin())
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="role_id" class="required">Choose User Role</label>
                                                            <select id="role_id" required class="form-control"
                                                                name="role_id">
                                                                <option value=""> - Select Role - </option>
                                                                @foreach ($type as $typ)
                                                                    @if ($typ->name != 'Admin')
                                                                        <option value="{{ $typ->id }}">
                                                                            {{ $typ->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif


                                                @if (isPublisher())
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="role_id" class="required">Choose User Role</label>
                                                            <select id="" required class="form-control "
                                                                name="role_id">
                                                                <option value=""> - Select Role - </option>
                                                                @foreach ($type as $typ)
                                                                    @if ($typ->id == 6)
                                                                        <option value="{{ $typ->id }}">
                                                                            {{ $typ->name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="required">Name</label>
                                                        <input required type="text" class="form-control"
                                                            placeholder="Enter Full Name" name="name">
                                                    </div>
                                                </div>


                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="required">email</label>
                                                        <input required type="text" class="form-control"
                                                            placeholder="Enter  email address" name="email">

                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="required">mobile</label>
                                                        <input required type="number" class="form-control"
                                                            onclick="maxnumvalidate(this.value,'mobile',10);"
                                                            onkeyup="maxnumvalidate(this.value,'mobile',10);"
                                                            placeholder="Enter 10 digit valid  mobile number" id="mobile"
                                                            name="mobile">
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="required">password</label>
                                                        <input required type="password" class="form-control"
                                                            placeholder="Enter  password" name="password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="required">Confirmed Passoword</label>
                                                        <input required type="password" class="form-control"
                                                            placeholder="Enter  Confirmed Passoword"
                                                            name="password_confirmation">
                                                    </div>
                                                </div>


                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label class="optional"> Description</label>
                                                        <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 text-center">
                                                    <button type="submit" class="btn btn-success btn-rounded"
                                                        onclick="ajaxCall('form_data','{{ route('admin.index') }}')"><i
                                                            class="uil uil-check me-2"></i>Add User</button>
                                                </div>
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
    {{-- <script>
    selectDrop('form_data','{{ route('admin.get_role') }}','role_id')
</script> --}}
    <!-- // model -->
    <script>
        function changeusertype76(type) {
            // alert(type);
            //$('#publisheriddiv').hide();
            //$('#centralstoreiddiv').hide();
            // $('#retailstoreiddiv').hide();
            document.getElementById('publisheriddiv').style.display = 'none';
            document.getElementById('centralstoreiddiv').style.display = 'none';
            document.getElementById('retailstoreiddiv').style.display = 'none';

            if (type == 'publisher') {
                document.getElementById('publisheriddiv').style.display = 'block';
            } else if (type == 'central-store') {
                document.getElementById('centralstoreiddiv').style.display = 'block';
            } else if (type == 'retail-store') {
                document.getElementById('retailstoreiddiv').style.display = 'block';
            }
        }


        $(document).ready(function() {


            $('#role').change(function(e) {
                e.preventDefault();
                let role = $(this).val();
                //alert(role);
                $('#role_id').html('<option value="">Select Role</option>');
                if (role) {
                    $.ajax({
                        type: "GET",
                        url: '{{ route('admin.get_role', ':role') }}'.replace(':role', role),
                        success: function(data) {
                            $.each(data, function(key, value) {
                                if (value.name != "Admin"){
                                    $('#role_id').append('<option value="' + value.id +
                                    '">' + value.name + '</option>');
                                }
                               
                                //$('.selectpicker').selectpicker('refresh')
                            });
                        }
                    });
                }

            });
        });

        // window.addEventListener('DOMContentLoaded', function() {
        //     var selectElement = document.getElementById('.role_i');
        //     var options = selectElement.options;

        //     for (var i = 0; i < options.length; i++) {
        //         if (options[i].text === 'Admin') {
        //             selectElement.remove(i);
        //             break;
        //         }
        //     }
        // });
    </script>
