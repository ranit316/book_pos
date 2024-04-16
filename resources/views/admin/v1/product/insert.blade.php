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
                                        <h4 class="card-title">Create {{ $page }}</h4>
                                    </div>

                                    <a href="{{ route('books.index') }}"
                                        class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        type="button"><i class="uil-arrow-left me-2 me-2"></i>Back to List</a>
                                    {{-- <a class="btn btn-primary add-list btn-sm text-white"
                                        href="{{ route('books.index') }}"><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a> --}}
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('books.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            @csrf

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="category_id" class="required">Genres</label>
                                                    <select id="category_id" required type="text"
                                                        class="form-control selectpicker" data-live-search="true"
                                                        placeholder="Enter  category " name="category_id">
                                                        <option selected disabled> - Select Genres - </option>
                                                        @foreach ($categories as $cate)
                                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            @if(isAdmin())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="supplier_id" class="required">Publisher</label>
                                                    <select id="supplier_id" required type="text"
                                                        class="form-select form-control selectpicker"
                                                        data-live-search="true" 
                                                        name="supplier_id">

                                                       

                                                        <option selected disabled> - Select Publisher - </option>
                                                        @foreach ($suppliers as $supplier)
                                                        @if($supplier->publisher)
                                                            <option value="{{ $supplier->id }}"
                                                               >
                                                                {{ $supplier->publisher->store_name }}
                                                            </option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @else
                                            <input type="hidden" name="supplier_id" value="{{auth()->user()->id}}">

                                            @endif
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title" class="required">title</label>
                                                    <input id="title" required type="text" class="form-control"
                                                        placeholder="Enter  title" name="title">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="author" class="required">Author</label>
                                                    <select id="author" class="form-control selectpicker require"
                                                        data-live-search="true" name="author">
                                                        <option value=""> - select Author - </option>
                                                        @foreach ($authors as $author)
                                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>



                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="isbn" class="optional">isbn</label>
                                                    <input id="isbn" type="number" class="form-control"
                                                        placeholder="Enter  isbn" name="isbn">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="price" class="required">MRP</label>
                                                    <input id="price" required type="number" class="form-control"
                                                        placeholder="Enter  price" name="price">
                                                </div>
                                            </div>

                                            
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publication_date" class="required">Publication date</label>
                                                    <input id="publication_date" required type="date"
                                                        class="form-control" placeholder="Enter  publication_date"
                                                        name="publication_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="language" class="required">Language</label>
                                                    <select id="language" required type="text"
                                                        class="form-control selectpicker" data-live-search="true"
                                                        placeholder="Enter language " name="language">
                                                        <option value="" selected> - select language - </option>
                                                        {{-- @foreach ($units as $unit) --}}
                                                        <option value="Bengali">Bengali</option>
                                                        <option value="Hindi">Hindi</option>
                                                        <option value="English">English</option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                           

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="unit" class="required">Unit</label>
                                                    <select id="unit" required  class="form-control" name="unit_id">

                                                       

                                                        {{-- <option value="">Select Unit</option> --}}
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}">{{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            



                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">pages</label>
                                                    <input id="pages" type="text" class="form-control"
                                                        placeholder="Enter  pages" name="pages">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">Image</label>
                                                    <input onchange="image_check(this, 1024)" title="upload icon images"
                                                        class="form-control" type="file" name="image"
                                                        placeholder="Enter state">
                                                </div>
                                            </div>

                                           

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">volume</label>
                                                    <input id="volume" type="number" class="form-control"
                                                        placeholder="Enter  volume" name="volume">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="binding_type" class="optional">binding type</label>
                                                    <select id="binding_type"  class="form-control"
                                                         name="binding_type">
                                                        <option value="" selected> - select type - </option>
                                                       
                                                        <option value="Hard Back" >Hard Back</option>
                                                        <option value="Paper Back">Paper Back</option>
                                                        <option value="Hard Cover" >Hard Cover</option>
                                                        <option value="Soft Cover">Soft Cover</option>
                                                        <option value="Soft" >Soft</option>
                                                        <option value="Hard">Hard</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">edition</label>
                                                    <select id="edition" type="text" class="form-control selectpicker"
                                                        placeholder="Enter  edition" name="edition" required data-live-search="true">
                                                        <option value="first" selected>First </option>
                                                        <option value="secend">Secend </option>
                                                        <option value="third">Third </option>
                                                        <option value="forth">Forth </option>
                                                        <option value="fifth">Fifth </option>
                                                        <option value="sixth">Sixth </option>
                                                        <option value="seventh">Seventh </option>
                                                        <option value="eight">Eight </option>
                                                        <option value="nineth">Nineth </option>
                                                        <option value="tenth">Tenth </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">series</label>
                                                    <input id="series" type="text" class="form-control"
                                                        placeholder="Enter  series" name="series">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">issue</label>
                                                    <input id="issue" type="text" class="form-control"
                                                        placeholder="Enter  issue" name="issue">
                                                </div>
                                            </div>
                                            {{-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="required">Status</label>
                                                    <select  required  class="form-control"
                                                          name="status">
                                                        <option value="" selected> - select status - </option> --}}
                                                        {{-- @foreach ($units as $unit) --}}
                                                        {{-- <option value="active" selected>Active</option> --}}
                                                        {{-- <option value="inactive">InActive</option> --}}
                                                        {{-- @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}


                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12 mt-3 text-center">
                                                <button onclick="ajaxCall('form_data','{{ route('books.index') }}')"
                                                    type="button" class="btn btn-success btn-rounded"><i
                                                        class="uil uil-check me-2"></i>Save {{ $page }}</button>
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
