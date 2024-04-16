<div class="modal fade bs-example-modal-xl" data-url="" id="customerAdd" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form id="form_data_customer" action="{{ route('pos.add_customer') }}" method="post">
        @csrf
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-title">Add Customer</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12 d-flex align-items-end">
                            <div class="form-group mb-0" style="width: 79%;">
                                <label for="type" class="required">Phone No (10 Digit)</label>
                                <input type="number" name="phone" required id="phone"
                                    class="form-control limitedTxt10" placeholder="Eg:9830000123" id="description">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="f-group">

                                <button type="button" id="chk_btn" class="btn btn-success" style="border-radius: 0 0.25rem 0.25rem 0;"
                                    onclick='checkcustomer()'><i class="uil uil-check me-2"></i>Check
                                    Customer</button>
                            </div>
                        </div>

                       

                    </div>
                    <div class="row" id="cus_details">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="required">First Name</label>
                                <input type="text" required name="first_name" id="first_name" class="form-control"
                                    placeholder="First Name">
                                @error('first_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="required">Last Name</label>
                                <input type="text" name="last_name" required id="last_name" class="form-control"
                                    placeholder="Last Name">
                                @error('last_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="optional">Email</label>
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="email">
                                {{-- @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="required">Gender</label><br>
                                <input type="radio" id="male" name="gender" value="Male"
                                    {{ old('gender') == 'Male' ? 'checked' : '' }}>
                                <label for="male">Male</label>
                                <input type="radio" id="female" name="gender" value="Female"
                                    {{ old('gender') == 'Female' ? 'checked' : '' }}>
                                <label for="female">Female</label><br>
                                <p id="radioerror"></p>
                                @error('gender')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="type" class="">Date of Birth</label>
                                <input type="date" name="dob" id="dob" class="form-control"
                                    placeholder="date of birth"
                                    value="{{ old('dob') != '' ? old('dob') : date('Y') - 14 . '-01-01' }}">
                                @error('dob')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="gst_no">Gst No</label>
                                <input type="text" name="gst_no" class="form-control"
                                    placeholder="Enter your gst number">
                                @error('gst_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="gst_no">Company Name</label>
                                <input type="text" name="company_name" id="company_name" class="form-control"
                                    placeholder="Enter your Company name">
                                @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="address" class="">Address</label>
                                <input type="text" name="address" id="address" class="form-control"
                                    placeholder="Enter your Address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group" class="">
                                <label for="city" class="">City</label>
                                <input type="text"  name="city" id="city" class="form-control"
                                    placeholder="Enter your City name">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="city" class="required">District</label>
                                <input type="text" required name="district_id" id="district_id"
                                    class="form-control" placeholder="Enter your District name">
                                @error('district_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="state" class="required">State</label>
                                <select id="state" required type="text" class="form-control selectpicker"
                                    data-live-search="true" name="state">
                                    <?php 
                                    $states = \App\Models\District::where('deleted_at', null)->where('country', 'India')->select('state')->distinct()->get();
                                foreach($states as $state)
                                {
                                    ?>
                                    <option value="{{ $state->state }}" <?php if (old('state')) {
                                        if (old('state') === $state->state) {
                                            echo 'selected';
                                        }
                                    } else {
                                        if ($state->state == 'West Bengal') {
                                            echo 'selected';
                                        }
                                    } ?>>{{ $state->state }}
                                    </option>
                                    <?php 
                                }
                                ?>
                                </select>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="pincode" class="required">Pincode</label>
                                <input type="number" required name="pincode" id="pincode"
                                    class="form-control limitedTxt" placeholder="Enter your Pincode">
                                @error('pincode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="country" class="required">Country</label>
                                <select id="country" required type="text" class="form-control selectpicker"
                                    data-live-search="true" name="country">

                                    <option value="">Select a country...</option>
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="Brunei">Brunei</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cabo Verde">Cabo Verde</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Eswatini">Eswatini</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option selected value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran">Iran</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Laos">Laos</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libya">Libya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia">Micronesia</option>
                                    <option value="Moldova">Moldova</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="North Korea">North Korea</option>
                                    <option value="North Macedonia">North Macedonia</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestine">Palestine</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russia">Russia</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines
                                    </option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="South Sudan">South Sudan</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syria">Syria</option>
                                    <option value="Taiwan">Taiwan</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania">Tanzania</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-Leste">Timor-Leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Vatican City">Vatican City</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Vietnam">Vietnam</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                                @error('country')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer" id="action_btn">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="ajaxCallpos('form_data_customer','{{ route('pos.index') }}')"
                        class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        charLimit(6);
        charLimit10(10);
        charLimit10b(10);
        $('#cus_details').hide();
        $('#action_btn').hide();
    });

    function charLimit(limit) {

        //$('.charLimit').text('(' + limit + '):');
        //$('.charLeft').text(limit);

        //still working on getting mouse cut and paste working
        $('.limitedTxt').bind({
            copy: function() {
                console.log("copy");
            },
            paste: function() {
                console.log("paste");
                var charLen = this.value.length;
                var textVal = limit - charLen;
                console.log(charLen);
                console.log(textVal);
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    //$('.charLeft').removeClass('charError').text(textLen);
                }
            },
            cut: function() {
                console.log("cut");
            }
        });

        $('.limitedTxt').keyup(function() {
            var charLen = this.value.length;
            var textLen = $('.charLeft').text(limit - charLen);
            var textVal = limit - charLen;
            if (charLen >= limit) {
                this.value = this.value.substring(0, limit);
            }
            if (textVal <= limit && textVal > 1) {
                // $('.charLeft').removeClass('charError').text(textLen);
            } else if (textVal <= 0) {
                // $('.charLeft').text('limit reached').addClass('charError');
            }
        });
    }

    function charLimit10(limit) {

        //$('.charLimit').text('(' + limit + '):');
        //$('.charLeft').text(limit);

        //still working on getting mouse cut and paste working
        $('.limitedTxt10').bind({
            copy: function() {
                console.log("copy");
            },
            paste: function() {
                console.log("paste");
                var charLen = this.value.length;
                var textVal = limit - charLen;
                console.log(charLen);
                console.log(textVal);
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    //$('.charLeft').removeClass('charError').text(textLen);
                }
            },
            cut: function() {
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
            if (textVal <= limit && textVal > 1) {
                // $('.charLeft').removeClass('charError').text(textLen);
            } else if (textVal <= 0) {
                // $('.charLeft').text('limit reached').addClass('charError');
            }
        });
    }

    function charLimit10b(limit) {

        //$('.charLimit').text('(' + limit + '):');
        //$('.charLeft').text(limit);

        //still working on getting mouse cut and paste working
        $('.limitedTxt10b').bind({
            copy: function() {
                console.log("copy");
            },
            paste: function() {
                console.log("paste");
                var charLen = this.value.length;
                var textVal = limit - charLen;
                console.log(charLen);
                console.log(textVal);
                if (charLen >= limit) {
                    this.value = this.value.substring(0, limit);
                }
                if (textVal <= limit && textVal > 1) {
                    //$('.charLeft').removeClass('charError').text(textLen);
                }
            },
            cut: function() {
                console.log("cut");
            }
        });

        $('.limitedTxt10b').keyup(function() {
            var charLen = this.value.length;
            var textLen = $('.charLeft').text(limit - charLen);
            var textVal = limit - charLen;
            if (charLen >= limit) {
                this.value = this.value.substring(0, limit);
            }
            if (textVal <= limit && textVal > 1) {
                // $('.charLeft').removeClass('charError').text(textLen);
            } else if (textVal <= 0) {
                // $('.charLeft').text('limit reached').addClass('charError');
            }
        });
    }

    function checkcustomer() {
        var phone = document.getElementById('phone').value;
        $.ajax({
            type: "GET",
            url: "{{ route('customer.phone', ['phone' => ':phone']) }}".replace(':phone',
                phone),
            success: function(response) {

                if (response == 'null') {
                    $('#cus_details').show();
                    $('#action_btn').show();
                    $('#chk_btn').hide();
                    $('#phone').prop('readonly', true);
                    $('#phone').val(phone);
                } else
                if (response == 'true') {
                    alert('Customer is already added to your store');
                } else {
                    $('#cus_details').show();
                    $('#action_btn').show();
                    $('#chk_btn').hide();
                    //console.log(JSON.stringify(response));
                    // console.log(response.address)
                    $('#phone, #first_name, #last_name, #email, #alternative_phone, #dob, #address, #district_id, #city, #state, #pincode, #country, #gst_no')
                        .prop('readonly', true);
                    $('#phone').val(phone);
                    $('#first_name').val(response.first_name);
                    $('#last_name').val(response.last_name);
                    $('#email').val(response.email);
                    $('#alternative_phone').val(response.alternative_phone);
                    $('#dob').val(response.dob);
                    $('input[name="gender"]').prop('checked', false); // Uncheck all radio buttons
                    $('input[name="gender"][value="' + response.gender + '"]').prop('checked', true);
                    $('#address').val(response.address[0].address);
                    $('#district_id').val(response.address[0].district);
                    $('#city').val(response.address[0].city);
                    $('#state').val(response.address[0].state);
                    $('#pincode').val(response.address[0].pincode);
                    $('#country').val(response.address[0].country);
                    $('#gst_no').val(response.gst_no);
                }

            }
        });
    }

</script>
