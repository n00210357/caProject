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


                        <x-input name="location" rows="10" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $destination->location)"></x-input>

                        <x-input type="text" name="station_master" placeholder="Start typing" class="w-full mt-6" value="{{@old('station_master', $destination->station_master)}}"></x-input>

                        <x-file-input type="file" name="picture" placeholder="Train" class="w-full mt-6" field="image" value="{{@old('picture', $destination->picture)}}"></x-file-input>

                        <input type="hidden" name="has_dock" value="0"/>
                        <x-input type="checkbox" name="has_dock" placeholder="0 = false 1 = true" class="w-full" autocomplete="on" value=1></x-input>

                        <input type="hidden" name="has_airport" value="0"/>
                        <x-input type="checkbox" name="has_airport" placeholder="0 = false 1 = true" class="w-full" autocomplete="on" value=1></x-input>

                        <button class="my-6"> Save Destination</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>

