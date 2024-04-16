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


                                    <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('roles.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('roles.update') }}" method="POST">
                                        <div class="row">
                                            @csrf


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name" class="required">Role For</label>
                                                    <input required type="text" class="form-control"
                                                        value="{{ $data->type }}" readonly>
                                                    <input type="hidden" value="{{ $data->id }}" name="id"
                                                        id="id">
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name" class="required">Role name</label>
                                                    <input required type="text" class="form-control"
                                                        value="{{ $data->name }}" readonly>
                                                </div>
                                            </div>




                                            <div class="col-12">
                                                <h4>Role Permissions</h4>
                                                <!-- Permission table -->
                                                <div class="table-responsive">
                                                    <table class="table table-flush-spacing">
                                                        <tbody>
                                                            <tr>
                                                                <td class="text-nowrap fw-medium"> Access <i
                                                                        class="bx bx-info-circle bx-xs"
                                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                                        aria-label="Allows a full access to the system"
                                                                        data-bs-original-title="Allows a full access to the system"></i>
                                                                </td>
                                                                <td>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            onclick="selectAllPermission(this,'edit-permission')"
                                                                            id="editSelectAll">
                                                                        <label class="form-check-label" for="editSelectAll">
                                                                            Select All
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @foreach ($permissions as $key => $permission)
                                                                <tr>
                                                                    <td class="text-nowrap fw-medium">{{ $key }}
                                                                    </td>
                                                                    <td>
                                                                        <div class="d-flex">

                                                                            <div class="form-check me-3 me-lg-5">
                                                                                <input
                                                                                    onclick="specificAll('edit{{ $key }}')"
                                                                                    class="form-check-input edit-permission"
                                                                                    type="checkbox"
                                                                                    id="for{{ $key }}">
                                                                                <label class="form-check-label"
                                                                                    for="for{{ $key }}">
                                                                                    All
                                                                                </label>
                                                                            </div>

                                                                            @foreach ($permission as $sub_permission)
                                                                                @if (explode('.', @$sub_permission)[1] ?? '' !== '')
                                                                                    <div class="form-check me-3 me-lg-5">
                                                                                        <input name="permission[]"
                                                                                            value="{{ @$sub_permission }}"
                                                                                            {{ $data->checkPermission($sub_permission) }}
                                                                                            class="form-check-input edit{{ $key }}  edit-permission"
                                                                                            type="checkbox"
                                                                                            id="1{{ @$sub_permission }}">
                                                                                        <label class="form-check-label"
                                                                                            for="1{{ @$sub_permission }}">
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
                                                <a class="btn btn-secondary mt-2"
                                                    href="{{ route('roles.index') }}">Cancel</a>

                                                <button type="submit" class="btn btn-primary mt-2">Update
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
