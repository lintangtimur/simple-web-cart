<?php use Illuminate\Support\Number; ?>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="bg-white">
                        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Pembelianmu</h2>

                        <div class="flex flex-col border-b border-gray-300 py-2">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-lg font-semibold">Invoice #12345</p>
                                
                                <span class="text-sm text-gray-500">Waktu Pembelian: {{$history[0]->created_at}}</span>
                            </div>
                    
                            <!-- Table for item details -->
                            @foreach ($history as $item)
                            <div class="flex justify-between">
                                <div class="w-1/2">
                                    <p class="text-sm">Nama Item: {{$item->product->product_name}}</p>
                                    <p class="text-sm">Harga: Rp {{Number::format($item->product->price)}}</p>
                                </div>
                                <div class="w-1/4">
                                    <p class="text-sm">Quantity: {{$item->quantity}}</p>
                                    
                                </div>
                            </div>
                            <hr>
                            @endforeach
                            <div class="flex justify-end">
                                <p class="text-lg font-semibold">Total Harga: Rp {{Number::format($totalPurchase)}}</p>
                            </div>
                            <!-- Status information -->
                            <div class="mt-2">
                                <span class="px-2 py-1 rounded font-semibold text-white 
                                    {{ strtotime('now') - strtotime($history[0]->created_at) > 3 * 60 * 60 ? 'bg-red-500' : 'bg-green-500' }}">
                                    {{ strtotime('now') - strtotime($history[0]->created_at) > 3 * 60 * 60 ? 'Closed' : 'Open' }}
                                </span>
                            </div>

                            
                        </div>
                        
                        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                        </div>  
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>