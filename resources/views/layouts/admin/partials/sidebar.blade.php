<?php
    function setItemActive($name){
        return Route::currentRouteName() === $name ? 'active' : '';
    }
?>
<div class="bg-transparent text-white" id="sidebar-wrapper">
    <div class="sidebar-heading"><a class="text-decoration-none text-white" href="{{route('admin.index')}}">{{ env('APP_NAME','Laravel') }}</a></div>
    <div class="list-group list-group-flush">
        <a href="{{route('admin.index')}}" class="list-group-item {{ setItemActive('admin.index')}}"> <i class="fas fa-th-list"></i>Overview</a>
        <a href="{{route('admin.teacher.index')}}" class="list-group-item {{ setItemActive('admin.teacher.index')}}"> <i class="fas fa-chalkboard-teacher"></i>Teachers</a>
        <a href="{{route('admin.module.index')}}" class="list-group-item {{ setItemActive('admin.module.index')}}"> <i class="fas fa-book"></i>Modules</a>
        <hr class="divider">
        <a href="{{route('guest.index')}}" class="list-group-item {{setItemActive('guest.index')}}"> <i class="fas fa-tachometer-alt"></i> Dashboard</a>
        <hr class="divider">
        <a href="{{route('admin.user.index')}}" class="list-group-item {{setItemActive('admin.user.index')}}"> <i class="fas fa-user-alt"></i> Users</a>
        <a href="{{route('admin.role.index')}}" class="list-group-item {{setItemActive('admin.role.index')}}"> <i class="fas fa-users-cog"></i> Roles</a>
        <a href="{{route('admin.permission.index')}}" class="list-group-item {{setItemActive('admin.permission.index')}}"> <i class="fas fa-tasks"></i> Permissions</a>
        <hr class="divider">
        <a href="#" class="list-group-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fas fa-sign-out-alt"></i>Sign out</a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</div>

