<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
  </head>
  <body class="bg-gray-100 ">

    @yield('page')
   @if(session('error') || session('success'))

    <div id="alert-message" class="max-w-xs bg-white border border-gray-200 rounded-xl shadow-lg dark:bg-gray-800 dark:border-gray-700 absolute z-[100] right-4 top-4 p-4 {{ session('error') ? 'bg-red-400' : 'bg-green-400' }}">
      <div class="flex p-4">
        <div class="flex-shrink-0">
          @if(session('success'))
            <svg class="flex-shrink-0 h-4 w-4 text-teal-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </svg>
          @else
            <svg class="flex-shrink-0 h-4 w-4 text-red-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
          @endif
        </div>
        <div class="ms-3">
          <p class="text-sm text-gray-700 dark:text-gray-400">
            {{ session('error') ?: session('success') }}
          </p>
        </div>
      </div>
    </div>
    <script>
        setTimeout(function () {
            document.getElementById('alert-message').style.display = 'none';
        }, 3000);
    </script>
@endif
<div id="alert"></div>
</body>
</html>