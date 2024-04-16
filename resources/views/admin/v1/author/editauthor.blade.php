<x-layout>
   @slot('title',)
    @slot('body')

    <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        @if(isadmin())
                                        <h4 class="card-title">Update Author</h4>
                                        @endif
                                        @if(isPublisher())
                                        <h4 class="card-title">View Author</h4>
                                        @endif
                                    </div>
      
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive-lg">
                                        <form action="{{Route('author.index.update',[$edit->id])}}" method="post">
                                        @csrf
                                        <div class="row">
                                          @if(isadmin())
                                        <div class="form-group">
                                            <label class="required">Name</label>
                                            <input required="" type="text" class="form-control" placeholder="Enter Author Name" name="name" value="{{$edit->name}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="required">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="active" {{ $edit->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive" {{ $edit->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                        </div>
                                        @endif
                                        
                                        @if(isPublisher() || isCentral() || isRetail())
                                        <div class="form-group">
                                            <label class="required">Name</label>
                                            <input required="" type="text" class="form-control" placeholder="Enter Author Name" name="name" value="{{$edit->name}}" readonly>
                                        </div>
                                        @endif
                                        
                                        @if(isPublisher() || isCentral() || isRetail())
                                        <div class="form-group">
                                            <label class="optional">Description</label>
                                            <input  type="text" class="form-control" placeholder="Enter Author Description" name="description" value="{{$edit->description}}">
                                        </div>
                                        </div>
                                        @endif

                                        @if(isadmin())
                                        <div class="col-sm-12 text-center">
                                            <button type="submit" class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Update Author</button>
                                        </div>
                                        @endif
                                        </form>                                      
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Button trigger modal -->
                </div>
            </div>
        </div>
    
    @endslot
</x-layout>