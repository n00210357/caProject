<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Destination') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('admin.destinations.update', $destination)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <x-input type="text" name="location" rows="10" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $destination->location)"></x-input>

                        <x-input name="station_master" placeholder="Start typing" class="w-full mt-6" value="{{@old('station_master', $destination->station_master)}}"></x-input>

                        <x-input name="picture" rows="10" placeholder="Start typing" class="w-full mt-6" :value="@old('picture', $destination->picture)"></x-input>

                        <x-input type="number" name="has_dock" placeholder="price" class="w-full" autocomplete="off" :value="@old('has_dock', $destination->has_dock)"></x-input>

                        <x-input type="number" name="has_airport" placeholder="price" class="w-full" autocomplete="off" :value="@old('has_airport', $destination->has_airport)"></x-input>

                        <button class="my-6"> Save Train</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>

