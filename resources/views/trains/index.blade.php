<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trains') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('trains.create') }}" class="btn-link btn-lg mb-2">+ New Train</a>
            @forelse ($trains as $train)
                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                    <h2>
                        <a href="{{ route('trains.show', $train->uuid) }}"> {{$train->name}}</a>
                    </h2>
                    <p class="mt-2">
                       {{Str::limit($train->cargo), 200}}
                    </p>
                    <span class="block mt-4 text-sm opacity-70"> {{$train->updated_at->diffForHumans()}}</span>
                </div>
                @empty
                <p>You have no trains</p>
                @endforelse
                {{$trains->links()}}
            </div>
        </div>
</x-app-layout>
