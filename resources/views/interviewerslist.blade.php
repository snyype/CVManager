@php
use App\Models\Cv;
use App\Models\User;

$count = User::all()->count();
$cvcount = Cv::all()->count();

@endphp

<x-app-layout>
       
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        {{ __("ADMIN DASHBOARD") }}
    </div>
    <div class="p-6 text-gray-900">
      <label for="">LISTS OF INTERVIEWERS</label><br><br>
      @foreach($data as $items)
      <label for="">{{$items->name}} ({{$items->status}})</label><br><br><br>
      @endforeach
      <a href="/admin/addint">
        <x-primary-button class="ml-3 p-5">
            {{ __('ADD INTERVIEWER') }}
        </x-primary-button>
        </a>
    </div>

            </div>
        </div>
    </div>
    
   
</x-app-layout>
