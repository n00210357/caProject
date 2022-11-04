<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trains') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    @foreach ($errors->all() as $error)
                    <p> {{$error}}</p>
                    @endforeach

                    <form action="{{ route('trains.store')}}" method="post">
                        @csrf

                        <x-input type="text" name="name" placeholder="Title" class="w-full" autocomplete="off"></x-input>
                        @error('name')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-textarea name="cargo" rows="10" placeholder="Start typing" class="w-full mt-6"></x-textarea>
                        @error('cargo')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-textarea name="image" rows="10" placeholder="Start typing" class="w-full mt-6"></x-textarea>
                        @error('image')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-input type="number" name="cost" placeholder="price" class="w-full" autocomplete="off"></x-input>
                        @error('cost')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <x-input type="number" name="destination" placeholder="local" class="w-full" autocomplete="off"></x-input>
                        @error('destination')
                        <div class="text-red-600 text-sm">{{$message}}</div>
                        @enderror

                        <button class="my-6"> Save Train</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
