<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
    @livewireStyles
</head>

<body>

    @include('components.header')

    @yield('content')


    @livewireScripts
    @include('layouts.footer')

</body>

</html>
