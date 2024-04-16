<div>
    <div class="product_list" id="pos-prod-item-wrapper">
        <div class="row g-2 row-cols-md-3 row-cols-lg-2 row-cols-xl-3">

            @foreach ($books as $book)
            @if($book->qty > 0)
                {{-- @if ($book->master_stock_inventory) --}}
                <div class="col d-flex">
                    <div class="card all_product dash-product-box shadow-none border text-center w-100">
                    <div class="about-modal">
                                    <!-- <span class="badge bg-primary">Discounted</span> -->
                                    <a href="#" class="btn btn-link btn-sm p-0 book_info" data-book-id="{{$book->product->id}}" data-toggle="modal" data-target=""><i
                                            class="fas fa-info-circle"></i></a>

                                </div>
                        <div onclick="addToCart({{ $book->product->id }});confirm_discount_after_5sec();">

                            <div class="card-body c_body pb-2">

                                

                                <div class="dash-product-img">
                                    <img class="img-fluid" src="{{ asset($book->product->image) }}"
                                        alt="{{ $book->product->title }}">
                                    <input type="hidden" id="book_id" name="book_id" value="{{ $book->product->id }}">
                                </div>

                                <h5 class="font-size-15 mt-2 text-reset lh-base text-primary">
                                    <span class="text-reset lh-base">{{ $book->product->title }}</span>
                                </h5>
                                <h6 class="font-size-13 mt-1 mb-0 text-muted fw-normal">
                               <i class="bx bx-pencil"></i> Author <br/> Rabindranath Tagore

                                </h6>
                                <h5 class="font-size-15 text-primary mt-2 mb-0">
                                     ₹{{ $book->product->price }}
                                </h5>
                                <h6 class="font-size-16 mt-1 mb-0 text-muted fw-normal">
                                    <span class="badge bg-secondary font-size-13"> Qty : {{ $book->qty }}</span></h6>

                                <!-- <div class="mt-4">
                                    <a href="#"
                                    onclick="selectDrop('form_data_pos','{{ route('pos.add_cart', $book->id) }}','pos_cart')"
                                    class="btn btn-primary btn-sm w-lg"><i class="mdi mdi-cart me-1 align-middle"></i>
                                    Add To Cart</a>

                                    <button type="button" class="btn btn-primary btn-sm w-lg" id="addBook"><i
                                        class="mdi mdi-cart me-1 align-middle"></i>
                                    Buy
                                    Now</button>
                                </div> -->
                            </div>
                        </div>

                    </div>
                </div>
                @endif
            @endforeach






        </div>
        <!-- end row -->
    </div>

    <div class="modal fade" id="book_info1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Book Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="book_details">
                            
                        </div>
                    </div>
                </div>
            </div>
    <hr>

</div>
{{-- <div class="row pt-2">
    <div class="col-sm-12">
        <div class="">
            {!! $books->links() !!}
        </div>
    </div>
</div> --}}

<script>
    $(document).ready(function() {
        $('.book_info').click(function() {
            //console.log('hii');
            var bookId = $(this).data('book-id');
            $('#book_info1').modal('show');
            $.ajax({
                type: "GET",
                url: "{{ route('book.info', ['bookId' => ':bookId']) }}".replace(':bookId', bookId),
                success: function (response) {
                    $('#book_details').html(response);
                }
            });

        });
    });
</script>
