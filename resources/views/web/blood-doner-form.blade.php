
    @include('layouts.web.header')
    <!--End Main Header -->

	<!-- Video Section -->
	<section class="video-section py-12">
		<div class="max-w-6xl mx-auto px-4" style="max-width: 70%">
			<div class="sec-title mb-8">
				<h2 class="text-center text-3xl font-bold text-gray-900">{{__('Blood Doner Form')}}</h2>
			</div>
			<div class="flex flex-wrap">
				<!-- Content Column -->

				<div class="w-full">
					<div class="inner-column">
						<div class="sec-title">
							<form class="bg-white rounded-lg shadow-lg border px-4" method="post" action="{{route('blood.donate.store')}}" enctype="multipart/form-data">
								@include('layouts.admin.errors')
								@csrf
								
								<div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 -mx-4 p-6">
									<div class="col-span-1 lg:col-span-1">

										<div class="mb-4">
											<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Member Type :</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-user text-gray-400" aria-hidden="true"></i>
												</div>
												<select name="membertype" id="Member" required="required" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500">
													<option value=" "> --Member Type-- </option>
													<option value="donor"> Blood Donor </option>
												</select>
											</div>
										</div>

										<div class="mb-4">
										<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name:</label>
										<div class="relative">
											<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
											<i class="fa fa-user text-gray-400" aria-hidden="true"></i>
											</div>
											<input value="{{old('name')}}" type="text" name="name" class="name block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500" id="name" placeholder="Full Name*" required="required">
										</div>
										</div>

										<div class="mb-4">
										<label for="mobile" class="block text-sm font-medium text-gray-700 mb-2">Mobile:</label>
										<div class="relative">
											<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
											<i class="fa fa-mobile text-gray-400" aria-hidden="true"></i>
											</div>
											<input value="{{old('mobile')}}" type="text" name="mobile" class="name block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500" id="mobile" placeholder="Mobile*" required="required">
										</div>
										</div>

										<div class="mb-4">
											<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Divisions :</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-map-marker text-gray-400" aria-hidden="true"></i>
												</div>
												<select name="division" id="Divisions" required="required" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500">
													<option value=" "> --Divisions-- </option>
													<option value="1"> Chattagram </option>
													<option value="2"> Rajshahi </option>
													<option value="3"> Khulna </option>
													<option value="4"> Barisal </option>
													<option value="5"> Sylhet </option>
													<option value="6"> Dhaka </option>
													<option value="7"> Rangpur </option>
													<option value="8"> Mymensingh </option>

												</select>
											</div>
										</div>

										<div class="mb-4" id="ResultShow">
											<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Districts :</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-building text-gray-400" aria-hidden="true"></i>
												</div>
												<select id="District" name="district" required="required" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500">
													<option value=" "> --Districts-- </option>
												</select>
											</div>
										</div>

										<div class="mb-4" id="ResultShow">
											<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Upazilla :</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-home text-gray-400" aria-hidden="true"></i>
												</div>
												<select id="UpaZilla" name="upazila" required="required" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500">
													<option value=" "> --Upazilla-- </option>
												</select>
											</div>
										</div>
										<div class="mb-4">
											<label for="file" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
											<div class="relative">
												<div class="absolute top-3 left-3 pointer-events-none">
													<i class="fa fa-map text-gray-400" aria-hidden="true"></i>
												</div>
												<textarea name="address" rows="3" cols="4" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500 resize-vertical" placeholder="Address"></textarea>
											</div>
										</div>
										<input type="hidden" name="edu_qual" value="N/A">
									</div>
									<div class="col-span-1 lg:col-span-1">

										<div class="mb-4">
											<label for="blood_group" class="block text-sm font-medium text-gray-700 mb-2">Blood group:</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-tint text-red-500" aria-hidden="true"></i>
												</div>
												<select name="blood_group" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500">
													<option value="position">--Blood group--</option>
													<option value="A+">A+</option>
													<option value="A-">A-</option>
													<option value="B+">B+</option>
													<option value="B-">B-</option>
													<option value="O+">O+</option>
													<option value="O-">O-</option>
													<option value="AB+">AB+</option>
													<option value="AB-">AB-</option>
												</select>
											</div>
										</div>

										<div class="mb-4">
											<label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email:</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-envelope text-gray-400" aria-hidden="true"></i>
												</div>
												<input value="{{old('email')}}" type="email" name="email" class="name block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500" id="email" placeholder="Email*">
											</div>
										</div>

										<div class="mb-4">
											<label for="name" class="block text-sm font-medium text-gray-700 mb-2">Gender:</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-venus-mars text-gray-400" aria-hidden="true"></i>
												</div>
												<select name="gender" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500">
													<option value="">Gender</option>
													<option value="Male">Male</option>
													<option value="Female">Female</option>
													<option value="Others">Others</option>
												</select>
											</div>
										</div>

										<div class="mb-4">
											<label for="dob" class="block text-sm font-medium text-gray-700 mb-2">Birth Date:</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-calendar text-gray-400" aria-hidden="true"></i>
												</div>
												<input value="{{old('dob')}}" name="dob" id="datepicker" placeholder="DD-MM-YYYY" class="textbox-n block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500" type="text" required="">
											</div>
										</div>

										<div class="mb-4">
											<label for="file" class="block text-sm font-medium text-gray-700 mb-2">File:</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-file text-gray-400" aria-hidden="true"></i>
												</div>
												<input type="file" name="image" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white focus:outline-none focus:ring-red-500 focus:border-red-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" id="Pwd" placeholder="file" />
											</div>
										</div>

										<div class="mb-6">
											<label for="file" class="block text-sm font-medium text-gray-700 mb-2">Password:</label>
											<div class="relative">
												<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
													<i class="fa fa-key text-gray-400" aria-hidden="true"></i>
												</div>
												<input type="password" name="password" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 placeholder-gray-500 focus:outline-none focus:ring-red-500 focus:border-red-500" id="Pwd"/>
											</div>
										</div>
										
									</div>
								</div>
								<div class="flex flex-col items-center justify-between pb-6">
									<div class="mb-4">
									<button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Registration</button>
									</div>
									<div class="text-center">
										<a href="{{route('studentLogin')}}" class="text-red-600 hover:text-red-800 hover:underline transition-colors duration-200">Already have an account?</a>
									</div>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- End Video Section -->

