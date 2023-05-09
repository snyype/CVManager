<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CV LISTS') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("LIST OF SUBMITTED CV") }}
                </div><br>

                
                @foreach($data as $item)
               

                    <div class="flex flex-row">
                        <div class="basis-1/6 mt-8 ml-8">
                            <a href="/admin/view/{{$item->id}}"><label class="mr-10" for="name">{{$item->name}}</label></a>
                        </div>
                        <div class="basis-1/6 mt-8 ml-8 mb-10">
                            <label class="ml-10 mb-10" for="">{{$item->status}}</label>
                        </div>
                    </div>

                
               @endforeach
            </div>
        </div>
    </div>
</x-app-layout>