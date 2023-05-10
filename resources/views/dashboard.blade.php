@php
use App\Models\Cv;
use App\Models\User;

$count = User::all()->count();
$cvcount = Cv::where('status',"!=","Hired")->count();
$hiredcvcount = Cv::where('status','Hired')->count();

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
       <label for=""><a style="color:red" href="/admin/hired">Hired CV ({{$hiredcvcount}})</a></label><br>
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

                    <div class="flex flex-row">
                        <div class="basis-1/6 mt-10 ml-10">
                            <input class="m-10 border-none border-double rounded-lg" type="text" value="NAME" required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="TECHNOLOGY" required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="LEVEL:"   required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="SALARY EXPECTATION" required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="EXPERIENCEE" required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="PHONE NUMBER" required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="EMAIL" required><br>
                            <input class="m-10 border-none border-4 border-double rounded-lg" type="text" value="REFRENCE" required><br>
                     
                        </div>
                        <div class="basis-1/6 mt-10 ml-10">
                            <input class="m-10 border border-4 border-double rounded-lg" type="text" name="name" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="text" name="tech" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="text" name="level" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="text" name="salaryexp" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="text" name="exp" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="number" name="number" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="email" name="email" required><br>
                            <input class="m-10 border border-4 border-double rounded-lg" type="text" name="ref" required><br>

                        </div>
                    </div>


                <div class="p-6 pb-0 text-gray-900">
                   
                   
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
