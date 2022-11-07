<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Train') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('trains.update', $train)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <x-input type="text" name="name" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $train->name)"></x-input>

                        <x-textarea name="cargo" rows="10" placeholder="Start typing" class="w-full mt-6" value="{{@old('cargo', $train->cargo)}}"></x-textarea>

                        <x-input name="image" rows="10" placeholder="Start typing" class="w-full mt-6" :value="@old('image', $train->image)"></x-input>

                        <x-input type="number" name="cost" placeholder="price" class="w-full" autocomplete="off" :value="@old('cost', $train->cost)"></x-input>

                        <x-input type="number" name="destination" placeholder="local" class="w-full" autocomplete="off" :value="@old('destination', $train->destination)"></x-input>

                        <button class="my-6"> Save Train</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