<script>
$(document).ready(function() {
    // Handle division selection change
    $('#Divisions').change(function() {
        var divisionId = $(this).val();
        if(divisionId) {
            // Clear district and upazila dropdowns
            $('#District').html('<option value=" "> --Districts-- </option>');
            $('#UpaZilla').html('<option value=" "> --Upazilla-- </option>');

            // Make AJAX call to load districts
            $.ajax({
                url: '{{ route("districts.list") }}',
                type: 'GET',
                data: { id: divisionId },
                success: function(response) {
                    if(response.length > 0) {
                        var options = '<option value=" "> --Districts-- </option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $('#District').html(options);
                    }
                }
            });
        } else {
            // Clear dropdowns if no division selected
            $('#District').html('<option value=" "> --Districts-- </option>');
            $('#UpaZilla').html('<option value=" "> --Upazilla-- </option>');
        }
    });

    // Handle district selection change
    $('#District').change(function() {
        var districtId = $(this).val();
        if(districtId) {
            // Clear upazila dropdown
            $('#UpaZilla').html('<option value=" "> --Upazilla-- </option>');

            // Make AJAX call to load upazilas
            $.ajax({
                url: '{{ route("districts.list") }}',
                type: 'GET',
                data: { district: districtId },
                success: function(response) {
                    if(response.length > 0) {
                        var options = '<option value=" "> --Upazilla-- </option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.name + '</option>';
                        });
                        $('#UpaZilla').html(options);
                    }
                }
            });
        } else {
            // Clear upazila dropdown if no district selected
            $('#UpaZilla').html('<option value=" "> --Upazilla-- </option>');
        }
    });
});
</script>

	<!-- FOOTER SECTION -->
	@include('layouts.web.footer')
