<x-app-layout>
       
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        {{ __("ADD INTERVIEWERS") }}
    </div>

    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("FILL THE REQUIRED FIELDS") }}
                </div><br>

                <form action="/admin/addinterviewer" method="POST" enctype='multipart/form-data'>
                    @csrf
                <div class="p-6 pb-0 text-gray-900">
                   <label for="name">Name:</label><br>
                   <input type="text" name="name" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="tech">Position:</label><br>
                   <input type="text" name="position" required>
                </div>
                <div class="p-6 pb-0 text-gray-900">
                   <label for="level">Date Time:</label><br>
                   <input type="datetime-local" name="datetime" required>
                </div>
                <div class="p-6 text-gray-900">
                   <button class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-green focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">SUBMIT</button>
                </div>
                </form>
            </div>
        </div>
    </div>

  
 
</x-app-layout>
