<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Movimientos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div >
                <livewire:contadores /> 
            </div>
            <hr>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- <h5>{{Auth::user()->roles->implode('name', ',')}}</h5> -->
                <livewire:movimientos /> 
            </div>

        </div>
    </div>
</x-app-layout>