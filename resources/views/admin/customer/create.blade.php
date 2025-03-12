<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <x-slot name="cardTitle">
       <p class="subhead">Add Customer</p>
    </x-slot>

    <div class="row d-flex" style="justify-content: space-between;">
          <div class="col-6"style="padding-right: 20px;">
           <div class="row borderset">
            <div class="col-md-12">
            <label class="foncolor" for="company_name"> Company </label>
                        <input type="text" name="first_name" class="form-control inp" placeholder="Enter Company Name">
                           
            </div>
            <div class="col-md-12">
            <label class="foncolor" for="first_name">First Name <i class="text-danger">*</i></label>
            <input type="text" name="first_name" class="form-control inp" placeholder="Enter Last Name">
            </div>
            <div class="col-md-12">
            <label class="foncolor" for="contact_no1">Mobile No. <i class="text-danger">*</i></label>
            <input type="text" id="mobile_code" class="form-control inp" placeholder="Enter Mobile Number" name="name">
            </div>
            <div class="col-md-12">
            <label class="foncolor" for="contact_no1">Alternate Mobile No.</label>
            <input type="text" id="mobile" class="form-control inp" placeholder="Enter Mobile Number " name="name">
            </div>
            <div class="col-md-12">
            <label class="foncolor" for="Address.1">Address 1 <i class="text-danger">*</i></label>
            <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 1">
            </div>
              <div class="col-md-12">
              <label class="foncolor" for="Address.2">Address 2 </label>
              <input type="text" name="Address.1" class="form-control inp" placeholder="Enter Address 2">
              </div>
            <div class="col-md-6">
            <label class="foncolor" for="country">Country <i class="text-danger">*</i></label>
            <select class="js-example-basic-single select2">
												<option selected="selected">Select Country</option>
												<option>white</option>
												<option>purple</option>
											</select>
            </div>
            <div class="col-md-6">
              <label class="foncolor" for="Apartment">Apartment </label>
              <input type="text" name="Apartment" class="form-control inp" placeholder="Enter Apartment">
              </div>
            <div class="col-md-4">
            <label class="foncolor" for="State">State <i class="text-danger">*</i></label>
            <select class="js-example-basic-single select2">
												<option selected="selected">Select State</option>
												<option>white</option>
												<option>purple</option>
											</select>
            
            </div>
            <div class="col-md-4">
                <label class="foncolor" for="city">City <i class="text-danger">*</i></label>
            <select class="js-example-basic-single select2">
												<option selected="selected">Select City</option>
												<option>white</option>
												<option>purple</option>
											</select>
            </div>
            <div class="col-md-4">
                <label class="foncolor" for="Zip_code">Zip code <i class="text-danger">*</i></label>
                        <input type="text" name="Zip_code" class="form-control inp" placeholder="Enter Zip">
            </div>
           
            <div class="col-md-12">
              <label class="foncolor" for="username">Username <i class="text-danger">*</i></label>
              <input type="text" name="Username" class="form-control inp" placeholder="Enter User Name">
              </div>

              <div class="col-md-12">
              <label class="foncolor" for="password">Password<i class="text-danger">*</i></label>
              <input type="text" name="password" class="form-control inp" placeholder="Enter Password"><i class="fe fe-eye" data-bs-toggle="tooltip" title="fe fe-eye"></i></input>
              
            </div>

              <div class="col-md-12">
              <label class="foncolor" for="confirm_password">Confirm New Password<i class="text-danger">*</i></label>
              <input type="text" name="password" class="form-control inp" placeholder="Enter Confirm New Password"><i class="fe fe-eye" data-bs-toggle="tooltip" title="fe fe-eye"></i></input>
              </div>

              <div class="col-md-6">
              <label class="foncolor" for="latitude">Latitude <i class="text-danger">*</i></label>
              <input type="text" name="latitude" class="form-control inp" placeholder="0">
              </div>
              <div class="col-md-6">
              <label class="foncolor" for="longitude">Longitude <i class="text-danger">*</i></label>
              <input type="text" name="longitude" class="form-control inp" placeholder="0">
              </div>










             <!-- first left side form clouser div is next  -->
           </div>
          </div>
          <div class="col-6" style="padding-left: 20px;">
          <div class="row borderset">
          <div class="col-md-12">
            <label class="foncolor" for="website">Website</label>
                        <input type="text" name="Webiste_id" class="form-control inp" placeholder="Enter Website ID">
                           
            </div>
            <div class="col-md-12">
            <label class="foncolor" for="email">Email</label>
            <input type="text" name="email" class="form-control inp" placeholder="Enter Email ID">
            </div>

            <div class="col-md-12">
            <label class="foncolor" for="warehouse"> Warehouse </label>
            <select class="js-example-basic-single select2">
												<option selected="selected">Select Warehouse</option>
												<option>white</option>
												<option>purple</option>
											</select>
            </div>

            <div class="col-md-12">
    <label>Signature Date </label>
    <div class="daterangepicker-wrap cal-icon cal-icon-info" >
     <input type="text" class="btn-filters  form-cs inp " name="datetimes" placeholder="mm-dd-yy"  />
    </div>
</div>
<div class="col-md-12">
            <label class="foncolor" for="Year_to_Date">Year to Date</label>
            <input type="text" id="Year to Date" class="form-control inp" placeholder="0" >
            </div>
 
            <div class="col-md-12">
            <label class="foncolor" for="License_ID">License ID</label>
            <input type="text" id="License_ID" class="form-control inp" placeholder="Enter License ID" >
            </div>

            <div class="col-md-12">
    <label>License Expiry Date </label>
    <div class="daterangepicker-wrap cal-icon cal-icon-info" >
     <input type="text" class="btn-filters  form-cs inp " name="datetimes" placeholder="mm-dd-yy"  />
    </div>
</div>
<div class="col-md-12">
            <label class="foncolor" for="warehouse"> Language </label>
            <select class="js-example-basic-single select2">
												<option selected="selected">India-English</option>
												<option>white</option>
												<option>purple</option>
											</select>
            </div>


            <div class="col-md-12">
            <label class="foncolor" for="Write_Comment">Write Comment</label>
            <input type="text" id="Write_Comment" class="form-control inp commenth" placeholder="Enter Write Comment" >
            </div>

            <div class="col-md-12">
            <label class="foncolor" for="Read_Comment">Read Comment</label>
            <input type="text" id="Read_Comment" class="form-control inp commenth" placeholder="Enter Read Comment" >
            </div>
 </div>
           <!-- second form right side closer div is next -->
     </div>

     <div class="row d-flex">
      
        <div class="col-md-4 dheight">
        <label class="foncolor" for="Read_Comment">Signature</label>
        </div>
        <div class="col-md-4">
        <label class="foncolor" for="Read_Comment">Contract Signature</label>
        </div>
        <div class="col-md-4">
        <label class="foncolor" for="Read_Comment">License Picture</label>
        </div>


     
     </div>
        </div>
    </div>

</x-app-layout>