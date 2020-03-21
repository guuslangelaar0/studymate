<?php
    function setItemActive($name){
        return Route::currentRouteName() === $name ? 'active' : '';
    }
?>
<div class="bg-transparent text-white" id="sidebar-wrapper">
    <div class="sidebar-heading"><a class="text-decoration-none text-white" href="{{route('admin.index')}}">{{ env('APP_NAME','Laravel') }}</a></div>
    <div class="list-group list-group-flush">

        @foreach($items as $item)
            @can(Arr::get($item,'permission',null))
                <a href="{{route(Arr::get($item,'route',''))}}" class="list-group-item {{ setItemActive(Arr::get($item,'route',''))}}"> <i class="fas {{Arr::get($item,'icon',null)}}"></i>{{Arr::get($item,'name','')}}</a>
                @if(Arr::get($item,'divider',false))
                    <hr class="divider">
                @endif
            @endcan
        @endforeach

        <hr class="divider">
        @if(Session::has('loggedInAs'))
            <a href="#" class="list-group-item" onclick="event.preventDefault(); document.getElementById('returnToOwnUser').submit();"> <i class="fas fa-sign-in-alt"></i>Back to your account</a>
            <form id="returnToOwnUser" action="{{ route('admin.user.returnToOwnUser',Session::get('loggedInAs')) }}" method="POST" class="d-none">
                @csrf
            </form>
        @endif
        <a href="#" class="list-group-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt"></i>Sign out</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

