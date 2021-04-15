@include('Dashboard::layouts.header')
@include('Dashboard::layouts.sidebar')


<div class="content">
    
    @include('Dashboard::layouts.main-header')

    <div class="main-content">

        @yield('app')

    </div>
</div>

@include('Dashboard::layouts.footer')
