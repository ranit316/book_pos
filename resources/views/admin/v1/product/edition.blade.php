<x-layout>

    @slot('title', 'Edition')

    @slot('body')


        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Edition {{ $page }}</h4>
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
                                    <form id="form_data" action="{{ route('book.edition.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="row">
                                            @csrf

                                            {{-- <body onload="check($('input[name=type]:checked').val())">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-md-8 pb-3">
                                                            <div>
                                                                <h5 class="font-size-13 text-uppercase text-muted mb-4"><i
                                                                        class="mdi mdi-chevron-right text-primary me-1"></i>
                                                                    Select Type</h5>
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <div class="form-check mb-2">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="type" id="radiotypeEdition"
                                                                                onclick="check(this.value)" value="edition"
                                                                                checked>
                                                                            <label class="form-check-label"
                                                                                for="radiotypeEdition">Edition</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio"
                                                                                name="type" id="radiotypeReprint"
                                                                                onclick="check(this.value)" value="reprint">
                                                                            <label class="form-check-label"
                                                                                for="radiotypeReprint">Reprint</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}

                                                @if (isAdmin())

                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label for="supplier_id"
                                                                        class="required">Publisher</label>
                                                                    <select id="supplier_id" required type="text"
                                                                        class="form-select form-control selectpicker"
                                                                        data-live-search="true" name="supplier_id"
                                                                        onchange="publisher_id(this.value)">



                                                                        <option selected disabled> - Select Publisher -
                                                                        </option>
                                                                        @foreach ($suppliers as $supplier)
                                                                            @if ($supplier->publisher)
                                                                                <option value="{{ $supplier->id }}">
                                                                                    {{ $supplier->publisher->store_name }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="supplier_id"
                                                                                class="required">Publisher</label>
                                                                            <select id="supplier_id" required type="text"
                                                                                class="form-select form-control selectpicker"
                                                                                data-live-search="true" name="supplier_id"
                                                                                onchange="publisher_id(this.value)">



                                                                                <option selected disabled> - Select
                                                                                    Publisher -
                                                                                </option>
                                                                                @foreach ($suppliers as $supplier)
                                                                                    @if ($supplier->publisher)
                                                                                        <option value="{{ $supplier->id }}">
                                                                                            {{ $supplier->publisher->store_name }}
                                                                                        </option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                @endif

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="book_title" class="required">Book Title</label>
                                                        <select id="book_title" required
                                                            class="form-select form-control selectpicker"
                                                            data-live-search="true" onchange="books(this.value)"
                                                            name="title">
                                                            <option selected disabled> - Select Publisher First </option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                </div>

                                <body onload="check($('input[name=type]:checked').val())">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-md-8 pb-3">
                                                <div>
                                                    <h5 class="font-size-13 text-uppercase text-muted mb-4"><i
                                                            class="mdi mdi-chevron-right text-primary me-1"></i>
                                                        Select Type</h5>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="type" id="radiotypeEdition"
                                                                    onclick="check(this.value)" value="edition"
                                                                    checked>
                                                                <label class="form-check-label"
                                                                    for="radiotypeEdition">Edition</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    name="type" id="radiotypeReprint"
                                                                    onclick="check(this.value)" value="reprint">
                                                                <label class="form-check-label"
                                                                    for="radiotypeReprint">Reprint</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                <div class="col-lg-12" id="book_data" style="display: none;">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="genres" class="required">Genres</label>
                                                <input id="genres" required readonly type="text" class="form-control"
                                                    value="" placeholder="Enter Category" name="genres">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="author" class="required">Author</label>
                                                <input id="author" required readonly type="text"
                                                    class="form-control" value="" placeholder="Enter Author"
                                                    name="author">
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
                                                <input id="publication_date" required type="date" class="form-control"
                                                    placeholder="Enter  publication_date" name="publication_date">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="language" class="required">Language</label>
                                                <input id="language" required type="text" readonly
                                                    class="form-control" placeholder="Enter Language" name="language">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="unit" class="">Unit</label>
                                                <input id="unit" type="text" class="form-control"
                                                    placeholder="Enter unit" name="unit" readonly>
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
                                                    placeholder="Enter state" id="image_name">
                                            </div>
                                            <img id="book_image" src="" alt="Book Image" class="book_thumb">
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
                                                <select id="binding_type" class="form-control" name="binding_type">
                                                    <option value="" selected> - select type - </option>

                                                    <option value="Hard Back">Hard Back</option>
                                                    <option value="Paper Back">Paper Back</option>
                                                    <option value="Hard Cover">Hard Cover</option>
                                                    <option value="Soft Cover">Soft Cover</option>
                                                    <option value="Soft">Soft</option>
                                                    <option value="Hard">Hard</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4 type" style="" id="edition_div">
                                            <div class="form-group">
                                                <label class="required">edition</label>
                                                <select id="edition" type="text" class="form-control selectpicker"
                                                    placeholder="Enter  edition" name="edition" required
                                                    data-live-search="true">
                                                    <option value="first" >First </option>
                                                    <option value="secend">Second </option>
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
                                                <select required class="form-control" name="type" id="type">
                                                    <option value="" selected> - select status - </option>
                                                    <option value="reprint" selected>Reprint</option>
                                                    <option value="edition">Edition</option>
                                                </select>
                                            </div>
                                        </div> --}}


                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="optional"> Description</label>
                                                <textarea type="text" class="form-control" placeholder="Enter name" name="description"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-sm-12 mt-3 text-center" id="save_btn" style="display: none;">
                                    <button onclick="ajaxCall('form_data','{{ route('books.index') }}')" type="button"
                                        class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Save
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

