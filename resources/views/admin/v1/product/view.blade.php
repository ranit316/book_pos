
                                        <div class="row">
                                          
                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="category_id" class="">Genre</label>
                                                    <select id="category_id" required type="text" class="form-control"
                                                        placeholder="Enter  category " name="category_id" disabled>
                                                        <option value=""> - Select Genre - </option>
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
                                                    <label for="category_id" class="">Genre</label>
                                                    <select id="category_id" required type="text" class="form-control readonly"
                                                        placeholder="Enter  category " name="category_id" disabled>
                                                        <option value=""> - Select Genre - </option>
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
                                                    <label for="supplier_id" class="">Publisher</label>
                                                    <select id="supplier_id"   class="form-control"
                                                        name="supplier_id" disabled>
                                                        <option disabled> - Select Publisher - </option>
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

                                            



                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title" class="">Title</label>
                                                    <input id="title"  type="text" class="form-control"
                                                        placeholder="Enter  title" name="title"
                                                        value="{{ $data->title }}" readonly>
                                                </div>
                                            </div>
                                            @endif


                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="title" class="">Title</label>
                                                    <input id="title"  type="text" class="form-control"
                                                        placeholder="Enter  title" name="title"
                                                        value="{{ $data->title }}" readonly>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="author" class="">Author</label>
                                                    
                                                    <select    class="form-control" 
                                                         name="author" disabled>
                                                        <option value=""> - select Author - </option>
                                                        @foreach ($authors as $author)
                                                        <option value="{{$author->id}}" {{$data->author==$author->id?'selected':''}}>{{$author->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="isbn" class="">isbn</label>
                                                    <input id="isbn"  type="text" class="form-control"
                                                        placeholder="Enter  isbn" name="isbn"
                                                        value="{{ $data->isbn }}" readonly>
                                                </div>
                                            </div>
                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="price" class="">price</label>
                                                    <input id="price"  type="text" class="form-control"
                                                        placeholder="Enter  price" name="price"
                                                        value="{{ $data->price }}" readonly>
                                                </div>
                                            </div>
                                            @endif


                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="price" class="">price</label>
                                                    <input id="price"  type="text" class="form-control"
                                                        placeholder="Enter  price" name="price"
                                                        value="{{ $data->price }}" readonly>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isAdmin() || (isPublisher()))
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publication_date" class="">publication date</label>
                                                    <input id="publication_date"  type="date"
                                                        value="{{ $data->publication_date }}" class="form-control"
                                                        placeholder="Enter  publication_date" name="publication_date" readonly>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isCentral())
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="publication_date" class="">publication_date</label>
                                                    <input id="publication_date"  type="date"
                                                        value="{{ $data->publication_date }}" class="form-control"
                                                        placeholder="Enter  publication_date" name="publication_date" readonly>
                                                </div>
                                            </div>
                                            @endif


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="language" class="">language</label>
                                                  

                                                        <select id="language"  class="form-control " data-live-search="true"
                                                        placeholder="Enter language " name="language" disabled>
                                                        <option selected> - select language - </option>
                                                        
                                                        <option value="Bengali" {{$data->language=='Bengali'?'selected':''}}>Bengali</option>
                                                        <option value="Hindi" {{$data->language=='Hindi'?'selected':''}}>Hindi</option>
                                                        <option value="English" {{$data->language=='English'?'selected':''}}>English</option>
                                                       
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="weight" class="">weight</label>
                                                    <input id="weight"  type="text" class="form-control"
                                                        placeholder="Enter  weight" name="weight"
                                                        value="{{ $data->weight }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="dimensions" class="">dimensions</label>
                                                    <input id="dimensions"  type="text" class="form-control"
                                                        placeholder="Enter  dimensions" name="dimensions"
                                                        value="{{ $data->dimensions }}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="pages" class="">pages</label>
                                                    <input id="pages"  type="text" class="form-control"
                                                        placeholder="Enter  pages" name="pages"
                                                        value="{{ $data->pages }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">volume</label>
                                                    <input id="volume" type="number" class="form-control"
                                                        placeholder="Enter  volume" name="volume" value="{{ $data->volume }}" readonly>
                                                </div>
                                            </div>

                                           

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="unit" class="">Unit</label>
                                                    <select id="unit"   class="form-control" name="unit_id" disabled>
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
                                                    <label for="binding_type" class="">binding type</label>
                                                    <select id="binding_type"  class="form-control"
                                                         name="binding_type" disabled>
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
                                                    <label class="">edition</label>
                                                    <input id="edition" type="text" class="form-control"
                                                        placeholder="Enter  edition" name="edition" value="{{ $data->edition }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">series</label>
                                                    <input id="series" type="text" class="form-control"
                                                        placeholder="Enter  series" name="series" value="{{ $data->series }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="">issue</label>
                                                    <input id="issue" type="text" class="form-control"
                                                        placeholder="Enter  issue" name="issue" value="{{ $data->issue }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="required">Images</label>
                                                   

                                                            <a target="blank" href="{{ asset($data->image) }}">
                                                                <img class="img-fluid" src="{{ asset($data->image) }}"

                                                           

                                                                    alt="">

                                                            </a>
                                                       
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="status" class="">Status</label>
                                                    <select    class="form-control"
                                                          name="status" disabled>
                                                        <option value="" selected> - select status - </option>
                                                        {{-- @foreach ($units as $unit) --}}
                                                        <option value="active" {{$data->status=='active'?'selected':''}}>Active</option>
                                                        <option value="inactive" {{$data->status=='inactive'?'selected':''}}>InActive</option>
                                                        {{-- @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label class=""> Description</label>
                                                    <textarea  class="form-control" placeholder="Enter name" name="description" readonly>{{ $data->description}}</textarea>
                                                </div>
                                            </div>
                                            <hr>
                                           
                                        </div>