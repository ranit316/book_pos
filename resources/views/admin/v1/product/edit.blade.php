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


                                    <a class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"
                                        href="{{ route('books.index') }}"><i class="uil-arrow-left me-2 me-2"></i>Back to
                                        {{ $page }} List</a>
                                </div>

                                <!-- Modal body -->
                                <div class="card-body">
                                    <form id="form_data" action="{{ route('books.update', $data->id) }}" method="POST">
                                        <div class="row">
                                            @csrf
                                            @method('PUT')
                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="category_id" class="required">Genre</label>
                                                    <select id="category_id" required type="text" class="form-control"
                                                        placeholder="Enter  category " name="category_id">
                                                        <option value="" disabled> - Select Genre - </option>
                                                        @foreach ($categories as $cate)
                                                            <option {{ $data->category_id == $cate->id ? 'selected' : '' }}
                                                                value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="category_id" class="required">Genre</label>
                                                    <select id="category_id" required type="text" class="form-control readonly"
                                                        placeholder="Enter  category " name="category_id">
                                                        <option value="" disabled> - Select Genre - </option>
                                                        @foreach ($categories as $cate)
                                                            <option {{ $data->category_id == $cate->id ? 'selected' : '' }}
                                                                value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                           

                                             <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="supplier_id" class="required">Publisher</label>
                                                    <select id="supplier_id" required  class="form-control"
                                                        name="supplier_id">
                                                        <option value="" disabled> - Select Publisher - </option>
                                                        @foreach ($suppliers as $supplier)
                                                        @if($supplier->publisher)
                                                            <option
                                                                {{ $data->supplier_id == $supplier->id ? 'selected' : '' }}
                                                                value="{{ $supplier->id }}">{{ $supplier->publisher->store_name }}</option>
                                                                @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> 

                                           




                                            {{-- <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="brand_id" class="optional">Gst Slab</label>
                                                    <select id="brand_id"  class="form-control"
                                                        name="gst_slab_id">
                                                        <option value="" disabled> - Select Gst Slab - </option>
                                                        @foreach ($gst_slabs as $slab)
                                                            <option {{ $data->gst_slab_id == $slab->id ? 'selected' : '' }}
                                                                value="{{ $slab->id }}">{{ $slab->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div> --}}


                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title" class="required">Title</label>
                                                    <input id="title" required type="text" class="form-control"
                                                        placeholder="Enter  title" name="title"
                                                        value="{{ $data->title }}">
                                                </div>
                                            </div>
                                            @endif


                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title" class="required">Title</label>
                                                    <input id="title" required type="text" class="form-control"
                                                        placeholder="Enter  title" name="title"
                                                        value="{{ $data->title }}" readonly>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="author" class="required">Author</label>
                                                    
                                                        <select id="author" required  class="form-control selectpicker" data-live-search="true"
                                                         name="author">
                                                        <option value=""> - select Author - </option>
                                                        @foreach ($authors as $author)
                                                        <option value="{{$author->id}}" {{$data->author==$author->id?'selected':''}}>{{$author->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="isbn" class="optional">isbn</label>
                                                    <input id="isbn"  type="text" class="form-control"
                                                        placeholder="Enter  isbn" name="isbn"
                                                        value="{{ $data->isbn }}">
                                                </div>
                                            </div>
                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="price" class="required">price</label>
                                                    <input id="price" required type="text" class="form-control"
                                                        placeholder="Enter  price" name="price"
                                                        value="{{ $data->price }}">
                                                </div>
                                            </div>
                                            @endif


                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="price" class="required">price</label>
                                                    <input id="price" required type="text" class="form-control"
                                                        placeholder="Enter  price" name="price"
                                                        value="{{ $data->price }}" readonly>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publication_date" class="required">publication date</label>
                                                    <input id="publication_date" required type="date"
                                                        value="{{ $data->publication_date }}" class="form-control"
                                                        placeholder="Enter  publication_date" name="publication_date">
                                                </div>
                                            </div>
                                            @endif

                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publication_date" class="required">publication date</label>
                                                    <input id="publication_date" required type="date"
                                                        value="{{ $data->publication_date }}" class="form-control"
                                                        placeholder="Enter  publication_date" name="publication_date" readonly>
                                                </div>
                                            </div>
                                            @endif


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="language" class="required">language</label>
                                                  

                                                        <select id="language" required  class="form-control selectpicker" data-live-search="true"
                                                        placeholder="Enter language " name="language">
                                                        <option value=""> - select language - </option>
                                                        
                                                        <option value="Bengali" {{$data->language=='Bengali'?'selected':''}}>Bengali</option>
                                                        <option value="Hindi" {{$data->language=='Hindi'?'selected':''}}>Hindi</option>
                                                        <option value="English" {{$data->language=='English'?'selected':''}}>English</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="weight" class="optional">weight</label>
                                                    <input id="weight"  type="text" class="form-control"
                                                        placeholder="Enter  weight" name="weight"
                                                        value="{{ $data->weight }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="dimensions" class="optional">dimensions</label>
                                                    <input id="dimensions"  type="text" class="form-control"
                                                        placeholder="Enter  dimensions" name="dimensions"
                                                        value="{{ $data->dimensions }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="pages" class="optional">pages</label>
                                                    <input id="pages"  type="text" class="form-control"
                                                        placeholder="Enter  pages" name="pages"
                                                        value="{{ $data->pages }}">
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">volume</label>
                                                    <input id="volume" type="number" class="form-control"
                                                        placeholder="Enter  volume" name="volume" value="{{ $data->volume }}">
                                                </div>
                                            </div>

                                           

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="unit" class="required">Unit</label>
                                                    <select id="unit" required  class="form-control" name="unit_id">
                                                        <option value="">Select Unit</option>
                                                        @foreach ($units as $unit)
                                                            <option value="{{ $unit->id }}" {{$data->unit_id==$unit->id?'selected':''}}>{{ $unit->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="binding_type" class="optional">binding type</label>
                                                    <select id="binding_type"  class="form-control"
                                                         name="binding_type">
                                                        <option value="" selected> - select type - </option>
                                                       
                                                        <option value="Hard Back" {{$data->binding_type=='Hard Back'?'selected':''}}>Hard Back</option>
                                                        <option value="Paper Back" {{$data->binding_type=='Paper Back'?'selected':''}}>Paper Back</option>
                                                        <option value="Hard Cover" {{$data->binding_type=='Hard Cover'?'selected':''}}>Hard Cover</option>
                                                        <option value="Soft Cover" {{$data->binding_type=='Soft Cover'?'selected':''}}>Soft Cover</option>
                                                        <option value="Soft" {{$data->binding_type=='Soft'?'selected':''}}>Soft</option>
                                                        <option value="Hard" {{$data->binding_type=='Hard'?'selected':''}}>Hard</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">edition</label>
                                                    <input id="edition" type="text" class="form-control"
                                                        placeholder="Enter  edition" name="edition" value="{{ $data->edition }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">series</label>
                                                    <input id="series" type="text" class="form-control"
                                                        placeholder="Enter  series" name="series" value="{{ $data->series }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="optional">issue</label>
                                                    <input id="issue" type="text" class="form-control"
                                                        placeholder="Enter  issue" name="issue" value="{{ $data->issue }}">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">Image</label>
                                                    <div class="row">
                                                        <div class="col-10">
                                                            <input onchange="image_check(this, 100)"
                                                                title="upload icon images" class="form-control"
                                                                type="file" name="image" >
                                                        </div>
                                                        <div class="col-2">
                                                            <a target="blank" href="{{ asset($data->image) }}">
                                                                <img class="img-fluid" src="{{ asset($data->image) }}"
                                                                    alt="">

                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="required">Status</label>
                                                    <select  required  class="form-control"
                                                          name="status">
                                                        <option value="" selected> - select status - </option>
                                                        {{-- @foreach ($units as $unit) --}}
                                                        <option value="active" {{$data->status=='active'?'selected':''}}>Active</option>
                                                        <option value="inactive" {{$data->status=='inactive'?'selected':''}}>InActive</option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="optional"> Description</label>
                                                    <textarea  class="form-control" placeholder="Enter name" name="description">{{ $data->description}}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                            @if (isAdmin() || isPublisher())
                                            <div class="col-sm-12 mt-3 text-center">
                                                <button type="button" onclick="ajaxCall('form_data','{{route('books.index')}}')"
                                                    class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2"><i class="uil uil-check me-2"></i>Update {{ $page }}</button>
                                            </div>
                                            @endif
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
