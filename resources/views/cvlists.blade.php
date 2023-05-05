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
                <div class="pl-6 text-gray-900">
                 <a href="/admin/view/{{$item->id}}"><label for="name">{{$item->name}}</label></a>
                </div><br>
               @endforeach
            </div>
        </div>
    </div>
</x-app-layout>