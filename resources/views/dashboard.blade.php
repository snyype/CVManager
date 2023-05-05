@php
use App\Models\Cv;
use App\Models\User;

$count = User::all()->count();
$cvcount = Cv::all()->count();

@endphp

    @livewireStyles


<x-app-layout>
    @if(auth()->check() && auth()->user()->isAdmin())
       
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        {{ __("ADMIN DASHBOARD") }} 
    </div>
    @livewire('search-c-v')
   
    <div class="p-6 text-gray-900">
       <label for="">ONLY USER WITH ADMIN PRIVELEGES CAN VIEW THIS PAGE</label><br>
       <label for="">Users Count : {{$count}}</label> <br>
       <br>
       <label for=""><a style="color:red" href="/admin/cvlists">CV LISTS ({{$cvcount}})</a></label><br>
       <label for=""><a style="color:red" href="/admin/intlists">INTERVIEWER LISTS</a></label><br>
    </div>
            </div>
        </div>
    </div>
    
    @else

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PROFILE') }}
        </h2>
    </x-slot>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("FILL THE REQUIRED FIELDS AND UPLOAD YOR CV!") }}
                </div><br>

                <form action="/formsubmit" method="POST" enctype='multipart/form-data'>
                    @csrf
                <div class="p-6 pb-0 text-gray-900">
                   <label for="name">Name:</label><br>
                   <input type="text" name="name" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="tech">Technology:</label><br>
                   <input type="text" name="tech" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="level">Level:</label><br>
                   <input type="text" name="level" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="salaryexp">Salary Expectation:</label><br>
                   <input type="text" name="salaryexp" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="exp">Experience:</label><br>
                   <input type="text" name="exp" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="number">Phone Number:</label><br>
                   <input type="number" name="number" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="email">Email:</label><br>
                   <input type="email" name="email" required>
                </div>
                <div class="p-6 text-gray-900">
                   <label for="ref">Refrences:</label><br>
                   <input type="text" name="ref" required>
                </div>
                <div class="p-6 text-gray-900">
                   <label for="image">Upload Your CV Here:</label><br>
                   <input type="file" name="image">
                </div>

                <div class="p-6 text-gray-900">
                   <button class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-green focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">SUBMIT</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @endif
 
    

@livewireScripts
    
    
</x-app-layout>
