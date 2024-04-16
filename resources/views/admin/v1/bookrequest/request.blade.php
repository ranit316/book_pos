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
                                        href=""><i class="las la-plus mr-3"></i>Back to
                                        {{ $page }} List</a>
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{route('central.book.add')}}" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            @csrf

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="category_id" class="required">Category</label>
                                                    <select id="category_id" required type="text" class="form-control"
                                                        placeholder="Enter  category " name="category_id">
                                                        <option selected disabled> - Select Category - </option>
                                                        @foreach ($categories as $cate)
                                                            <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                         

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="brand_id" class="required">Gst Slab</label>
                                                    <select id="brand_id" required type="text" class="form-control"
                                                        placeholder="Enter  category " name="gst_slab_id">
                                                        <option selected disabled> - Select Category - </option>
                                                        @foreach ($gst_slabs as $slab)
                                                            <option value="{{ $slab->id }}">{{ $slab->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="supplier_id" class="required">Supplier</label>
                                                    <select id="supplier_id" required type="text" class="form-control"
                                                        placeholder="Enter  Supplier " name="supplier_id">
                                                        <option selected disabled> - Select Supplier - </option>
                                                        @foreach ($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title" class="required">title</label>
                                                    <input id="title" required type="text" class="form-control"
                                                        placeholder="Enter  title" name="title">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="author" class="required">author</label>
                                                    <input id="author" required type="text" class="form-control"
                                                        placeholder="Enter  author" name="author">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="isbn" class="required">isbn</label>
                                                    <input id="isbn" required type="text" class="form-control"
                                                        placeholder="Enter  isbn" name="isbn">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="price" class="required">price</label>
                                                    <input id="price" required type="text" class="form-control"
                                                        placeholder="Enter  price" name="price">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publication_date" class="required">publication_date</label>
                                                    <input id="publication_date" required type="date"
                                                        class="form-control" placeholder="Enter  publication_date"
                                                        name="publication_date">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="language" class="required">language</label>
                                                    <input id="language" required type="text" class="form-control"
                                                        placeholder="Enter  language" name="language">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="weight" class="required">weight</label>
                                                    <input id="weight" required type="text" class="form-control"
                                                        placeholder="Enter  weight" name="weight">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="dimensions" class="required">dimensions</label>
                                                    <input id="dimensions" required type="text" class="form-control"
                                                        placeholder="Enter  dimensions" name="dimensions">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="pages" class="required">pages</label>
                                                    <input id="pages" required type="text" class="form-control"
                                                        placeholder="Enter  pages" name="pages">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Images</label>
                                                    <input onchange="image_check(this, 100)" title="upload icon images"
                                                        required class="form-control" type="file" name="image"
                                                        placeholder="Enter state">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-sm-12 mt-3 text-center">
                                                <button type="submit" 
                                                    class="btn btn-primary mt-2">Add {{ $page }}</button>
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
