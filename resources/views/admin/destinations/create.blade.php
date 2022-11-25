<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destination') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    @foreach ($errors->all() as $error)
                    <p> {{$error}}</p>
                    @endforeach

                    <form action="{{ route('admin.destinations.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <x-input type="text" name="location" placeholder="Title" class="w-full" autocomplete="off"></x-input>
                        @error('location')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-input name="station_master" rows="10" placeholder="Start typing" class="w-full mt-6"></x-input>
                        @error('station_master')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-text-input name="picture" rows="10" placeholder="picture" class="w-full mt-6" field="destination_image"></x-text-input>
                        @error('picture')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-input type="number" name="has_dock" placeholder="0 = false 1 = true" class="w-full" autocomplete="off"></x-input>
                        @error('has_dock')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-input type="number" name="has_airport" placeholder="0 = false 1 = true" class="w-full" autocomplete="off"></x-input>
                        @error('has_airport')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <button class="my-6"> Save Destination</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
