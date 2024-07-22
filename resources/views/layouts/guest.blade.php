<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arial:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">

            <nav x-data="{ open: false }" class="bg-white border-b border-gray-200">
<!-- Primary Navigation Menu -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between h-16">
<div class="flex">
<!-- home -->
<div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
<x-jet-nav-link href="http://127.0.0.1:8000" :active="request()->routeIs('dashboard')">
<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
<polyline points="5 12 3 12 12 3 21 12 19 12"></polyline>
<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
<path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
</x-jet-nav-link>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- Logo -->
<div class="flex-shrink-0 flex items-center" >
<a href="">
<img class="img-responsive" src="{{URL::asset('/bizap.png')}}"style="height:49px;width:100px;margin-top: -8%">
</a>
<h2 class="page-title">&nbsp;&nbsp;&nbsp;Business Acceleration Program</h2>

</div>
<style type="text/css">
    .page-title {
    margin: 0;
    font-size: 1.1rem;
    line-height: 1.5555556;
    font-weight: 500;
    color: #727272;
    display: flex;
    align-items: center;font-family: Arial;
}
</style>

</div>
<div class="hidden sm:flex sm:items-center sm:ml-6">
<div class="ml-3 relative">
 <a href="{{ route('loginpage') }}" style="text-decoration: none;"><button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500" style="background-color: #fff; border-color: rgba(101, 109, 119, .24); white-space: nowrap;" >
{{ __('Login') }}</a>&nbsp;&nbsp;
<svg xmlns=" http://www.w3.org/2000/svg" class="icon" width="19" height="20" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
<path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
<path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
</svg>
</button>
</div>
</div>

</div>
</div>


</nav>


            {{ $slot }}
        </div>
    </body>
</html>
<style type="text/css">
.min-h-screen {
background-color: #f3f6f7;
background-size: cover;
  background-repeat: no-repeat;
  width: 100%;
  height: 130px;

  }

</style>

