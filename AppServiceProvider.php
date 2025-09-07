<?php

namespace App\Providers;
// use App\Models\Car;
// use App\Models\CarUserPivot;
// use App\Models\CarUser;

use App\Models\Car;
use App\Models\Caruse;
use App\Models\CarUser;
use App\Models\CarUserPivot;
use Illuminate\Support\Facades\View;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Log;

// use Illuminate\Database\Eloquent\Relations\Pivot;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {

        Schema::defaultStringLength(191);
//         View::composer("*", function($view) {
//         $car_id = request()->input("car_id");
//         $price = Car::where("car_id", $car_id)->price;
//         $count = CarUserPivot::where("car_id", $car_id);
//         $car_count = $price*$count;
//         return  $view->with('benefit', $car_count);
// });




 View::composer('*', function ($view) {
    $car_id = request()->input('car_id');

    if (!$car_id) {
        $view->with('benefit', null);
        return;
    }

    $car = Car::where('car_id', $car_id)->first();

    if (!$car) {
        $view->with('benefit', null);
        return;
    }

    $price = $car->price;
    $count = CarUse::where('car_id', $car_id)->count();
    $car_count = $price * $count;

    return $view->with('benefit', $car_count);
});


// Event::listen('eloquent.attached: *', function ($event, $data) {
//     $model = $data[1];
//     $relation = $data[0];
//     $ids = $data[2];

//     Log::info('Event caught', [
//         'model' => get_class($model),
//         'relation' => $relation,
//         'ids' => $ids
//     ]);

//     // Check if this is a car attached to user (from CarUser side)
//     if ($model instanceof \App\Models\CarUser && ($relation === 'cars' || $relation === 'car')) {
//         Log::info('Car attached to user via pivot', [
//             'user_id' => $model->UserID,
//             'car_ids' => $ids
//         ]);

//         foreach ((array)$ids as $carId) {
//             $car = Car::where('car_id', $carId)->first();

//             if ($car && $car->available_as > 0) {
//                 $oldSell = $car->sell_number;
//                 $oldAvailable = $car->available_as;

//                 $car->increment('sell_number');
//                 $car->decrement('available_as');

//                 Log::info("Car {$car->car_id} updated. Before: sell={$oldSell}, available={$oldAvailable}. After: sell={$car->sell_number}, available={$car->available_as}");
//             }
//         }
//     }

//     // Check if this is a user attached to car (from Car side)
//     if ($model instanceof \App\Models\Car && ($relation === 'carsusers' || $relation === 'carsusers')) {
//         Log::info('User attached to car via pivot', [
//             'car_id' => $model->car_id,
//             'user_ids' => $ids
//         ]);

//         if ($model->available_as > 0) {
//             $oldSell = $model->sell_number;
//             $oldAvailable = $model->available_as;

//             $model->increment('sell_number');
//             $model->decrement('available_as');

//             Log::info("Car {$model->car_id} updated. Before: sell={$oldSell}, available={$oldAvailable}. After: sell={$model->sell_number}, available={$model->available_as}");
//         }
//     }
// });





        Builder::macro("deleteall", function () {
            $user_id = Auth::user()->UserID;
            return $this->where("UserID", $user_id)->delete();
        });

     
        Builder::macro('sort', function ($defaultColumn = 'created_at', $defaultDirection = 'asc') {
            $sortParam = request()->input('sort', 'none');
            $sortColumn = $defaultColumn;
            $sortDirection = $defaultDirection;

            if ($sortParam !== 'none') {
                $parts = explode('_', $sortParam);

                if (count($parts) === 2) {
                    [$column, $direction] = $parts;
                    $allowedColumns = ['price', 'name', 'created_at'];
                    $allowedDirections = ['asc', 'desc'];

                    if (in_array($column, $allowedColumns) && in_array($direction, $allowedDirections)) {
                        $sortColumn = $column;
                        $sortDirection = $direction;
                    }
                }
            }

            return $this->orderBy($sortColumn, $sortDirection);
        });
    }
}
