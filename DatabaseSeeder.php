<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Car;
use App\Models\CarUser;
use App\Models\CarUse;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disable ALL model events
        \Illuminate\Database\Eloquent\Model::unsetEventDispatcher();

        // Check if required tables exist
        if (!DB::getSchemaBuilder()->hasTable('cars')) {
            echo "Cars table doesn't exist! Please run migrations first.\n";
            return;
        }

        if (!DB::getSchemaBuilder()->hasTable('carsusers')) {
            echo "CarsUsers table doesn't exist! Please run migrations first.\n";
            return;
        }

        if (!DB::getSchemaBuilder()->hasTable('car_user')) {
            echo "Car_User pivot table doesn't exist! Please run migrations first.\n";
            return;
        }

        // Clear existing data
        DB::table('car_user')->truncate();
        DB::table('cars')->truncate();
        DB::table('carsusers')->truncate();

        echo "=== Seeding CarsUsers Table ===\n";

        // Create users using factory
        $users = CarUser::factory()->count(10)->create();
        echo "Created {$users->count()} users\n";

        echo "\n=== Seeding Cars Table ===\n";

        // Create cars using factory
        $cars = Car::factory()->count(15)->create();
        echo "Created {$cars->count()} cars\n";

        echo "\n=== Creating Car-User Relationships ===\n";

        // Create relationships between users and cars
        $relationshipCount = 0;
        foreach ($users as $user) {
            // Each user will own 1-3 random cars
            $carsToOwn = $cars->random(rand(1, 3));

            foreach ($carsToOwn as $car) {
                // Check if relationship already exists
                $exists = DB::table('car_user')
                    ->where('UserID', $user->UserID)
                    ->where('car_id', $car->car_id)
                    ->exists();

                if (!$exists) {
                    DB::table('car_user')->insert([
                        'UserID' => $user->UserID,
                        'car_id' => $car->car_id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);
                    $relationshipCount++;
                }
            }
        }

        echo "Created {$relationshipCount} car-user relationships\n";

        echo "\n=== Syncing Car Sales Data ===\n";

        // Sync all car data using the reliable method
        $cars = Car::all();
        foreach ($cars as $car) {
            $pivotCount = DB::table('car_user')
                ->where('car_id', $car->car_id)
                ->count();

            $car->update([
                'sell_number' => $pivotCount,
                'available_as' => 6 - $pivotCount
            ]);

            echo "Car {$car->car_id} ({$car->name}): {$pivotCount} buyers, Available: " . (6 - $pivotCount) . "\n";
        }

        echo "\n=== Final Summary ===\n";
        echo "Total users: " . CarUser::count() . "\n";
        echo "Total cars: " . Car::count() . "\n";
        echo "Total relationships: " . DB::table('car_user')->count() . "\n";

        // Display some sample data
        echo "\n=== Sample Data ===\n";

        // Show first 3 users
        $sampleUsers = CarUser::limit(3)->get();
        foreach ($sampleUsers as $user) {
            $carCount = DB::table('car_user')->where('UserID', $user->UserID)->count();
            echo "User: {$user->UserName} ({$user->email}) - Owns {$carCount} cars\n";
        }

        // Show first 3 cars
     
    }
}
