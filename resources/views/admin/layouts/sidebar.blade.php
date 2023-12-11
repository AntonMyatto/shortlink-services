<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{'/dashboard'}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" style="font-size:14px;"> {{ config('app.name', 'ShortLink') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{'/dashboard'}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Панель управления</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        @php
            $user = auth()->user();
        @endphp
    </div>

    @if($user->hasRole('root'))
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsefour"
               aria-expanded="true" aria-controls="collapsefour">
                <i class="fas fa-user-alt"></i>
                <span>Пользователи и роли</span>
            </a>
            <div id="collapsefour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('users.index') }}">Пользователи</a>
                    <a class="collapse-item" href="{{ route('roles.index') }}">Роли</a>
                </div>
            </div>
        </li>
    @endif
    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->

    <!-- Nav Item - Pages Collapse Menu -->
    @if($user->hasRole('root'))
        <div class="sidebar-heading">
            Функционал
        </div>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Приложение</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('generate-links.index') }}">Сокращение ссылок</a>
                </div>
            </div>
        </li>

    @elseif($user->hasRole('mngr'))
        <div class="sidebar-heading">
            Функционал
        </div>


        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Приложение</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Действия:</h6>
                    <a class="collapse-item" href="{{ route('generate-links.index') }}">Сокращение ссылок</a>
                </div>
                </di
                @elseif($user->hasRole('cnt'))
                    <div class="sidebar-heading">
                        Функционал
                    </div>


                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                           aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Приложение</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                             data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Действия:</h6>
                                <a class="collapse-item" href="{{ route('generate-links.index') }}">Сокращение
                                    ссылок</a>
                            </div>
                            </di
                            @elseif($user->hasRole('sc'))
                                <div class="sidebar-heading">
                                    Контент
                                </div>


                                <!-- Divider -->
                                <hr class="sidebar-divider d-none d-md-block">
                                <li class="nav-item">
                                    <a class="nav-link collapsed" href="#" data-toggle="collapse"
                                       data-target="#collapseTwo"
                                       aria-expanded="true" aria-controls="collapseTwo">
                                        <i class="fas fa-fw fa-folder"></i>
                                        <span>Приложение</span>
                                    </a>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                         data-parent="#accordionSidebar">
                                        <div class="bg-white py-2 collapse-inner rounded">
                                            <h6 class="collapse-header">Действия:</h6>
                                            <a class="collapse-item" href="{{ route('generate-links.index') }}">Сокращение
                                                ссылок</a>
                                        </div>
                                    </div>
                                </li>
                            @endif

                            <!-- Sidebar Toggler (Sidebar) -->
                            <div class="text-center d-none d-md-inline">
                                <button class="rounded-circle border-0" id="sidebarToggle"></button>
                            </div>


</ul>
<!-- End of Sidebar -->
