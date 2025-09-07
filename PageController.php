<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\Caruse;
use Illuminate\Http\Request;
use App\Models\CarUser;
use App\Services\ChartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function show_all_cars()
    {
        $cars = Car::where('available_as', '>', 0)
                   ->withCount('carBuyers as total_buyers')
                   ->sort()
                   ->get();

        return view('CarPage', compact('cars'));
    }

    public function gotoProfile($user_id)
    {
        $sortBy = request()->input('sort', 'none');

        $user = CarUser::with(['cars' => function($query) {
            $query->sort();
        }])->find($user_id);

        if (!$user) {
            abort(404, 'User not found');
        }

        $totalCarCount = $user->cars()->count();
        $foundCarCount = $user->cars->count();
        $searchTerm = null;

        return view("UserPannel", compact('user', 'totalCarCount', 'foundCarCount', 'sortBy'));
    }

    public function deleteaccount(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'deletePassword' => 'required|string',
        ]);

        if (Hash::check($request->deletePassword, $user->password)) {
            DB::table("carsusers")->where("UserID", $user->UserID)->delete();
            return redirect('/home')->with('success', 'Your account has been deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Incorrect password. Account deletion failed.');
        }
    }

    public function changeAccount(Request $request)
    {
        $user_id = Auth::user()->UserID;

        $validated = $request->validate([
            'username' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'numeric'],
        ]);

        DB::table('carsusers')->where('UserID', $user_id)->update([
            'UserName' => $validated['username'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
        ]);

        return redirect()->back()->with('success', 'Account changed successfully');
    }

    public function addToChart(Request $request)
    {
        $request->validate(['car_id' => 'required|exists:cars,car_id']);

        $carId = $request->car_id;

        if (ChartService::addToChart(Auth::id(), $carId) && Auth::user()->Active==1) {
            return redirect()->back()->with('success', 'Car added!');
        }

        return redirect()->back()->with('error', 'Failed to add car.');
    }

    public function emergencyFixCarCounts()
    {
        // Use the service method instead of manual code
        ChartService::syncCarSalesData();

        return "All car counts have been synced successfully!";
    }

    public function clearChart()
    {
        if (ChartService::clearUserChart(Auth::id())) {
            return redirect()->back()->with('success', 'Chart cleared!');
        }

        return redirect()->back()->with('error', 'Failed to clear chart.');
    }

    public function change_password(Request $request)
    {
        $user_id = Auth::user()->UserID;

        $current_password_request = $request->input("current_password");
        $new_password = $request->input("new_password");
        $new_password_confirmation = $request->input("new_password_confirmation");

        $user = DB::table("carsusers")->where("UserID", $user_id)->first();

        if (!Hash::check($current_password_request, $user->password)) {
            return redirect("/profile/{$user_id}")->with("error", "Current Password Does not match");
        }

        if ($new_password !== $new_password_confirmation) {
            return redirect("/profile/{$user_id}")->with("error", "New Password Does not match");
        }

        DB::table("carsusers")->where("UserID", $user_id)->update([
            'password' => Hash::make($new_password)
        ]);

        return redirect()->back()->with("success", "Changed Password");
    }

    public function Contact()
    {
        return view("Contact");
    }

    public function searchCarPage(Request $request) {
        $searchTerm = $request->input("searchTerm");
        
        $query = Car::where('available_as', '>', 0)
                   ->withCount('carBuyers as total_buyers');
        
        if (!empty($searchTerm)) {
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('discription', 'like', '%' . $searchTerm . '%');
            });
        }
        
        $cars = $query->orderBy('name', 'asc')->get();
        
        return view('CarPage', compact('cars', 'searchTerm'));
    }
    public function GetAboutPage() {
        return view("aboutus");
}
    public function deleteCar(Request $request)
    {
        $carId = $request->input('car_id');
        $user = Auth::user();

        // Use ChartService instead of direct DB operation
        if (ChartService::removeFromChart($user->UserID, $carId)) {
            return redirect()->back()->with('success', 'Car removed!');
        }

        return redirect()->back()->with('error', 'Failed to remove car.');
    }

    public function search(Request $request)
    {
        $sortBy = $request->input('sort', 'none');
        $searchTerm = $request->input('search');
        $user = Auth::user();

        $totalCarCount = $user->cars()->count();

        $user->load(['cars' => function($query) use ($searchTerm) {
            if (!empty($searchTerm)) {
                $query->where(function($q) use ($searchTerm) {
                    $q->where('name', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('engine', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('price', 'LIKE', "%{$searchTerm}%");
                });
            }
            $query->sort();
        }]);

        $foundCarCount = $user->cars->count();

        return view('UserPannel', compact(
            'user',
            'totalCarCount',
            'foundCarCount',
            'sortBy',
            'searchTerm'
        ));
    }

    public function deleteAll()
    {
        $user = Auth::user();

        // Use ChartService instead of manual DB operations
        if (ChartService::clearUserChart($user->UserID)) {
            return redirect()->back()->with("success", "All cars deleted successfully!");
        }

        return redirect()->back()->with("error", "Failed to delete all cars!");
    }
}