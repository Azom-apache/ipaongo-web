@include('layouts.web.header')
<!-- Video Section -->
  
 

<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ __('Donate Now') }}</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Support our mission to create lasting change in communities worldwide</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 md:gap-4">
            <!-- Donation Form -->
            <div class="">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                  <div class="mb-6">
                      <h2 class="text-xl font-semibold text-gray-900 mb-2">Donation Details</h2>
                      <p class="text-gray-600">Please fill out the form below to submit your donation request</p>
                  </div>

                  @include('layouts.admin.errors')

                  <form method="post" action="{{route('donate.send')}}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <!-- Issue Date -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Issue Date</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-calendar text-gray-400"></i>
                            </div>
                            <input value="{{date('Y-m-d')}}" type="text" name="issuedate" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="name" placeholder="Select date" required>
                        </div>
                    </div>

                    <!-- Project Selection -->
                    <div>
                        <label for="project" class="block text-sm font-medium text-gray-700 mb-2">Project</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-folder text-gray-400"></i>
                            </div>
                            <select name="project" id="ParentCat" class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                <option value="">Select Project Type</option>
                                @php
                                $project = \App\Project::where('parent', 0)->orderby('title', 'ASC')->get();
                                @endphp
                                @foreach($project AS $item)
                                    <option @if(isset($_GET['id']) && $item->id==$_GET['id']) SELECTED @endif value="{{$item->id}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                    <!-- Project Categories -->
                    <div id="ResultShow">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Project Category</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                            <select name="subcat" id="SubCategory" class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                <option value="">Select Project Category</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Sub Project -->
                    <div id="SubSubCategory">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sub Project</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-code-branch text-gray-400"></i>
                            </div>
                            <select name="subsubcat" id="subsubCategory" class="block w-full pl-10 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none bg-white">
                                <option value="">Select Sub Project</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Budget -->
                    <div>
                        <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Amount (BDT)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-dollar-sign text-gray-400"></i>
                            </div>
                            <input value="{{old('budget')}}" type="number" min="10" step="0.01" name="budget" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="budget" placeholder="Amount charged in BDT" required>
                            <p class="mt-1 text-xs text-gray-500">This amount is charged in BDT through SSLCommerz. Minimum 10 BDT.</p>
                        </div>
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Quantity</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                            <input value="{{old('quantity')}}" type="text" name="quantity" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="quantity" placeholder="Enter quantity" required>
                        </div>
                    </div>

                    <!-- USD Amount -->
                    <div>
                        <label for="usd" class="block text-sm font-medium text-gray-700 mb-2">USD Amount</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-dollar-sign text-gray-400"></i>
                            </div>
                            <input value="{{old('usd')}}" type="text" name="usd" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="usd" placeholder="Amount in USD" required>
                        </div>
                    </div>
  
                    <!-- Donor Information Section -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Donor Information</h3>
                    </div>

                    <!-- Donor Name -->
                    <div>
                        <label for="donor" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-gray-400"></i>
                            </div>
                            <input value="{{old('donor')}}" type="text" name="donor" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="donor" placeholder="Enter your full name" required>
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                            </div>
                            <input value="{{old('address')}}" type="text" name="address" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="address" placeholder="Enter your address" required>
                        </div>
                    </div>

                    <!-- Country -->
                    <div>
                        <label for="country" class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-globe text-gray-400"></i>
                            </div>
                            <input value="{{old('country')}}" type="text" name="country" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="country" placeholder="Enter your country" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="mail" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-gray-400"></i>
                            </div>
                            <input value="{{old('mail')}}" type="email" name="mail" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="mail" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div>
                        <label for="contact" class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-phone text-gray-400"></i>
                            </div>
                            <input value="{{old('contact')}}" type="tel" name="contact" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" id="contact" placeholder="Enter your phone number" required>
                        </div>
                    </div>
  
                    <!-- File Upload -->
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Commitment Letter</label>
                        <div class="mt-1">
                            <input type="file" name="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" id="Pwd" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" required>
                            <p class="mt-1 text-xs text-gray-500">Upload PDF, DOC, DOCX, JPG, PNG files (Max 5MB)</p>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Pay with SSLCommerz
                        </button>
                        <p class="text-center text-sm text-gray-500 mt-3">
                            You will be redirected to the SSLCommerz payment page. The donation is saved after a successful payment.
                        </p>
                    </div>
                  </form>
                </div>
            </div>

            <!-- Banking Information -->
          <div class="">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Bank Transfer</h3>
                        <p class="text-sm text-gray-600">Make your donation via bank transfer</p>
                    </div>

                    <div class="space-y-4">
                        <!-- Bank Details -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Bank Information</h4>
                            <dl class="space-y-2 text-sm">
                                <div>
                                    <dt class="font-medium text-gray-700">Bank Name:</dt>
                                    <dd class="text-gray-900">United Commercial Bank Limited</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Branch:</dt>
                                    <dd class="text-gray-900">Uttara Branch</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Account Type:</dt>
                                    <dd class="text-gray-900">Current Account</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Account Details -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Account Details</h4>
                            <dl class="space-y-2 text-sm">
                                <div>
                                    <dt class="font-medium text-gray-700">Account Name:</dt>
                                    <dd class="text-gray-900 break-words">Illiteracy and Poverty Alleviation Assistance Organization (IPAO)</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Account Number:</dt>
                                    <dd class="font-mono font-semibold text-gray-900 py-1 rounded">0832112000001074</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Swift Code:</dt>
                                    <dd class="font-mono text-gray-900">UCBLBDDHUTR</dd>
                                </div>
                                <div>
                                    <dt class="font-medium text-gray-700">Routing Number:</dt>
                                    <dd class="font-mono text-gray-900">245264630</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Mobile Payment -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Mobile Payment</h4>
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                <div class="flex items-center mb-2">
                                    <span class="bg-green-600 text-white text-xs font-bold px-2 py-1 rounded mr-2">bKash</span>
                                    <span class="text-sm font-medium text-gray-700">Account Number</span>
                                </div>
                                <p class="font-mono font-semibold text-green-800">+88 01843140018</p>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h4 class="font-medium text-gray-900 mb-3">Need Help?</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-envelope w-4 h-4 mr-2"></i>
                                    <span>info@ipaongo.org</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-phone w-4 h-4 mr-2"></i>
                                    <span>Contact support</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Handle project selection change
    $('#ParentCat').change(function() {
        var projectId = $(this).val();
        if(projectId) {
            // Clear category and subcategory dropdowns
            $('#SubCategory').html('<option value="">Select Project Category</option>');
            $('#subsubCategory').html('<option value="">Select Sub Project</option>');

            // Make AJAX call to load categories
            $.ajax({
                url: '{{ route("subcategory.donate") }}',
                type: 'GET',
                data: { id: projectId },
                success: function(response) {
                    if(response.length > 0) {
                        var options = '<option value="">Select Project Category</option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.title + '</option>';
                        });
                        $('#SubCategory').html(options);
                    }
                }
            });
        } else {
            // Clear dropdowns if no project selected
            $('#SubCategory').html('<option value="">Select Project Category</option>');
            $('#subsubCategory').html('<option value="">Select Sub Project</option>');
        }
    });

    // Handle category selection change
    $('#SubCategory').change(function() {
        var categoryId = $(this).val();
        if(categoryId) {
            // Clear subcategory dropdown
            $('#subsubCategory').html('<option value="">Select Sub Project</option>');

            // Make AJAX call to load subcategories
            $.ajax({
                url: '{{ route("subcategory.donate") }}',
                type: 'GET',
                data: { subcat: categoryId },
                success: function(response) {
                    if(response.length > 0) {
                        var options = '<option value="">Select Sub Project</option>';
                        $.each(response, function(key, value) {
                            options += '<option value="' + value.id + '">' + value.title + '</option>';
                        });
                        $('#subsubCategory').html(options);
                    }
                }
            });
        } else {
            // Clear subcategory dropdown if no category selected
            $('#subsubCategory').html('<option value="">Select Sub Project</option>');
        }
    });
});
</script>

@include('layouts.web.footer')
