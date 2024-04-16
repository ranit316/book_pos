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
                                    <a href="{{ route('roles.index') }}"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        type="button"><i class="uil-arrow-left me-2 me-2"></i>Back to {{ $page }}
                                        List</a>
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('roles.store') }}" method="POST">
                                        <div class="row">
                                            @csrf


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="type" class="required"> Role for</label>
                                                    <select id="type" required class="form-control selectpicker"
                                                        data-live-search="true" name="type">
                                                        <option selected disabled> - Select Type - </option>
                                                        <option value="central-store">Central Store</option>
                                                        <option value="retail-store">Retail Store</option>
                                                        <option value="publisher">Publisher</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name" class="required">Role name</label>
                                                    <input id="name" required type="text" class="form-control"
                                                        placeholder="Enter Role  name" name="name">
                                                </div>
                                            </div>


         <!-- Modal body -->
         <div class="col-12">
            <h4>Role Permissions</h4>
            <!-- Permission table -->
            <div class="table-responsive">
                <table class="table table-flush-spacing">
                    <tbody>
                        <tr>
                            <td class="text-nowrap fw-medium"> Access <i
                                    class="bx bx-info-circle bx-xs" data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    aria-label="Allows a full access to the system"
                                    data-bs-original-title="Allows a full access to the system"></i>
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"
                                        onclick="selectAllPermission(this,'permission')"
                                        id="selectAll">
                                    <label class="form-check-label" for="selectAll">
                                        Select All
                                    </label>
                                </div>
                            </td>
                        </tr>
                        @foreach ($permissions as $key => $permission)
                            <tr>
                                <td class="text-nowrap fw-medium">{{ $key }}</td>
                                <td>
                                    <div class="d-flex">

                                        <div class="form-check me-3 me-lg-5">
                                            <input class="form-check-input permission "
                                                onclick="specificAll('{{ $key }}')"
                                                type="checkbox" id="1{{ $key }}"><label
                                                class="form-check-label"
                                                for="1{{ $key }}">&nbsp;All
                                            </label>
                                        </div>

                                        @foreach ($permission as $sub_permission)
                                            @if (explode('.', @$sub_permission)[1] ?? '' !== '')
                                                <div class="form-check me-3 me-lg-5">
                                                    <input name="permission[]"
                                                        value="{{ @$sub_permission }}"
                                                        class="form-check-input {{ $key }} permission"
                                                        type="checkbox"
                                                        id="{{ @$sub_permission }}">
                                                    <label class="form-check-label"
                                                        for="{{ @$sub_permission }}">
                                                        {{ \App\Auth\Permission::renamePermission(explode('.', @$sub_permission)[1] ?? '', ['index' => 'List', 'store' => 'Create&Store']) }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- Permission table -->
        </div>

                                       


                                            <hr>
                                            <div class="col-sm-12 mt-3 text-center">
                                                <a class="btn btn-secondary btn-rounded mt-2"
                                                    href="{{ route('roles.index') }}">Cancel</a>

                                                {{-- <button type="button" onclick="ajaxCall('form_data')"
                    class="btn btn-primary mt-2">Add {{ $page }}</button> --}}
                                                <button type="button" class="btn btn-success btn-rounded"
                                                    onclick="ajaxCall('form_data')"><i class="uil uil-check me-2"></i>Add
                                                    {{ $page }}</button>
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
<!-- // model -->


<script>
    // key as class
    function specificAll(key) {

        let specificClass = document.querySelectorAll('.' + key);
        for (i = 0; i < specificClass.length; i++) {
            if (specificClass[i].checked)
                specificClass[i].checked = false;
            else
                specificClass[i].checked = true;
        }

    }

    function selectAllPermission(thisValue, className) {


        if (confirm("Are sure to give all permission")) {
            const allClassName = document.querySelectorAll('.' + className);
            for (i = 0; i < allClassName.length; i++) {
                allClassName[i].checked = true;
            }
        } else {
            thisValue.checked = false
        }
    }
</script>



