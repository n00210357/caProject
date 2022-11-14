<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trains') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

                <table>
                    <tbody>

                <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                    <h2>
                    {{$train->name}}
                    </h2>

                    <p class="whitespace-pre-wrap">
                    <img src="{{url('/images/'. $train->image)}}" alt="Image" width="200px"/>
                    </p>

                    <p class="whitespace-pre-wrap">
                       {{$train->cargo}}
                    </p>

                     <p class="whitespace-pre-wrap">
                        {{$train->cost}}
                     </p>

                     <p class="whitespace-pre-wrap">
                        {{$train->destination}}
                     </p>
                    </tbody>
                     <table>
                </div>
            </div>
        </div>
</x-app-layout>
