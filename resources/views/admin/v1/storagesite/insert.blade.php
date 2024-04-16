<!-- The Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">Add {{$pagename}}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="form_data" action="{{ route('storagesites.store') }}" method="POST">
                    <div class="row">
                        @csrf
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >Name</label>
                                <input required type="text" class="form-control"    placeholder="Enter Site Name" name="name">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >Address</label>
                                <input required  type="text" class="form-control" placeholder="Enter Address" name="address">
                            </div>
                        </div>

                        {{-- <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >Store</label>
                                <input  type="text" class="form-control" placeholder="Enter store" name="store_id">
                            </div>
                        </div> --}}

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="optional" >pincode</label>
                                <input  type="number" class="form-control limitedpin" placeholder="Enter pincode" name="pincode" maxlength ="10" data-max-chars="10">
                            </div>
                        </div>
                        
              

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="optional"> Description</label>
                                <textarea  type="text" class="form-control" placeholder="Enter description" name="description"></textarea>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="required" >default</label>
                                <select class="form-control"  name="flag" >
                                  <option value="">No</option>
                                  <option value="default">Yes</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button type="button" onclick="ajaxCall('form_data')"
                                class="btn btn-success btn-rounded"><i class="uil uil-check me-2"></i>Save {{$pagename}}</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- // model -->



<script>

   $(document).ready(function() { 
 charLimit_pincode(6);
 
});

function charLimit_pincode(limit){
 
 $('.charLimit').text('(' + limit + '):');
 $('.charLeft').text(limit);
 
 //still working on getting mouse cut and paste working
 $('.limitedpin').bind({
   copy : function(){
     console.log("copy");
   },
   paste : function(){
     console.log("paste");
     var charLen = this.value.length;
     var textVal = limit - charLen;
     console.log(charLen);
     console.log(textVal);
     if (charLen >= limit) {
       this.value = this.value.substring(0, limit);
     }
     if (textVal <= limit && textVal > 1){
     $('.charLeft').removeClass('charError').text(textLen);
     }
   },
   cut : function(){
     console.log("cut");
   }
 });
 
 $('.limitedpin').keyup(function() {
   var charLen = this.value.length;
   var textLen = $('.charLeft').text(limit - charLen);
   var textVal = limit - charLen;
   if (charLen >= limit) {
     this.value = this.value.substring(0, limit);
   }
   if (textVal <= limit && textVal > 1){
     $('.charLeft').removeClass('charError').text(textLen);
   }else if(textVal <= 0){
     $('.charLeft').text('limit reached').addClass('charError');
   } 
 });
}

 </script>
