<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Train') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">

                    <form action="{{ route('admin.trains.update', $train)}}" method="post" enctype="multipart/form-data">
                        @method('put')
                        @csrf

                        <x-input type="text" name="name" placeholder="Title" class="w-full" autocomplete="off" :value="@old('title', $train->name)"></x-input>

                        <x-textarea name="cargo" rows="10" placeholder="Start typing" class="w-full mt-6" value="{{@old('cargo', $train->cargo)}}"></x-textarea>

                        <x-file-input type="file" name="image" placeholder="Train" class="w-full mt-6" field="image" value="{{@old('image', $train->image)}}"></x-file-input>

                        <x-input type="number" name="cost" placeholder="price" class="w-full" autocomplete="off" :value="@old('cost', $train->cost)"></x-input>

                        <label for="destination">Destination</label>
                        <select name="destination_id">
                        @foreach($destination as $desination)
                        <option value="{{$desination->id}}" {{(old('destination_id') == $desination->id) ? "selected" : ""}}>
                            {{$desination->location}}
                        </option>
                        @endforeach
                        </select>

                        <button class="my-6"> Save Train</button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
