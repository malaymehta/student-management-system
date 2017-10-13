@include('layouts.partials.header')

@if (!(Auth::guest()))
    @include('layouts.partials.content')
@endif

@yield('content')

@if (!(Auth::guest()))
    @include('layouts.partials.footer')
@endif




