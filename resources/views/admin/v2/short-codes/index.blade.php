@extends('admin.v2.layout')
@section('title', 'Шорткоды')
@section('h1', 'Шорткоды')

@section('content')

    <div class="alert alert-primary" role="alert">
        Полное описание с шорткодами смотрите в <a href="https://docs.google.com/spreadsheets/d/13sXdrqWVY0fD3BlrqFmW8CHzhKMJRiQxjL5ptYoT3k8/edit#gid=0" target="_blank">официальной докуменации шорткодов</a>.
    </div>

    <table class="table table-hover" id="coolTable">
        <thead>
        <tr>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">ТЗ</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Таблица</th>
                <td>
                    <p>Таблица служит для структурирования данных. Может состоять от 2-х и более столбцов и строк</p>
                </td>
                <td>
                    <a href="https://docs.google.com/document/d/1l9_tox67CZzw_qY0XWKlfuP7zgVZch4aXcD1AvpwaR4/edit#" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Сообщение</th>
                <td>
                    <p>Цветная рамка, служит для выделения важных мыслей в тексте.</p>
                </td>
                <td>
                    <a href="https://docs.google.com/document/d/168VlswEehhuRAyhsu4x1sPr8a4PMVBqF_M22RrOWsbE/edit#" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Аккордион</th>
                <td>
                    <p>Нужен для скрытия информации, которая пользователю будет не сильно важна. Если пользователь захочет прочитать текст, он сможешь раскрыть аккордеон</p>
                </td>
                <td>
                    <a href="https://docs.google.com/document/d/1uZocVkwBra_Md2HQuyrpe-WVpwaKT60x7NNJbZOzWW4/edit#" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Цитата</th>
                <td>
                    <p>Нужен для выделения цитаты автора</p>
                </td>
                <td>
                    <a href="https://docs.google.com/document/d/1hrz2ExYIj3MAPjEduBHW3MoniJi4mniY9bkVIiTyjcs/edit#heading=h.w7maymf5stio" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Нумерованный список</th>
                <td>
                    <p>Нужен для перечисления списка в определенном порядке</p>
                </td>
                <td>
                    <a href="https://docs.google.com/document/d/1x28uicDBKciTetjRrAtXN0VR9z70CqIkNy_mA0Djr7E/edit#" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Маркированный список</th>
                <td>
                    <p>Выделить текст списком, сделать текст более читабельным</p>
                </td>
                <td>
                    <a href="https://docs.google.com/document/d/1fKHuP3SETg-Rvnz9vYqo4czPXc20CwNT8vWZCXOspkk/edit#heading=h.kd3gtcuqm0np" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Текущий год</th>
                <td></td>
                <td>
                    <a href="https://docs.google.com/document/d/1KLdKz159QQxx-i5yoQGkE5E7uIsCrMi5_8lSnD9LPio/edit#" class="btn btn-info btn-sm" target="_blank" title="Просмотреть">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row">Выделение слова</th>
                <td></td>
                <td>
                </td>
            </tr>
            <tr>
                <th scope="row">Код</th>
                <td></td>
                <td>
                </td>
            </tr>
            <tr>
                <th scope="row">Переход на курс <br>(ссылка на курс школы)</th>
                <td></td>
                <td>
                </td>
            </tr>
            <tr>
                <th scope="row">Читайте также <br>(в статье)</th>
                <td></td>
                <td>
                </td>
            </tr>
            <tr>
                <th scope="row">Подпишись <br>(Полезные материалы)</th>
                <td></td>
                <td>
                </td>
            </tr>
            <tr>
                <th scope="row">Популярные статьи</th>
                <td></td>
                <td>
                </td>
            </tr>

        </tbody>
    </table>

@endsection
