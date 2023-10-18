<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="/">Панель управления</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.index') }}"><i class="fas fa-box-open"></i> Панель управления</a>
                    </li>
                    <li class="nav-divider">Образовательный раздел</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.listings.index') }}"><i class="fas fa-map-signs"></i> Листинги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.companies.index') }}"><i class="fas fa-building"></i> Компании</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.company-reviews.index') }}"><i class="far fa-comment"></i> Отзывы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.courses.index') }}"><i class="far fa-address-card"></i> Курсы</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.course-tags.index') }}"><i class="fas fa-tags"></i> Теги</a>
                    </li>

                    <li class="nav-divider">Информацонный раздел</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post-categories.index') }}"><i class="far fa-folder-open"></i> Категории</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.posts.index') }}"><i class="fas fa-list"></i> Записи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.post-comments.index') }}"><i class="far fa-comment"></i> Комменатрии</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.index') }}"><i class="far fa-file"></i> Страницы</a>
                    </li>

                    <li class="nav-divider">Админ. раздел</li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.employees.index') }}"><i class="fas fa-user-md"></i> Сотрудники</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="far fa-user"></i> Пользователи</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.short-codes.index') }}"><i class="fas fa-code"></i> Шорткоды</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.static-pages.index') }}"><i class="far fa-sticky-note"></i> Статические страницы</a>
                    </li>

                    <li class="nav-item"><br><br></li>
                    <li class="nav-item"><br><br></li>
                </ul>
            </div>
        </nav>
    </div>
</div>
