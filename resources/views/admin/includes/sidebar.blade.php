<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">

            <li class="@if(Request::routeIs('admin.index')) active @endif">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Панель управления</span>
                </a>
            </li>

            <li class="header">Карточки</li>
            <li class="@if(Request::routeIs('admin.cards')) active @endif treeview">
                <a href="#">
                    <i class="fa fa-id-card-o"></i>
                    <span>Карточки</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu @if(Request::routeIs('admin.cards.*')) menu-open @endif"
                    style="display: none; @if(Request::routeIs('admin.cards.*')) display: block; @endif"
                >
                    <li class="@if(Request::routeIs('admin.cards.categories.*')) active @endif">
                        <a href="{{ route('admin.cards.categories.index') }}">
                            <i class="fa fa-folder-open-o"></i>
                            <span>Категории</span>
                        </a>
                    </li>
                    <li class="@if(Request::routeIs('admin.cards.cards.*')) active @endif">
                        <a href="{{ route('admin.cards.cards.index') }}">
                            <i class="fa fa-id-card-o"></i>
                            <span>Карточки</span>
                        </a>
                    </li>
                    <li class="@if(Request::routeIs('admin.cards.listings.*')) active @endif">
                        <a href="{{ route('admin.cards.listings.index') }}">
                            <i class="fa fa-edit"></i>
                            <span>Листинги</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->

    </section>
</aside>
