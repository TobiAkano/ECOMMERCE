<div>
    <div class="bg-white rounded-lg shadow-lg mb-4">
        {{-- Target --}}
        <div class="px-6 py-2 flex justify-between items-center">
            <h1 class="font-semibold text-gray-700 uppercase">{{$category->name}}</h1>

            <div class="grid-grid-cols-2 border border-gray-200 divide-x divide-gray-200 text-gray-500">
                <i class="fas fa-border-all p-3 cursor-pointer {{ $view == 'grid' ? 'text-blue-500' : '' }}"  wire:click="$set('view', 'grid')"></i>
                <i class="fas fa-th-list p-3 cursor-pointer {{ $view == 'list' ? 'text-blue-500' : '' }}" wire:click="$set('view', 'list')"></i>
            </div>
        </div>
    </div>

    {{-- Main --}}
    <div class="grid grid-cols-5 gap-6">
        {{-- Aside subcategories --}}
        <aside>
            <h2 class="font-semibold text-center mb-2">Subcategorías</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->subcategories as $subcategory)
                    <li class="my-2 text-sm">
                        <a class="cursor-pointer hover:text-gray-500 capitalize {{$subcategoria == $subcategory->slug ? 'text-gray-500 font-semibold' : ''}}" 
                            wire:click="$set('subcategoria', '{{$subcategory->slug}}')">
                            {{$subcategory->name}}
                        </a>
                    </li>
                @endforeach
            </ul>

            <h2 class="font-semibold text-center mt-4 mb-2">Marcas</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($category->brands as $brand)
                    <li class="py-2 text-sm">
                        <a class="cursor-pointer hover:text-gray-500 capitalize {{$marca == $brand->name ? ' text-gray-500 text-font-semibold' : ''}}" {{-- si la marca es igual al nombre de la marca ? la clase será esta si no : '' no habrá nada --}}
                            wire:click="$set('marca', '{{$brand->name}}')">
                            {{$brand->name}}
                        </a>
                    </li>
                @endforeach
            </ul>

            <x-jet-button class="mt-4" wire:click="limpiar">
                Quitar filtro
            </x-jet-button>
        </aside>

        {{-- Products --}}
        <div class="col-span-4">

            {{-- Paginate --}}
            <div class="mt-4 mb-4">
                {{$products->links()}}
            </div>

            @if ($view == 'grid')
                
                <ul class="grid grid-cols-4 gap-6">
                    @forelse ($products as $product)
                        <li class="bg-white rounded-lg shadow">
                            <article>
                                <figure>
                                    <img src="{{ Storage::url($product->images->first()->url) }}" alt="">
                                </figure>

                                <div class="py-4 px-6">
                                    <h1 class="text-lg font-semibold">
                                        <a href="">
                                            {{Str::limit($product->name, 20)}}
                                        </a>
                                    </h1>
                                    <p class="font-bold text-gray-600">{{$product->price}} ₦</p>
                                </div>
                            </article>
                        </li> 
                        
                    @empty
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Ups!</strong>
                                <span class="block sm:inline">No hay registros sobre esta marca.</span>
                            </div>
                        </li>        
                        
                    @endforelse
                </ul>
            @else
                
                <ul>
                    @forelse ($products as $product)
                        <x-product-list :product="$product"/>

                    @empty
                        <li class="md:col-span-2 lg:col-span-4">
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Ups!</strong>
                                <span class="block sm:inline">No hay registros sobre esta marca.</span>
                            </div>
                        </li>        
                        
                    @endforelse
                </ul>    
            @endif

            {{-- Paginate --}}
            <div class="mt-4">
                {{$products->links()}}
            </div>
        </div>
    </div>
</div>
