@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container mx-auto px-4 py-8">
    {{-- Search Results Header --}}
    @if(!empty($searchTerm))
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6">
            <p>Showing results for: <strong>"{{ $searchTerm }}"</strong></p>
            {{-- Use a form to clear search instead of direct link --}}
            <form action="{{ route('Search_car_page') }}" method="GET" class="inline">
                <button type="submit" class="text-blue-600 hover:text-blue-800 text-sm underline bg-transparent border-none p-0">
                    Clear search and show all cars
                </button>
            </form>
        </div>
    @endif

    <h2 class="text-3xl font-bold mb-6 flex items-center gap-2">
        <i class="fas fa-car text-blue-500"></i> Available Cars
        @if(!empty($searchTerm))
            <span class="text-sm text-gray-500">(Filtered results)</span>
        @endif
    </h2>

    @if($cars->count() > 0)
        <p class="text-gray-600 mb-4">Existing Cars: {{ $cars->count() }}</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $carItem)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6">
                    <h3 class="text-xl font-semibold mb-2 flex items-center gap-2">
                        <i class="fas fa-id-card text-gray-500"></i> {{ $carItem->name }} — <span class="text-sm text-gray-400">#{{ $carItem->car_id }}</span>
                    </h3>
                    <p class="text-gray-600 mb-1">
                        <i class="fas fa-chart-line text-purple-500"></i> Sell Number: <strong>{{ $carItem->sell_number }}</strong>
                    </p>
                    <p class="text-gray-600 mb-1">
                        <i class="fas fa-coins text-green-500"></i> Total Benefit: <strong>{{ number_format($carItem->benefit) }}</strong>
                    </p>
                    <p class="text-gray-600 mb-1">
                        <i class="fas fa-users text-teal-500"></i> Total Buyers: <strong>{{ $carItem->total_buyers }}</strong>
                    </p>
                    <p class="text-green-600 font-bold mb-1">
                        <i class="fas fa-dollar-sign"></i> {{ number_format($carItem->price) }}
                    </p>
                    <p class="text-gray-600 mb-4">
                        <i class="fas fa-warehouse text-orange-500"></i> Available: {{ $carItem->available_as }} units
                    </p>
                    
                    {{-- Action Buttons --}}
                    <div class="flex gap-2">
                        <form method="POST" action="{{ route('Add-Chart') }}" class="flex-1">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $carItem->car_id }}">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center justify-center gap-2 transition">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                        
                        <form action="{{ route('Add-To-Fav') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $carItem->car_id }}">
                            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded flex items-center justify-center gap-2 transition">
                                <i class="fas fa-heart"></i> Favorite
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-gray-100 rounded-lg p-8 text-center">
            <i class="fas fa-car text-gray-400 text-5xl mb-4"></i>
            <p class="text-gray-500 text-xl">No cars available at the moment.</p>
            @if(!empty($searchTerm))
                <p class="text-gray-600 mt-2">No results found for "{{ $searchTerm }}"</p>
                <a href="{{ route('all-cars') }}" class="text-blue-600 hover:text-blue-800 underline mt-4 inline-block">View all cars</a>
            @endif
        </div>
    @endif

    {{-- Most Sold Cars Section --}}
    @if($cars->count() > 0 && $cars->where('sell_number', '>=', 5)->count() > 0)
        <h2 class="text-3xl font-bold mt-12 mb-6 flex items-center gap-2">
            <i class="fas fa-fire text-red-500"></i> Most Sold Cars
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($cars as $carItem)
                @if ($carItem->sell_number >= 5)
                    <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow p-6 border-2 border-red-100">
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs">
                            <i class="fas fa-fire"></i> Popular
                        </div>
                        <h3 class="text-xl font-semibold mb-2 flex items-center gap-2">
                            <i class="fas fa-id-card text-gray-500"></i> {{ $carItem->name }} — <span class="text-sm text-gray-400">#{{ $carItem->car_id }}</span>
                        </h3>
                        <p class="text-gray-600 mb-1">
                            <i class="fas fa-chart-line text-purple-500"></i> Sell Number: <strong>{{ $carItem->sell_number }}</strong>
                        </p>
                        <p class="text-gray-600 mb-1">
                            <i class="fas fa-coins text-green-500"></i> Total Benefit: <strong>{{ number_format($carItem->benefit) }}</strong>
                        </p>
                        <p class="text-gray-600 mb-1">
                            <i class="fas fa-users text-teal-500"></i> Total Buyers: <strong>{{ $carItem->total_buyers }}</strong>
                        </p>
                        <p class="text-green-600 font-bold mb-1">
                            <i class="fas fa-dollar-sign"></i> {{ number_format($carItem->price) }}
                        </p>
                        <p class="text-gray-600 mb-4">
                            <i class="fas fa-warehouse text-orange-500"></i> Available: {{ $carItem->available_as }} units
                        </p>
                        
                        {{-- Action Buttons --}}
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('Add-Chart') }}" class="flex-1">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $carItem->car_id }}">
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded flex items-center justify-center gap-2 transition">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </form>
                            
                            <form action="{{ route('Add-To-Fav') }}" method="POST" class="flex-1">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $carItem->car_id }}">
                                <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded flex items-center justify-center gap-2 transition">
                                    <i class="fas fa-heart"></i> Favorite
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
@endsection