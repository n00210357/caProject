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

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$train->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$train->updated_at->diffForHumans()}}
                </p>

                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                             The Train is {{$train->name}}
                            </h2>

                            <div class="flex">
                            <p>
                            <img src="{{asset('storage/images/train/' . $train->image)}}" width="200"/>
                            </p>

                            <p>
                               The Cargo consists of {{$train->cargo}}
                            </p>

                             <p>
                                Cost of €{{$train->cost}}
                             </p>
                            </div>

                        <div class="p-6"></div>

                             <h2>
                                Destination
                             </h2>

                             <div class="flex">
                             <div>
                                <img src="{{asset('storage/images/destination/' . $train->destination->picture)}}" width="200"/>
                             </div>

                             <div>
                             <p>
                                {{$train->destination->location}}
                             </p>

                             <p class="">
                                Station Master {{$train->destination->station_master}}
                             </p>
                             </div>
                             </div>

                             <div class="p-6"></div>

                        <div>
                            @foreach ($train->driver as $driver)
                            <tr>
                                <td class="font-bold">Driver</td>
                                <td> {{$driver->first_name}} </td>
                                <td> {{$driver->last_name}} </td>
                            </tr>
                            @endforeach
                        </div>
                            </tbody>
                             <table>
                        </div>
            </div>
                    </div>
                </div>
        </x-app-layout>
