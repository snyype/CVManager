@php
use Carbon\Carbon;
@endphp


<x-app-layout>


    <head>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </head>
    

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           <a href="/admin/cvlists">{{ __("CV") }}</a> / {{ __("$data->name") }}
        </h2>
    </x-slot>

    <div class="py-12 container-fluid">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{ __("CV And Available Info of $data->name") }}
                </div><br>

                <div class="flex flex-row">
                    <div class="basis-1/6 mt-8 ml-8">
                    
                        <label for="">  NAME  </label><br>
                        <label for=""> TECHNOLOGY  </label><br>
                        <label for="">   EXPERIENCE  </label><br>
                        <label for="">  SALARY EXPECTATION  </label><br>
                        <label for="">   LEVEL  </label><br>
                        <label for="">   PHONE NUMBER </label><br>
                        <label for="">   EMAIL  </label><br>
                        <label for="">   REFRENCE  </label><br>
                        <label for="">   INTERVIEWER  </label><br>
                        <label for="">   DATE AND TIME  </label><br><br>
                        <label for="">   STATUS  </label><br>
                    
                    </div>
                    {{-- <div class="basis-1/6 mt-8">
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                        : <br>
                    </div> --}}
                    <div class="basis-1/6 mt-8">
                
                        <label>{{$data->name}}</label><br>
                        <label>{{$data->tech}}</label><br>
                        <label>{{$data->exp}}</label><br>
                        <label>{{$data->salaryexp}}</label><br>
                        <label>{{$data->level}}</label><br>
                        <label>{{$data->number}}</label><br>
                        <label>{{$data->email}}</label><br>
                        <label>{{$data->ref}}</label><br>
                        <label>{{$data->interviewer}}</label><br>
                        <label>@if($data['datetime'] == NULL)N/A @else <label for="">{{ Carbon::create($data->datetime)->diffForHumans() }}</label> {{$data->datetime}}</label>@endif<br>
                        <label> @if($data['status'] == "submited") {{$data->status}} @else <label class="text-green-700" for="">{{$data->status}}</label>@endif </label><br>
                    
                    </div>
                    
                  </div>
                  <div class="mt-5">

              
                        
                        <x-primary-button class="ml-3" id="hidecontainer" onclick="removeStatus()">
                            {{ __('CHANGE STATUS') }}
                        </x-primary-button>
                        <x-primary-button class="ml-3 hidden" id="showcontainer" onclick="addStatus()">
                            {{ __('CHANGE STATAUS') }}
                        </x-primary-button>
                        
                        

                        <x-primary-button class="ml-3" id="postYourAdd" onclick="postYourAdd()">
                            {{ __('VIEW CV') }}
                        </x-primary-button>
                       
                        <x-primary-button class="ml-3 hidden" id="removeYourAdd" onclick="removeYourAdd()">
                            {{ __('HIDE CV') }}
                        </x-primary-button>
                       
                      
                        

             <br>
                </div>

                <div class="row justify-content-center p-4" id="iframe-container">
                    <iframe class="hidden" id="forPostyouradd" data-src="{{asset('images/cv/'.$data["image"])}}" src="about:blank" height="1000" width="100%"></iframe>
                </div><br><br>
               
               
            </div>
        </div>
    </div>
 



    
<script>
    function postYourAdd () {
    var iframe = $("#forPostyouradd");
    iframe.attr("src", iframe.data("src")); 
    iframe.removeClass("hidden");
    $("#removeYourAdd").removeClass("hidden");
    $("#postYourAdd").addClass("hidden");
}

function removeYourAdd() {
  var iframe = $("#forPostyouradd");
  iframe.addClass("hidden");
  $("#removeYourAdd").addClass("hidden");
  $("#postYourAdd").removeClass("hidden");
}

function addStatus() {
 var div =  $("#status");
 div.addClass("hidden");

  
}
function removeStatus() {
 var div =  $("#status");
 div.removeClass("hidden");
 $("#hidecontainer").addClass("hidden");
  
}



   

</script>
   

<div id="status" class="container hidden">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("CHANGE CV STATUS OF $data->name") }}
                </div><br>
                <div class="pl-6 text-gray-900">
                 <form action="/admin/changestatus/{{$data->id}}" method="POST">
                    @csrf
                    <label for="">CHANGE STATUS</label>
                    
                    <select name="status" id="status" required>
                        <option value="{{$data->status}}">{{$data->status}}</option>
                        <option value="Shortlisted">Shortlisted</option>
                        <option value="1st Interview Done">1st Interview Done</option>
                        <option value="2nd Interview Done">2nd Interview Done</option>
                        <option value="Hired">Hired</option>
                        <option value="Rejected">Rejected</option>
                        <option value="Blacklisted">Blacklisted</option>
                    </select><br><br>

                    <label for="">ASSIGN INTERVIEWER</label>
                    <select name="interviewer" id="status" required>
                    
                        <option value="{{$data->interviewer}}">{{$data->interviewer}}</option>
                     
                     
                        @foreach($data0 as $item)
                        <option value="{{$item->name}}">{{$item->name}}</option>
                        
                        @endforeach
                       
                    </select><br><br>

                    <label for="">ASSIGN DATE AND TIME</label>
                    <input min="<?php echo date('Y-m-d\TH:'); ?>" type="datetime-local" value="{{$data->datetime}}" name="datetime"    >
                    <x-primary-button class="ml-3">
                        {{ __('SUBMIT') }}
                    </x-primary-button>
                 </form>
                </div><br>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
