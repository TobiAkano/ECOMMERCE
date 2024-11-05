<div class="flex items-center" x-data>
    <x-button 
        disabled 
        x-bind:disabled="$wire.qty <= 1"{{-- el button se habilita si el número es mayor o igual que uno --}}
        wire:loading.attr="disabled"{{-- Mientras se está cargando el boton estará deshabilitado --}}
        wire:target="decrement"{{-- El boton solo se deshabilita cuando ejecutemos este método  --}}
        wire:click="decrement">{{-- Variable en componente AddCartItem --}}
        -
    </x-button>
    <span class="mx-3 text-gray-700">{{$qty}}</span>
    <x-button 
        x-bind:disabled="$wire.qty >= $wire.quantity"{{-- Se bloquea cuando la amountidad es igual que la amountidad de los productos en stock  --}}
        wire:loading.attr="disabled"
        wire:target="increment"
        wire:click="increment">
        +
    </x-button>
</div>
