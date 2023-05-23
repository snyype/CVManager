
<div>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">
   

</head>

    <div class="p-6 text-gray-900">
        <input 
        wire:model="query"
        type="search" 
        id="search-bar"
        placeholder="press '/ ' to focus search" 
        wire:keydown.tab="resetData"
        wire:keydown.escape="resetData"
        >
    </div>
    
    <div class="m-8" wire:loading>
        SEARCHING......
    </div>

@if (!empty($query))
@if(!empty($cv))




<div class="p-6 text-gray-900">
    @foreach($cv as $cvs)
    
    <div class="flex flex-row border border-black">
        <div class="basis-1/3 mt-8 ml-8">
            <label for="">NAME  </label><br>
            <label for="">TECHNOLOGY  </label><br>
            <label for="">STATUS  </label><br><br>
        </div>
        <div class="basis-1/3 mt-8 ml-8">
            <label for="">{{$cvs['name']}}</label><br>
            <label for="">{{$cvs['tech']}}</label><br>
            <label for=""> @if($cvs['status']== "submited") {{$cvs['status']}} @else <label class="text-green-600" for="">{{$cvs['status']}}</label></label>@endif<br>
        </div>

        <div class="basis-1/3 mt-8 p-3 ml-8">
            <a href="/admin/view/{{$cvs['id']}}">
                <x-primary-button class="ml-3 p-5">
                    {{ __('Open') }}  
                </x-primary-button>
                </a>
        </div>
    </div>

    @endforeach
</div>
@else

<div class="border border-black m-5 h-20 text-justify">
    <p class="m-5">NO RESULTS.. <li class="fa fa-search"></li></p>
    
</div>

@endif

@else
         
      
    
@endif 

<script>
    $(document).ready(function() {
    $(document).keydown(function(event) { // Listen for keydown events on the document
      if (event.keyCode === 191) { // Check if the key pressed was the "/" key
        event.preventDefault(); // Prevent the "/" character from being entered into the input field
        const searchBar = $("#search-bar");

        if (searchBar.is(":focus")) { // Check if the search bar already has focus
          searchBar.blur(); // If it does, blur the search bar to remove focus
        } else {
          searchBar.focus(); // If it doesn't, focus the search bar to add focus
        }
        

      }
    });
  });
  
  
  </script>

</div>
