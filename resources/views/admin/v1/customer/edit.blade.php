<x-layout>
    @slot('title', )
    @slot('body')




<div class="main-content">
    <div class="page-content">
       
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Customer List</h4>
                            </div>

{{-- 
                            <!-- <a class="btn btn-primary add-list btn-sm text-white" href="{{route('admin.setting.showdata')}}"><i -->
                                    <!-- class="las la-plus mr-3"></i>Back to setting Pages</a> -->
                        </div> --}}


                        <div class="card-body">

                        @if($errors->has('phone'))
                            <div class="danger">{{ $errors->first('phone') }}</div>
                        @endif 
                        @if($errors->has('name'))
                            <div class="danger">{{ $errors->first('name') }}</div>
                        @endif 

                        @if (Session::has('update'))
                        <div class="primary">{{ session('update') }}</div>
                  
                        @endif

                            <div class="table-responsive-lg">
                                <table class=" datatable table   table-striped table-bordered ">
                                    <thead>
                                        <form method="POST"  action="{{route('retail.customer.update')}}">
                                            {{csrf_field()}}
                                        <tr class="ligth">
                                          
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone no</th>
                                            <th>Gender</th>
                                            <th>Date Of Birth</th>
                                        
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                             <tr>
                                              
                                                <td>
                                                
                                                <input type='text'class='form-control' name='name' value="{{$customer->name}}"><input type="hidden" name="id" value="{{$customer->id}}"></td>
                                                <td><input type='email' class='form-control' name='email'  value="{{$customer->email}}" >
                                                <td><input type='number' class='form-control limitedTxt10' name='phone'  value="{{$customer->phone}}" >
                                                <td>
                                                <input type="radio" id="male" name="gender" value="Male"  {{($customer->gender=='Male')?'checked':''}}>
                                                <label for="male">Male</label>
                                                <input type="radio" id="female" name="gender" value="Female"  {{($customer->gender=='Female')?'checked':''}}>
                                                <label for="female">Female</label>

                                                 <td><input type='date' class='form-control' name='dob'  value="{{$customer->dob}}" >
                                                 <td class="text-center">
                                                    <!-- Add action buttons here -->
                                                   <td>
                                                    <div class="col-sm-12 text-center">
                                                        <button type="submit" class="btn btn-primary add-list btn-sm text-white">Update
                                                            Customer</button>
                                                    </div>
                                                   </td>
                                                </tr>
                                    </tbody>
                                   
                                    </form>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
                <!-- end col -->
            </div>
           
          
        </div> 
      
    </div>
</div>
   
<!-- Add this to your HTML file, after including flatpickr -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the current date
        var currentDate = new Date();

        // Calculate the minimum allowed date (18 years ago)
        var minDate = new Date(currentDate.getFullYear() - 14, currentDate.getMonth(), currentDate.getDate());

        // Format the minimum date as "YYYY-MM-DD" for the input field
        var minDateFormatted = formatDate(minDate);

        // Set the minimum date for the input field
        document.getElementsByName("dob")[0].setAttribute("max", minDateFormatted);

        // Function to format date as "YYYY-MM-DD"
        function formatDate(date) {
            var day = date.getDate();
            var month = date.getMonth() + 1; // Month is zero-based
            var year = date.getFullYear();

            // Pad single-digit day and month with a leading zero
            if (day < 10) day = "0" + day;
            if (month < 10) month = "0" + month;

            return year + "-" + month + "-" + day;
        }
    });
</script>

<script>
        $(document).ready(function() {
     
     charLimit10(10);
   
    });
    
    function charLimit10(limit){
     
     //$('.charLimit').text('(' + limit + '):');
     //$('.charLeft').text(limit);
     
     //still working on getting mouse cut and paste working
     $('.limitedTxt10').bind({
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
         //$('.charLeft').removeClass('charError').text(textLen);
         }
       },
       cut : function(){
         console.log("cut");
       }
     });
     
     $('.limitedTxt10').keyup(function() {
       var charLen = this.value.length;
       var textLen = $('.charLeft').text(limit - charLen);
       var textVal = limit - charLen;
       if (charLen >= limit) {
         this.value = this.value.substring(0, limit);
       }
       if (textVal <= limit && textVal > 1){
        // $('.charLeft').removeClass('charError').text(textLen);
       }else if(textVal <= 0){
        // $('.charLeft').text('limit reached').addClass('charError');
       } 
     });
    }

    
       </script>
    
@endslot
</x-layout>