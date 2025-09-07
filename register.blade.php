<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('phone_number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Location Selection -->
        <div>
            <x-input-label for="Location" :value="__('Location')" />

            <!-- Country Dropdown -->
            <div class="mb-2">
                <select id="country" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <option value="">Select Country</option>
                    <option value="USA">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="UK">United Kingdom</option>
                    <option value="Germany">Germany</option>
                    <option value="France">France</option>
                    <option value="Japan">Japan</option>
                    <option value="Australia">Australia</option>
                </select>
            </div>

            <!-- Province/State Dropdown -->
            <div class="mb-2">
                <select id="province" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" disabled required>
                    <option value="">Select Province/State</option>
                </select>
            </div>

            <!-- City Dropdown -->
            <div class="mb-2">
                <select id="city" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" disabled required>
                    <option value="">Select City</option>
                </select>
            </div>

            <!-- Hidden input for combined location value -->
            <input type="hidden" id="location" name="Location" value="{{ old('Location') }}" />

            <!-- Selected location display -->
            <div id="selected-location" class="mt-3 p-3 bg-gray-50 rounded-md text-sm text-gray-600">
                No location selected
            </div>

            <x-input-error :messages="$errors->get('Location')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Avatar Upload -->
        <div class="mt-4">
            <x-input-label for="avatar" :value="__('Profile Picture')" />

            <!-- Image preview -->
            <div class="mt-2 mb-3" id="avatar-preview" style="display: none;">
                <img id="avatar-preview-image" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300" src="" alt="Avatar preview">
            </div>

            <!-- File input -->
            <div class="flex items-center space-x-4">
                <label for="avatar" class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    <i class="fas fa-upload mr-2"></i>{{ __('Choose Image') }}
                </label>

                <x-text-input
                    id="avatar"
                    class="hidden"
                    type="file"
                    name="avatar"
                    accept="image/jpeg,image/png,image/jpg,image/gif"
                    onchange="previewImage(this)"
                />
                <span id="file-name" class="text-sm text-gray-600">{{ __('No file chosen') }}</span>
            </div>

            <p class="text-sm text-gray-500 mt-1">{{ __('Maximum size: 2MB. Allowed formats: JPG, PNG, GIF') }}</p>
            <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- JavaScript for Location Selection and Image Preview -->
    <script>
        // Location data
        const locationData = {
            'USA': {
                'California': ['Los Angeles', 'San Francisco', 'San Diego'],
                'New York': ['New York City', 'Buffalo', 'Rochester'],
                'Texas': ['Houston', 'Dallas', 'Austin']
            },
            'Canada': {
                'Ontario': ['Toronto', 'Ottawa', 'Mississauga'],
                'Quebec': ['Montreal', 'Quebec City', 'Laval'],
                'British Columbia': ['Vancouver', 'Victoria', 'Surrey']
            },
            'UK': {
                'England': ['London', 'Manchester', 'Birmingham'],
                'Scotland': ['Edinburgh', 'Glasgow', 'Aberdeen'],
                'Wales': ['Cardiff', 'Swansea', 'Newport']
            },
            'Germany': {
                'Bavaria': ['Munich', 'Nuremberg', 'Augsburg'],
                'Berlin': ['Berlin'],
                'North Rhine-Westphalia': ['Cologne', 'Düsseldorf', 'Dortmund']
            },
            'France': {
                'Île-de-France': ['Paris', 'Versailles', 'Boulogne-Billancourt'],
                "Provence-Alpes-Côte d'Azur": ['Marseille', 'Nice', 'Toulon'],
                'Auvergne-Rhône-Alpes': ['Lyon', 'Grenoble', 'Saint-Étienne']
            },
            'Japan': {
                'Tokyo': ['Tokyo', 'Shibuya', 'Shinjuku'],
                'Osaka': ['Osaka', 'Sakai', 'Higashiosaka'],
                'Kyoto': ['Kyoto', 'Uji', 'Maizuru']
            },
            'Australia': {
                'New South Wales': ['Sydney', 'Newcastle', 'Wollongong'],
                'Victoria': ['Melbourne', 'Geelong', 'Ballarat'],
                'Queensland': ['Brisbane', 'Gold Coast', 'Cairns']
            }
        };

        // DOM elements
        const countrySelect = document.getElementById('country');
        const provinceSelect = document.getElementById('province');
        const citySelect = document.getElementById('city');
        const locationInput = document.getElementById('location');
        const selectedLocationDiv = document.getElementById('selected-location');

        // Country change event
        countrySelect.addEventListener('change', function() {
            const country = this.value;

            // Reset province and city
            provinceSelect.innerHTML = '<option value="">Select Province/State</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';
            provinceSelect.disabled = !country;
            citySelect.disabled = true;

            if (country) {
                // Add provinces for selected country
                for (const province in locationData[country]) {
                    const option = document.createElement('option');
                    option.value = province;
                    option.textContent = province;
                    provinceSelect.appendChild(option);
                }
                provinceSelect.disabled = false;
            }

            updateLocationString();
        });

        // Province change event
        provinceSelect.addEventListener('change', function() {
            const country = countrySelect.value;
            const province = this.value;

            // Reset city
            citySelect.innerHTML = '<option value="">Select City</option>';
            citySelect.disabled = !province;

            if (country && province) {
                // Add cities for selected province
                locationData[country][province].forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            }

            updateLocationString();
        });

        // City change event
        citySelect.addEventListener('change', function() {
            updateLocationString();
        });

        // Update location string and display
        function updateLocationString() {
            const country = countrySelect.value;
            const province = provinceSelect.value;
            const city = citySelect.value;

            let locationString = '';

            if (city) locationString = `${country}-${province}-${city}`;
            else if (province) locationString = `${country}-${province}`;
            else if (country) locationString = country;

            // Update hidden input
            locationInput.value = locationString;

            // Update display
            if (locationString) {
                selectedLocationDiv.innerHTML = `
                    <p class="text-green-600 font-medium">Selected Location:</p>
                    <div class="flex items-center mt-1">
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">${locationString}</span>
                        <button type="button" onclick="clearLocation()" class="ml-2 text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            } else {
                selectedLocationDiv.innerHTML = '<p class="text-gray-500">No location selected</p>';
            }
        }

        // Clear location selection
        function clearLocation() {
            countrySelect.value = '';
            provinceSelect.innerHTML = '<option value="">Select Province/State</option>';
            citySelect.innerHTML = '<option value="">Select City</option>';
            provinceSelect.disabled = true;
            citySelect.disabled = true;
            locationInput.value = '';
            selectedLocationDiv.innerHTML = '<p class="text-gray-500">No location selected</p>';
        }

        // Image preview function
        function previewImage(input) {
            const preview = document.getElementById('avatar-preview');
            const previewImage = document.getElementById('avatar-preview-image');
            const fileName = document.getElementById('file-name');

            if (input.files && input.files[0]) {
                const file = input.files[0];

                // Check file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('{{ __("File size must be less than 2MB") }}');
                    input.value = '';
                    return;
                }

                // Check file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('{{ __("Please select a valid image file (JPG, PNG, GIF)") }}');
                    input.value = '';
                    return;
                }

                // Show file name
                fileName.textContent = file.name;

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);

            } else {
                preview.style.display = 'none';
                fileName.textContent = '{{ __("No file chosen") }}';
            }
        }

        // Initialize form with old input if available
        document.addEventListener('DOMContentLoaded', function() {
            const oldLocation = "{{ old('Location') }}";
            if (oldLocation) {
                const parts = oldLocation.split('-');
                if (parts.length >= 3) {
                    // Full location (country-province-city)
                    const country = parts[0];
                    const province = parts[1];
                    const city = parts[2];

                    if (locationData[country] && locationData[country][province]) {
                        countrySelect.value = country;

                        // Add provinces for selected country
                        for (const prov in locationData[country]) {
                            const option = document.createElement('option');
                            option.value = prov;
                            option.textContent = prov;
                            provinceSelect.appendChild(option);
                        }
                        provinceSelect.disabled = false;
                        provinceSelect.value = province;

                        // Add cities for selected province
                        locationData[country][province].forEach(ct => {
                            const option = document.createElement('option');
                            option.value = ct;
                            option.textContent = ct;
                            citySelect.appendChild(option);
                        });
                        citySelect.disabled = false;
                        citySelect.value = city;
                    }
                } else if (parts.length === 2) {
                    // Only country and province
                    const country = parts[0];
                    const province = parts[1];

                    if (locationData[country] && locationData[country][province]) {
                        countrySelect.value = country;

                        // Add provinces for selected country
                        for (const prov in locationData[country]) {
                            const option = document.createElement('option');
                            option.value = prov;
                            option.textContent = prov;
                            provinceSelect.appendChild(option);
                        }
                        provinceSelect.disabled = false;
                        provinceSelect.value = province;
                    }
                } else if (parts.length === 1) {
                    // Only country
                    const country = parts[0];
                    if (locationData[country]) {
                        countrySelect.value = country;

                        // Add provinces for selected country
                        for (const province in locationData[country]) {
                            const option = document.createElement('option');
                            option.value = province;
                            option.textContent = province;
                            provinceSelect.appendChild(option);
                        }
                        provinceSelect.disabled = false;
                    }
                }

                updateLocationString();
            }
        });
    </script>
</x-guest-layout>
