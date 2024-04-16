<x-layout>
    @slot('title', 'pos')
    @slot('body')
 
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content p_content p-0">
                <div class="container-fluid text-center">
                    <h2 class="pt-5">Something went wrong Payment faild </h2>
                 <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('billdesk.payment.init') }}" class="btn btn-primary">Retry payment</a>
                    <a class="btn btn-info" href="{{route('pos.index')}}">Go to POS</a>
                 </div>
                </div>

            </div> <!-- container-fluid -->

        </div>
        <!-- End Page-content -->
    @endslot

</x-layout>
