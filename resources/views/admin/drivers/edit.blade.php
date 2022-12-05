<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Driver') }}
        </h2>
    </x-slot>

        <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('admin.drivers.update', $driver)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf


                        <x-input name="first_name" rows="10" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $driver->first_name)"></x-input>

                        <x-input name="last_name" rows="10" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $driver->last_name)"></x-input>

                        <x-textarea name="certification" rows="10" placeholder="Start typing" class="w-full mt-6" value="{{@old('certification', $driver->certification)}}"></x-textarea>

                        <x-file-input type="file" name="photo" placeholder="Drive" class="w-full mt-6" field="image" value="{{@old('photo', $driver->photo)}}"></x-file-input>

                        <x-input type="number" name="salary" placeholder="price" class="w-full" autocomplete="off" :value="@old('salary', $driver->salary)"></x-input>

                        <button class="my-6"> Save Driver</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>

