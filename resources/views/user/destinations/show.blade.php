<x-app-layout>
    <x-slot location="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Destinations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$destination->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$destination->updated_at->diffForHumans()}}
                </p>

                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                             The Destination is {{$destination->location}}
                            </h2>

                            <div class="flex">
                            <p>
                                <img src="{{asset('storage/images/destination/' . $destination->picture)}}" width="200"/>
                            </p>

                            <div>
                            <p>
                               The station master consists of {{$destination->station_master}}
                            </p>

                             <p>
                                Checked for dock {{$destination->has_dock}}
                             </p>

                             <p>
                                Checked for airport {{$destination->has_airport}}
                             </p>
                            </div>
                            </div>
                            </tbody>
                             <table>
                        </div>
            </div>
                    </div>
                </div>
        </x-app-layout>
