<?php
    function setItemActive($name){
        return Route::currentRouteName() === $name ? 'active' : '';
    }
?>
<div class="bg-transparent text-white" id="sidebar-wrapper">
    <div class="sidebar-heading"><a class="text-decoration-none text-white" href="{{route('admin.index')}}">{{ env('APP_NAME','Laravel') }}</a></div>
    <div class="list-group list-group-flush">
        @if(checkPermissions('admin.overview',false))
            <a href="{{route('admin.index')}}" class="list-group-item {{ setItemActive('admin.index')}}"> <i class="fas fa-th-list"></i>Overview</a>
        @endif
        @if(checkPermissions('teacher.overview',false))
            <a href="{{route('admin.teacher.index')}}" class="list-group-item {{ setItemActive('admin.teacher.index')}}"> <i class="fas fa-chalkboard-teacher"></i>Teachers</a>
        @endif
        @if(checkPermissions('module.overview',false))
            <a href="{{route('admin.module.index')}}" class="list-group-item {{ setItemActive('admin.module.index')}}"> <i class="fas fa-book"></i>Modules</a>
        @endif
            <hr class="divider">
            <a href="{{route('guest.index')}}" class="list-group-item {{setItemActive('guest.index')}}"> <i class="fas fa-tachometer-alt"></i> Dashboard</a>
            <hr class="divider">
        @if(checkPermissions('user.overview',false))
            <a href="{{route('admin.user.index')}}" class="list-group-item {{setItemActive('admin.user.index')}}"> <i class="fas fa-user-alt"></i> Users</a>
        @endif
        @if(checkPermissions('role.overview',false))
            <a href="{{route('admin.role.index')}}" class="list-group-item {{setItemActive('admin.role.index')}}"> <i class="fas fa-users-cog"></i> Roles</a>
        @endif
        @if(checkPermissions('permission.overview',false))
            <a href="{{route('admin.permission.index')}}" class="list-group-item {{setItemActive('admin.permission.index')}}"> <i class="fas fa-tasks"></i> Permissions</a>
        @endif
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

