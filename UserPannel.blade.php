<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
            transition: width 0.3s;
            z-index: 1000;
        }

        .sidebar a {
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            display: block;
            font-size: 18px;
            border-bottom: 1px solid #444;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #007bff;
            color: white;
        }

        .sidebar .active {
            background-color: #007bff;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .logout-btn {
            margin-top: 20px;
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: center;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
        }

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        }

        .car-table th,
        .car-table td {
            text-align: center;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .car-table th {
            background-color: #007bff;
            color: white;
        }

        .car-table tr:hover {
            background-color: #f1f1f1;
        }

        .action-btn {
            margin: 5px;
            padding: 5px 15px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #ff4b2b;
            color: white;
        }

        .delete-btn:hover {
            background-color: #ff416c;
        }

        .details-btn {
            background-color: #007bff;
            color: white;
        }

        .details-btn:hover {
            background-color: #0056b3;
        }

        .sort-search-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
        }

        .select-input,
        .search-input {
            margin-right: 10px;
        }

        /* Profile Section Styles */
        .profile-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            font-weight: bold;
            margin-right: 20px;
        }

        .profile-info h2 {
            margin: 0;
            color: #343a40;
        }

        .profile-info p {
            margin: 5px 0;
            color: #6c757d;
        }

        .profile-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .profile-menu-item {
            border-bottom: 1px solid #e9ecef;
        }

        .profile-menu-item:last-child {
            border-bottom: none;
        }

        .profile-menu-link {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            color: #495057;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .profile-menu-link:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .profile-menu-link i {
            color: #6c757d;
        }

        .danger-zone {
            border-top: 2px solid #ff4b2b;
            padding-top: 20px;
            margin-top: 30px;
        }

        .danger-zone h3 {
            color: #ff4b2b;
            margin-bottom: 15px;
        }

        .danger-btn {
            background-color: #ff4b2b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .danger-btn:hover {
            background-color: #ff416c;
        }

        .profile-subsection {
            margin-top: 20px;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-subsection h3 {
            margin-top: 0;
            color: #343a40;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .form-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            outline: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            position: relative;
            margin: 10% auto;
            width: 400px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .modal-body {
            padding: 20px;
        }

        .modal-footer {
            padding: 15px 20px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .close:hover {
            color: #ccc;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-avatar {
                margin-right: 0;
                margin-bottom: 15px;
            }

            .sort-search-container {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        img {
            width:20px;
            height:20px;
        }

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            border-radius: 5px;
            color: white;
            z-index: 1100;
            display: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .notification.success {
            background-color: #28a745;
        }

        .notification.error {
            background-color: #dc3545;
        }

        /* Car Details Modal Styles */
        .car-details-modal .modal-content {
            width: 600px;
            max-width: 90%;
        }

        .car-details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }

        .car-detail-item {
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .car-detail-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .car-detail-value {
            color: #212529;
        }

        .car-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            overflow: hidden;
        }

        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .password-error {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('home') }}">Return Home</a>
        <h3 class="text-center text-white">User Panel</h3>
        <a href="#cars" class="nav-link">Cars</a>
        <a href="#profile" class="nav-link">Profile</a>
        <a href="#transactions" class="nav-link">Transactions</a>
        <a href="#favorites" class="nav-link">Favorites</a>
        <a href="#sellbuy" class="nav-link">Sell & Buys</a>
           <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">🚪 Logout</button>
            </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        {{-- <form  method="GET" action="{{ route("fix-em") }}"> <button>fix me</button></form> --}}
        <!-- Header -->
        <div class="header">
            <span>User Dashboard</span>
        </div>

        <!-- Notification -->
        <div id="notification" class="notification"></div>

        <!-- Content Sections -->

        <div id="cars" class="content-section active">
            <h2>{{ $user->UserName }}'s Cars</h2>

            @if(!empty($totalCarCount))
                <p class="text-muted">Total Cars: {{ $totalCarCount }}</p>
            @endif

            <button class="btn btn-primary mb-3" onclick="showAddCarModal()"> + Add new Car</button>

            <div class="sort-search-container">
                <label for="sortBy" class="form-label">Sort By:</label>
                <form method="GET" action="{{ route('profile-go', $user->UserID) }}" class="d-inline">
                    <select name="sort" class="form-select select-input" onchange="this.form.submit()">
                        <option value="none" {{ $sortBy == "none" ? 'selected':''}}>None</option>
                        <option value="price_asc" {{ $sortBy == 'price_asc' ? 'selected' : ''}}>Price: Low to High</option>
                        <option value="price_desc" {{ $sortBy =='price_desc' ? 'selected' :'' }}>Price: High to Low</option>
                        <option value="name_asc" {{ $sortBy =='name_asc' ? 'selected':'' }}>Name: A to Z</option>
                        <option value="name_desc" {{ $sortBy =='name_desc' ? 'selected' : '' }}>Name: Z to A</option>
                    </select>
                </form>

                <label for="search" class="form-label">Search:</label>
                <form method="POST" action="{{ route('cars.search') }}">
                    @csrf
                    <input type="text" name="search" class="form-control search-input"
                           placeholder="Search cars..." value="{{ $searchTerm ?? '' }}">
                    <input type="hidden" name="sort" value="{{ $sortBy }}">
                    <button name="Gosearch" type="submit" style="display: none;">Search</button>
                </form>

                <form method='POST' action="{{ route('delete.all') }}">
                    @csrf
                    <button  type='submit' class="btn btn-danger action-btn"
                            onclick="return confirm('Are you sure you want to delete ALL cars? This cannot be undone!')">
                        Delete All Cars
                    </button>
                </form>
            </div>

            <table class="table car-table">
                <thead>
                    <tr>
                        <th>Car Name</th>
                        <th>Price</th>
                        <th>Engine</th>
                        <th>Actions</th>
                    </tr>
                </thead>


                <tbody>
                    @forelse($user->cars as $car)
                    <tr>
                        <td>{{ $car->name }}</td>
                        <td>${{ number_format($car->price) }}</td>
                        <td>{{ $car->engine }}</td>
                        <td>
                            <button class="btn details-btn" onclick="showCarDetails({{ $car->id }})">Show Details</button>
                     <form action="{{ route('delete.car') }}"  method="POST" style="display: inline-block;">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->car_id }}">
                                <button type="submit" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this car?')">Delete Car</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">
                            @if(!empty($searchTerm))
                                No cars found matching "{{ $searchTerm }}" ({{ $totalCarCount }} total cars)
                            @else
                                No cars found for this user
                            @endif
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Enhanced Profile Section -->
        <div id="profile" class="content-section">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        {{ strtoupper(substr($user->UserName, 0, 1)) }}
                    </div>
                    <div class="profile-info">
                        <h2>{{ $user->UserName }}</h2>
                        <p>{{ $user->email }}</p>
                        <p>Member since: {{ $user->created_at->format('F Y') }}</p>
                    </div>
                </div>

                <ul class="profile-menu">
                    <li class="profile-menu-item">
                        <a href="#" class="profile-menu-link" onclick="showProfileSection('change-password')">
                            <span><i class="fas fa-key"></i> Change Password</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="profile-menu-item">
                        <a href="#" class="profile-menu-link" onclick="showProfileSection('personal-info')">
                            <span><i class="fas fa-user"></i> Personal Information</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="profile-menu-item">
                        <a href="#" class="profile-menu-link" onclick="showProfileSection('privacy-settings')">
                            <span><i class="fas fa-shield-alt"></i> Privacy Settings</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                    <li class="profile-menu-item">
                        <a href="#" class="profile-menu-link" onclick="showProfileSection('email-preferences')">
                            <span><i class="fas fa-envelope"></i> Email Preferences</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                </ul>

                <div class="danger-zone">
                    <h3><i class="fas fa-exclamation-triangle"></i> Danger Zone</h3>
                    <p>Once you delete your account, there is no going back. Please be certain.</p>
                    <button class="danger-btn" onclick="showProfileSection('delete-account')">
                        <i class="fas fa-trash-alt"></i> Delete Account
                    </button>
                </div>
            </div>

            <!-- Profile Sub-sections -->
            <div id="change-password" class="profile-subsection" style="display: none;">
                <h3><i class="fas fa-key"></i> Change Password</h3>

                <!-- Display error messages if any -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('change-password') }}" id="passwordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        @error('current_password')
                            <div class="password-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required minlength="8">
                        @error('new_password')
                            <div class="password-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                       <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required minlength="8">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                        <button type="button" class="btn btn-secondary" onclick="hideProfileSection('change-password')">Cancel</button>
                    </div>
                </form>
            </div>

            <div id="personal-info" class="profile-subsection" style="display: none;">
                <h3><i class="fas fa-user"></i> Personal Information</h3>
                <form method="POST" action="{{ route("account-change") }}" id="personalInfoForm">
                    @csrf
                    <div class="mb-3">
                        <label for="userName" class="form-label">Username</label>
                        <input type="text" class="form-control" id="userName" name="username" value="{{ $user->UserName }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="Enter your phone number" value="{{ $user->phone_number }}">
                    </div>
                    <div class="form-actions">
                        <button  type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" onclick="hideProfileSection('personal-info')">Cancel</button>
                    </div>
                </form>
            </div>

            <div id="privacy-settings" class="profile-subsection" style="display: none;">
                <h3><i class="fas fa-shield-alt"></i> Privacy Settings</h3>
                <form id="privacyForm" onsubmit="updatePrivacySettings(event)">
                    @csrf
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="profileVisibility" name="profile_visibility">
                        <label class="form-check-label" for="profileVisibility">Make my profile public</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showEmail" name="show_email">
                        <label class="form-check-label" for="showEmail">Show email address to other users</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPhone" name="show_phone">
                        <label class="form-check-label" for="showPhone">Show phone number to other users</label>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Settings</button>
                        <button type="button" class="btn btn-secondary" onclick="hideProfileSection('privacy-settings')">Cancel</button>
                    </div>
                </form>
            </div>

            <div id="email-preferences" class="profile-subsection" style="display: none;">
                <h3><i class="fas fa-envelope"></i> Email Preferences</h3>
                <form id="emailForm" onsubmit="updateEmailPreferences(event)">
                    @csrf
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="newsletter" name="newsletter" checked>
                        <label class="form-check-label" for="newsletter">Subscribe to newsletter</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="promotional" name="promotional" checked>
                        <label class="form-check-label" for="promotional">Receive promotional offers</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="notifications" name="notifications" checked>
                        <label class="form-check-label" for="notifications">Receive notification emails</label>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Save Preferences</button>
                        <button type="button" class="btn btn-secondary" onclick="hideProfileSection('email-preferences')">Cancel</button>
                    </div>
                </form>
            </div>

            <div id="delete-account" class="profile-subsection" style="display: none;">
                <h3><i class="fas fa-exclamation-triangle"></i> Delete Account</h3>
                <p>Are you sure you want to delete your account? This action cannot be undone. All your data will be permanently removed.</p>
                <form action="{{ route('delete.account') }}" method="POST" id="deleteAccountForm">
                    @csrf
                    <div class="mb-3">
                        <label for="deletePassword" class="form-label">Enter your password to confirm</label>
                        <input type="password" class="form-control" id="deletePassword" name="deletePassword" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-danger">Permanently Delete My Account</button>
                        <button type="button" class="btn btn-secondary" onclick="hideProfileSection('delete-account')">Cancel</button>
                    </div>
                </form>

                <!-- Add this to show error messages -->
                @if(session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <div id="transactions" class="content-section">
            <h2>Transactions</h2>
            <p>Details of the user's transactions.</p>
        </div>
        <div id="favorites" class="content-section">
            <h2>Favorites</h2>
            <p>The user's favorite items will appear here.</p>
        </div>
        <div id="sellbuy" class="content-section">
            <h2>Sell & Buys</h2>
            <p>Information related to selling and buying cars.</p>
        </div>
    </div>

    <!-- Add Car Modal -->
    <div id="addCarModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Add New Car</h2>
                <span class="close" onclick="closeModal('addCarModal')">&times;</span>
            </div>
            <div class="modal-body">
                <form id="addCarForm">
                    @csrf
                    <div class="mb-3">
                        <label for="carName" class="form-label">Car Name</label>
                        <input type="text" class="form-control" id="carName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="carPrice" class="form-label">Price ($)</label>
                        <input type="number" class="form-control" id="carPrice" name="price" required min="0">
                    </div>
                    <div class="mb-3">
                        <label for="carEngine" class="form-label">Engine</label>
                        <input type="text" class="form-control" id="carEngine" name="engine" required>
                    </div>
                    <div class="mb-3">
                        <label for="carDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="carDescription" name="description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addCarModal')">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="addCar()">Add Car</button>
            </div>
        </div>
    </div>

    <!-- Car Details Modal -->
    <div id="carDetailsModal" class="modal car-details-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="carDetailsTitle">Car Details</h2>
                <span class="close" onclick="closeModal('carDetailsModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="car-image" id="car-detail-image">
                    <i class="fas fa-car fa-3x"></i>
                </div>

                <div class="car-details-grid">
                    <div class="car-detail-item">
                        <div class="car-detail-label">Car Name</div>
                        <div class="car-detail-value" id="car-detail-name"></div>
                    </div>
                    <div class="car-detail-item">
                        <div class="car-detail-label">Price</div>
                        <div class="car-detail-value" id="car-detail-price"></div>
                    </div>
                    <div class="car-detail-item">
                        <div class="car-detail-label">Engine</div>
                        <div class="car-detail-value" id="car-detail-engine"></div>
                    </div>
                    <div class="car-detail-item">
                        <div class="car-detail-label">Year</div>
                        <div class="car-detail-value" id="car-detail-year"></div>
                    </div>
                    <div class="car-detail-item">
                        <div class="car-detail-label">Color</div>
                        <div class="car-detail-value" id="car-detail-color"></div>
                    </div>
                    <div class="car-detail-item">
                        <div class="car-detail-label">Mileage</div>
                        <div class="car-detail-value" id="car-detail-mileage"></div>
                    </div>
                </div>

                <div class="car-detail-item">
                    <div class="car-detail-label">Description</div>
                    <div class="car-detail-value" id="car-detail-description"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('carDetailsModal')">Close</button>
            </div>
        </div>
    </div>

    <!-- JS Script to handle the navigation and interactions -->
    <script>
        const links = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('.content-section');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Remove the 'active' class from all links
                links.forEach(link => link.classList.remove('active'));

                // Add the 'active' class to the clicked link
                link.classList.add('active');

                const target = link.getAttribute('href').substring(1);

                // Hide all sections
                sections.forEach(section => {
                    section.classList.remove('active');
                });

                // Show the target section
                document.getElementById(target).classList.add('active');
            });
        });

        // Set default active section (Cars)
        document.getElementById('cars').classList.add('active');
        document.querySelector('.nav-link[href="#cars"]').classList.add('active');

        // Function to show profile subsections
        function showProfileSection(sectionId) {
            // Hide all profile subsections
            document.querySelectorAll('.profile-subsection').forEach(section => {
                section.style.display = 'none';
            });

            // Show the selected subsection
            document.getElementById(sectionId).style.display = 'block';

            // Scroll to the subsection
            document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
        }

        // Function to hide profile subsections
        function hideProfileSection(sectionId) {
            document.getElementById(sectionId).style.display = 'none';
        }

        // Function to show notification
        function showNotification(message, type) {
            const notification = document.getElementById('notification');
            notification.textContent = message;
            notification.className = `notification ${type}`;
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
            }, 5000);
        }

        // Function to update password
        function updatePassword(event) {
            event.preventDefault();
            // In a real application, you would send an AJAX request to the server
            showNotification('Password updated successfully!', 'success');
            hideProfileSection('change-password');
        }

        // Function to update personal info
        function updatePersonalInfo(event) {
            event.preventDefault();
            // In a real application, you would send an AJAX request to the server
            showNotification('Personal information updated successfully!', 'success');
            hideProfileSection('personal-info');
        }

        // Function to update privacy settings
        function updatePrivacySettings(event) {
            event.preventDefault();
            // In a real application, you would send an AJAX request to the server
            showNotification('Privacy settings updated successfully!', 'success');
            hideProfileSection('privacy-settings');
        }

        // Function to update email preferences
        function updateEmailPreferences(event) {
            event.preventDefault();
            // In a real application, you would send an AJAX request to the server
            showNotification('Email preferences updated successfully!', 'success');
            hideProfileSection('email-preferences');
        }

        // Function to delete account
        function deleteAccount(event) {
            event.preventDefault();
            if (confirm('Are you absolutely sure you want to delete your account? This cannot be undone!')) {
                // In a real application, you would send an AJAX request to the server
                showNotification('Your account has been deleted successfully.', 'success');
                setTimeout(() => {
                    window.location.href = '/';
                }, 2000);
            }
        }

        // Modal functions
        function showAddCarModal() {
            document.getElementById('addCarModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function addCar() {
            // In a real application, you would send an AJAX request to the server
            showNotification('Car added successfully!', 'success');
            closeModal('addCarModal');
        }

        // Function to show car details in a modal
        function showCarDetails(carId) {
            // In a real application, you would fetch car details from the server
            // For now, we'll use dummy data
            const carDetails = {
                name: "Car " + carId,
                price: "$" + (carId * 5000).toLocaleString(),
                engine: "Engine Type " + (carId % 3 + 1),
                year: 2020 + (carId % 5),
                color: ["Red", "Blue", "Black", "White", "Silver"][carId % 5],
                mileage: (10000 + carId * 2000) + " miles",
                description: "This is a detailed description of the car with ID " + carId + ". It includes all the features and specifications that make this car unique and desirable.",
                gallery_image: "https://placehold.co/600x400/007bff/white?text=Car+" + carId
            };

            // Populate the modal with car details
            document.getElementById('carDetailsTitle').textContent = carDetails.name;
            document.getElementById('car-detail-name').textContent = carDetails.name;
            document.getElementById('car-detail-price').textContent = carDetails.price;
            document.getElementById('car-detail-engine').textContent = carDetails.engine;
            document.getElementById('car-detail-year').textContent = carDetails.year;
            document.getElementById('car-detail-color').textContent = carDetails.color;
            document.getElementById('car-detail-mileage').textContent = carDetails.mileage;
            document.getElementById('car-detail-description').textContent = carDetails.description;

            // Set the car image
            const carImageElement = document.getElementById('car-detail-image');
            carImageElement.innerHTML = `<img src="${carDetails.gallery_image}" alt="${carDetails.name}">`;

            // Show the modal
            document.getElementById('carDetailsModal').style.display = 'block';
        }

        // Placeholder functions for delete and show details (these should be handled in backend)
        function deleteCar(carId) {
            if (confirm("Are you sure you want to delete this car?")) {
                // You can call an API or backend route to delete the car
                console.log(`Car with ID: ${carId} deleted.`);
                // After deleting, reload or update the table.
            }
        }

        // Search functionality
        document.getElementById('search').addEventListener('input', function() {
            let searchQuery = this.value.toLowerCase();
            let rows = document.querySelectorAll('.car-table tbody tr');

            rows.forEach(row => {
                let carName = row.cells[0].textContent.toLowerCase();
                let carPrice = row.cells[1].textContent.toLowerCase();
                let carEngine = row.cells[2].textContent.toLowerCase();

                // If the car matches the search query, display the row
                if (carName.includes(searchQuery) || carPrice.includes(searchQuery) || carEngine.includes(searchQuery)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modals = document.getElementsByClassName('modal');
            for (let i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = 'none';
                }
            }
        }
    </script>

</body>
</html>
