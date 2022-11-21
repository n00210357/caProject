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

                <a href="{{ route('admin.trains.edit', $train) }}" class="btn-link ml-auto">Edit Train</a>

                <form action="{{ route('admin.trains.destroy', $train) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure')">Delete Train</button>
                </form>
                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                             The Train is {{$train->name}}
                            </h2>

                            <div class="flex">
                            <p>
                            <img src="{{url('/images/'. $train->image)}}" alt="Image" width="200px"/>
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
                                <img src="{{url('/images/'. $train->destination->picture)}}" alt="Image" width="200px"/>
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
                            </tbody>
                             <table>
                        </div>
            </div>
                    </div>
                </div>
        </x-app-layout>
