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

            <li class="header">Финансовый раздел</li>

            <li class="@if(Request::routeIs('admin.banks')) active @endif treeview">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Банки</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu @if(Request::routeIs('admin.banks.*')) menu-open @endif"
                    style="display: none; @if(Request::routeIs('admin.banks.*')) display: block; @endif"
                >
                    <li class="@if(Request::routeIs('admin.banks.banks.*')) active @endif">
                        <a href="{{ route('admin.banks.banks.index') }}">
                            <i class="fa fa-bank"></i>
                            <span>Все банки</span>
                        </a>
                    </li>
                    <li class="@if(Request::routeIs('admin.banks.categories.*')) active @endif">
                        <a href="{{ route('admin.banks.categories.all') }}">
                            <i class="fa fa-folder-open-o"></i>
                            <span>Все категор. страницы</span>
                        </a>
                    </li>
                    <li class="@if(Request::routeIs('admin.banks.info-pages.*')) active @endif">
                        <a href="{{ route('admin.banks.info-pages.all') }}">
                            <i class="fa fa-file-text-o"></i>
                            <span>Все инфо-страницы</span>
                        </a>
                    </li>
                    <li class="@if(Request::routeIs('admin.banks.products.*')) active @endif">
                        <a href="{{ route('admin.banks.products.all') }}">
                            <i class="fa fa-list-alt"></i>
                            <span>Все продукты</span>
                        </a>
                    </li>
                    <li class="@if(Request::routeIs('admin.banks.reviews.*')) active @endif">
                        <a href="{{ route('admin.banks.reviews.all') }}">
                            <i class="fa fa-commenting-o"></i>
                            <span>Все отзывы</span>
                        </a>
                    </li>
                </ul>
            </li>

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

            <li class="@if(Request::routeIs('admin.companies')) active @endif treeview">
                <a href="#">
                    <i class="fa fa-bank"></i>
                    <span>Компании</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu @if(Request::routeIs('admin.companies.*')) menu-open @endif"
                    style="display: none; @if(Request::routeIs('admin.companies.*')) display: block; @endif"
                >
                    <li class="@if(Request::routeIs('admin.companies.index')) active @endif">
                        <a href="{{ route('admin.companies.index') }}">
                            <i class="fa fa-bank"></i>
                            <span>Компании</span>
                        </a>
                    </li>

                    <li class="@if(Request::routeIs('admin.companies.reviews.*')) active @endif">
                        <a href="{{ route('admin.companies.reviews.index') }}">
                            <i class="fa fa-commenting-o"></i>
                            <span>Отзывы</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul><!-- /.sidebar-menu -->

    </section>
</aside>
