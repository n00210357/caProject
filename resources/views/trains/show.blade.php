<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trains') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$train->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$train->updated_at->diffForHumans()}}
                </p>

                <a href="{{ route('trains.edit', $train) }}" class="btn-link ml-auto">Edit Train</a>
            </div>

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                    <h2>
                    {{$train->name}}
                    </h2>

                    <p class="mt-6 whitespace-pre-wrap">
                       {{$train->cargo}}
                    </p>


                </div>
            </div>
        </div>
</x-app-layout>
