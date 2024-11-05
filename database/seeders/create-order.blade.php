<div class="container py-8 grid grid-cols-5 gap-6">
    <div class="col-span-3">
        {{-- Contact --}}
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Contact Name" />
                <x-jet-input type="text" placeholder="Enter the name of the person who will receive the product"
                    class="w-full" 
                    wire:model.defer="contact"/> {{-- .defer to send the information ONLY when the button is pressed --}}
                <x-jet-input-error for="contact" />
            </div>

            <div>
                <x-jet-label value="Contact Phone" />
                <x-jet-input type="text" placeholder="Enter the contact phone number" 
                    class="w-full" 
                    wire:model.defer="phone"/>
                <x-jet-input-error for="phone" />
            </div>
        </div>

        {{-- Shipping --}}
        <div x-data="{ envio_type: @entangle('envio_type') }">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Shipping</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input type="radio" x-model="envio_type" value="1" name="envio_type" class="text-gray-600">
                <span class="ml-2 text-gray-700">Pickup in-store (mystery street 43, 3 3)</span>
                <span class="font-semibold text-gray-700 ml-auto">Free</span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class="px-6 py-4 flex items-center">
                    <input type="radio" x-model="envio_type" value="2" name="envio_type" class="text-gray-600">
                    <span class="ml-2 text-gray-700">Home Delivery</span>
                </label>

                <div class="hidden" :class="{ 'hidden': envio_type != 2 }">
                    <div class="px-6 pb-6 grid grid-cols-2 gap-6">
                        {{-- Departments --}}
                        <div>
                            <x-jet-label value="Department"/>
                            <select class="form-control w-full" wire:model="department_id">
                                <option value="" disabled selected>Select a department</option>
                                @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="department_id" />
   
