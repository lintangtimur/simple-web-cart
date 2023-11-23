<?php use Illuminate\Support\Number; ?>
<x-app-layout>
    <body class="bg-gray-100">
        <div class="container mx-auto mt-10">
          <div class="flex shadow-md my-10">
            <div class="w-3/4 bg-white px-10 py-10">
              <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl">Shopping Cart</h1>
                <h2 class="font-semibold text-2xl">{{count($carts)}} Items</h2>
              </div>
              <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-2/5">Product Details</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Quantity</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Price</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5 text-center">Total</h3>
              </div>

              <form action="confirm" method="post">
              @csrf
              @foreach ($carts as $item)
                  
              
              <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                <div class="flex w-2/5"> <!-- product -->
                  <div class="w-20">
                    <img class="h-24" src="https://drive.google.com/uc?id=18KkAVkGFvaGNqPy2DIvTqmUH_nk39o3z" alt="">
                  </div>
                  <div class="flex flex-col justify-between ml-4 flex-grow">
                    <span class="font-bold text-sm">{{$item->product->product_name}}</span>
                    {{-- <span class="text-red-500 text-xs">Apple</span> --}}
                    
                  </div>
                </div>
                <div class="flex justify-center w-1/5">
                  
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
                            name="product_{{$item->product_id}}"
                            value="{{$item->quantity}}"
                            class="h-10 w-24 rounded border-gray-200 text-center sm:text-sm"
                            onchange="updateQuantity({{$item->id}}, this.value)"
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
                <span class="text-center w-1/5 font-semibold text-sm">{{Number::format($item->product->price)}}</span>
                <span class="updatePrice_{{$item->id}} text-center w-1/5 font-semibold text-sm">{{Number::format($item->product->price * $item->quantity)}}</span>
              </div>
      
              @endforeach
      
              <a href="product" class="flex font-semibold text-indigo-600 text-sm mt-10">
            
                <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512"><path d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"/></svg>
                Continue Shopping
              </a>
            </div>
      
            <div id="summary" class="w-1/4 px-8 py-10">
              <h1 class="font-semibold text-2xl border-b pb-8">Order Summary</h1>
              {{-- <div class="flex justify-between mt-10 mb-5">
                <span class="font-semibold text-sm uppercase">Items 3</span>
                <span class="totalCost font-semibold text-sm">{{Number::format($summaries['total'])}}</span>
              </div> --}}
              
              <div class="py-10">
                <label for="promo" class="kupon50 font-semibold inline-block mb-3 text-sm uppercase">Kupon 50 ribu : {{$summaries['kupon_50rb']}}</label>
                <label for="promo" class="kupon100 font-semibold inline-block mb-3 text-sm uppercase">Kupon kelipatan 100 ribu : {{$summaries['kupon_100rb']}}</label>
                
              </div>
              
              <div class="border-t mt-8">
                <div class="flex font-semibold justify-between py-6 text-sm uppercase">
                  <span>Total cost</span>
                  <span class="totalCost">{{Number::format($summaries['total'])}}</span>
                </div>
                <input type="hidden" name="total" class="totalHidden" value="{{$summaries['total']}}">
                <button type="submit" class="bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full">Confirm</button>
              </form>
                {{-- <a href="history" class="block bg-indigo-500 font-semibold hover:bg-indigo-600 py-3 text-sm text-white uppercase w-full text-center">Confirm</a> --}}

              </div>
            </div>
      
          </div>
        </div>
      </body>

</x-app-layout>

@vite('resources/js/summaries.js')