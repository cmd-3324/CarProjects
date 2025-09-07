<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Car;
class ChartService
{
    /**
     * Add a car to user's chart
     */
    public static function addToChart(int $userId, int $carId): bool
    {
        try {
            $car = DB::table('cars')->where('car_id', $carId)->first();

            if (!$car || $car->available_as <= 0) {
                return false;
            }

            // Check if already in chart
            $exists = DB::table('car_user')
                ->where('UserID', $userId)
                ->where('car_id', $carId)
                ->exists();

            if ($exists) {
                return false;
            }

            // Insert into pivot table
            DB::table('car_user')->insert([
                'UserID' => $userId,
                'car_id' => $carId,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // USE THE RELIABLE SYNC METHOD
            self::syncCarSalesData($carId);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to add car to chart', [
                'user_id' => $userId,
                'car_id' => $carId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Remove a car from user's chart
     */
//     public static function AddTofavorites(){
//         try {




// }
// }
    public static function removeFromChart(int $userId, int $carId): bool
    {
        try {
            $car = DB::table('cars')->where('car_id', $carId)->first();

            if (!$car) {
                return false;
            }

            
            $exists = DB::table('car_user')
                ->where('UserID', $userId)
                ->where('car_id', $carId)
                ->exists();

            if (!$exists) {
                return false;
            }

            // Delete from pivot table
            DB::table('car_user')
                ->where('UserID', $userId)
                ->where('car_id', $carId)
                ->delete();

            // USE THE RELIABLE SYNC METHOD
            self::syncCarSalesData($carId);

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to remove car from chart', [
                'user_id' => $userId,
                'car_id' => $carId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

   
    public static function getUserChart(int $userId)
    {
        return DB::table('car_user')
            ->join('cars', 'car_user.car_id', '=', 'cars.car_id')
            ->where('car_user.UserID', $userId)
            ->select('cars.*', 'car_user.created_at as added_at')
            ->orderBy('car_user.created_at', 'desc')
            ->get();
    }


    public static function clearUserChart(int $userId): bool
    {
        try {
          
            $carIds = DB::table('car_user')
                ->where('UserID', $userId)
                ->pluck('car_id')
                ->unique()
                ->toArray();

        
            DB::table('car_user')
                ->where('UserID', $userId)
                ->delete();


            foreach ($carIds as $carId) {
                self::syncCarSalesData($carId);
            }

            return true;

        } catch (\Exception $e) {
            Log::error('Failed to clear user chart', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    
    public static function isInChart(int $userId, int $carId): bool
    {
        return DB::table('car_user')
            ->where('UserID', $userId)
            ->where('car_id', $carId)
            ->exists();
    }

 
public static function syncCarSalesData(int $carId = null): void
{
    if ($carId) {
        $car = Car::find($carId);
        if (!$car) {
            return;
        }
        
        $pivotCount = DB::table('car_user')
            ->where('car_id', $carId)
            ->count();

        $totalStock = $car->sell_number + $car->available_as; // Current total
        $available = $totalStock - $pivotCount;
        
        if ($available < 0) {
            $available = 0;
        }

        DB::table('cars')
            ->where('car_id', $carId)
            ->update([
                'sell_number' => $pivotCount,
                'available_as' => $available
            ]);
    } else {
        // Sync all cars
        $cars = DB::table('cars')->get();

        foreach ($cars as $car) {
            $pivotCount = DB::table('car_user')
                ->where('car_id', $car->car_id)
                ->count();

            $totalStock = $car->sell_number + $car->available_as;
            $available = $totalStock - $pivotCount;
            
            if ($available < 0) {
                $available = 0;
            }

            DB::table('cars')
                ->where('car_id', $car->car_id)
                ->update([
                    'sell_number' => $pivotCount,
                    'available_as' => $available
                ]);
        }
    }
}
}