<script>
    function publisher_id(value) {
        //alert(value);
        var pub_id = value;

        $.ajax({
            type: "GET",
            url: "{{ route('book.details', ['id' => ':pub_id']) }}".replace(':pub_id', pub_id),
            success: function(response) {
                //console.log(response);
                $('#book_title').empty();

                $('#book_title').append('<option selected disabled> - Select book First </option>')
                // Add new options from the response
                response.forEach(function(book) {
                    $('#book_title').append('<option value="' + book.id + '">' + book.title +
                        '</option>');
                    $('.selectpicker').selectpicker('refresh');
                    $('#supplier_id').prop('readonly', true);
                });

            }
        });
    }

    function books(value) {
        //alert(value);
        //console.log(type);
        var book_id = value;
        //var type = document.getElementById('type').value;


        $.ajax({
            type: "GET",
            url: "{{ route('book.get', ['id' => ':book_id']) }}".replace(':book_id', book_id),
            success: function(response) {
                //console.log(response);
                var baseUrl = response.baseUrl;
                var imageUrl = response.image;
                var fullUrl = baseUrl + '/' + imageUrl;
                $('#book_data').show();
                $('#save_btn').show();
                $('#genres').val(response.bookcategory.name);
                $('#author').val(response.author.name);
                $('#isbn').val(response.isbn);
                $('#price').val(response.price);
                $('#language').val(response.language);
                $('#unit').val(response.unit.name);
                $('#pages').val(response.pages);
                $('#volume').val(response.volume);
                $('#publication_date').val(response.publication_date);
                $('#binding_type').val(response.binding_type).prop('selected', true);
                $('#edition').val(response.edition).prop('selected', true);
                $('#series').val(response.series);
                $('#issue').val(response.issue);
                $('#description').val(response.description);
                $('input[name="type"][value="' + response.type + '"]').prop('checked', true);
                //$('#book_image').attr('src', fullUrl);
                $('#image_name').val(response.image);
            }
        });

    }

    function check(value) {
        var type = value;
        if (type == 'reprint') {
            $('#edition').parent().parent().hide(); // Hide the parent element of #edition
            $('#edition').removeAttr('required');
        } else {
            $('#edition').parent().parent().show(); // Show the parent element of #edition
        }
    }
</script>
