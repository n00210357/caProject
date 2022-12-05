<x-app-layout>
    <x-slot location="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drivers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{session('success')}}
            </x-alert-success>

            <div class ="flex">
                <p class="opacity-70">
                    <strong>Created: </strong> {{$driver->created_at->diffForHumans()}}
                </p>

                <p class="opacity-70 ml-8">
                    <strong>Updated at: </strong> {{$driver->updated_at->diffForHumans()}}
                </p>

                <a href="{{ route('admin.drivers.edit', $driver) }}" class="btn-link ml-auto">Edit Driver</a>

                <form action="{{ route('admin.drivers.destroy', $driver) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger ml-4" onclick="return confirm('Are you sure')">Delete Driver</button>
                </form>
                </div>
                <table>
                    <tbody>

                        <div class="p-6 bg-white border-b border-gray-200 shadow-sj sm:rounded-lg">
                            <h2>
                                 The Driver is
                            </h2>

                            <h2>
                                {{$driver->first_name}}
                                {{$driver->last_name}}
                            </h2>

                            <div class="flex">
                            <p>
                                <img src="{{asset('storage/images/driver/' . $driver->photo)}}" width="200"/>
                            </p>

                            <div>
                            <p>
                               Their certification is {{$driver->certification}}
                            </p>

                             <p>
                                They are paid €{{$driver->salary}} yearly
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
