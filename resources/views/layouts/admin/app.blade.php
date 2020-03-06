<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="admin-layout">
    <div id="app" class="d-flex">

        <?php
            $items = [
                [
                    "name" => "Overview",
                    "route" => "admin.index",
                    "permission" => "admin.overview",
                    "icon" => "fa-th-list",

                ],
                [
                    "name" => "Deadline Manager",
                    "route" => "admin.dm.index",
                    "permission" => "dm.overview",
                    "icon" => "fa-tasks",
                    "divider" => true,
                ],
                [
                    "name" => "Teachers",
                    "route" => "admin.teacher.index",
                    "permission" => "teacher.overview",
                    "icon" => "fa-chalkboard-teacher"
                ],
                [
                    "name" => "Modules",
                    "route" => "admin.module.index",
                    "permission" => "module.overview",
                    "icon" => "fa-book",
                    "divider" => true,
                ],
                [
                    "name" => "Dashboard",
                    "route" => "guest.index",
                    "icon" => "fa-tachometer-alt",
                    "divider" => true,
                ],
                [
                    "name" => "Users",
                    "route" => "admin.user.index",
                    "permission" => "user.overview",
                    "icon" => "fa-user-alt"
                ],
                [
                    "name" => "Roles",
                    "route" => "admin.role.index",
                    "permission" => "role.overview",
                    "icon" => "fa-users-cog"
                ],
                [
                    "name" => "Permissions",
                    "route" => "admin.permission.index",
                    "permission" => "permission.overview",
                    "icon" => "fa-tasks",
                ],
            ]
        ?>
        @include('layouts.admin.partials.sidebar', $items)

        <div class="content">
            @include('layouts.admin.partials.navbar')
            <main class="p-lg-5 py-3">
                @include('layouts.admin.partials.flash-message')
                @yield('content')
            </main>
        </div>



    </div>
</body>
</html>
