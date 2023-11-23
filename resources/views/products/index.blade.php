{{-- @extends('layouts.app') --}}
<?php use Illuminate\Support\Number; ?>
<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Customers also purchased</h2>
                    
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            @foreach ($products as $item)
                            <div class="group relative">
                                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                    <img src="https://tailwindui.com/img/ecommerce-images/product-page-01-related-product-01.jpg" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
                                </div>
                                <div class="mt-4 flex justify-between">
                                    <div>
                                    <h3 class="text-sm text-gray-700">
                                        <a href="product/{{$item->id}}">
                                        <span aria-hidden="true" class=""></span>
                                        {{$item->product_name}}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">Black</p>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">Rp {{Number::format($item->price)}}</p>
                                </div>
                                <!-- Quantity Input -->

                                <div class="flex items-center">
                                    <label for="Quantity" class="text-sm font-medium text-gray-700">Quantity</label>
                                
                                    <div class="flex items-center gap-1 ml-2">
                                        <button
                                            type="button"
                                            class="h-10 w-10 leading-10 text-gray-600 transition hover:opacity-75"
                                            onclick="decreaseQuantity({{$item->id}})"
                                        >
                                            &minus;
                                        </button>
                                
                                        <input
                                            type="number"
                                            id="quantity_{{$item->id}}"
                                            value="1"
                                            class="h-10 w-24 rounded border-gray-200 text-center sm:text-sm"
                                            {{-- onchange="updateQuantity(this.value)" --}}
                                        />
                                
                                        <button
                                            type="button"
                                            class="h-10 w-10 leading-10 text-gray-600 transition hover:opacity-75"
                                            onclick="increaseQuantity({{$item->id}})"
                                        >
                                            &plus;
                                        </button>
                                    </div>
                                </div>
                                
                                
                                <!-- Add to Cart Button -->
                                <div class="mt-4">
                                    <button data-product-id="{{$item->id}}" class="add-to-cart w-full bg-gray-300 text-black px-4 py-2 rounded-md hover:bg-gray-400 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>    
                            @endforeach

                            
                        </div>  

                        <a href="{{route("summary")}}" class="block text-center bg-blue-500 mt-5 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                            Checkout
                        </a>

                        </div>
                    </div>
  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


@vite('resources/js/product.js')
<script>
    function decreaseQuantity(productId) {
        var quantityInput = document.getElementById('quantity_'+productId);
        var currentValue = parseInt(quantityInput.value, 10);
        quantityInput.value = currentValue > 1 ? currentValue - 1 : 1;
    }

    function increaseQuantity(productId) {
        var quantityInput = document.getElementById('quantity_'+productId);
        var currentValue = parseInt(quantityInput.value, 10);
        quantityInput.value = currentValue + 1;
    }

    function updateQuantity(productId) {
        var quantityInput = document.getElementById('quantity_'+productId);
        var newValue = parseInt(value, 10);
        quantityInput.value = isNaN(newValue) || newValue < 1 ? 1 : newValue;
    }
</script>
@section('scripts')
    
@endsection
