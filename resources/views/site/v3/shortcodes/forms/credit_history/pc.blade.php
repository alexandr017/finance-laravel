<form class="form" id="creditHistory">
    <div class="form-title">Шаг 1. Заполните ФИО и телефон.</div>
    <div class="form-group">
        <label for="last_name"><i class="red">*</i> Фамилия:</label>
        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Иванов" required="true">
    </div>
    <div class="form-group">
        <label for="first_name"><i class="red">*</i> Имя:</label>
        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Иван" required="true">
    </div>
    <div class="form-group">
        <label for="middle_name"><i class="red">*</i> Отчество:</label>
        <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Иванович" required="true">
    </div>
    <div class="form-group">
        <label for="phone"><i class="red">*</i> Телефон <i>(10 цифр, без кода страны - '7')</i>:</label>
        <input type="text" name="phone" class="form-control" id="phone" placeholder="999999999" required="true">
    </div>
    <div class="form-group" style="display:none">
        <label for="passport"><i class="red">*</i> Серия и номер паспорта:</label>
        <input type="text" name="passport" class="form-control" id="passport" placeholder="4002093230">
    </div>
    <div class="form-group" style="display:none">
        <label for="passport_date"><i class="red">*</i> Дата выдачи паспорта:</label>
        <input type="date" name="passport_date" class="form-control" id="passport_date">
    </div>
    <div class="form-group" style="display:none">
        <label for="birthday"><i class="red">*</i> Дата рождения:</label>
        <input type="date" name="birthday" class="form-control" id="birthday">
    </div>
    <div class="form-group" style="display:none">
        <label for="email"><i class="red">*</i> Email (#):</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group" style="display:none">
        <label for="passwort">Пароль:</label>
        <input type="password" class="form-control" name="passwort" id="passwort">
    </div>
    <div class="form-group" style="display:none">
        <label for="passwort2">Повторите пароль:</label>
        <input type="password" class="form-control" name="passwort2" id="passwort2">
    </div>
    <div class="form-group" style="display:none">
        <label for="passwort"># - Кредитная история будет доступа в личном кабинете пользователя на нашем сайте. Если Вы зарегистрированый пользователь нашего сайта укажите Ваш email, используемый для авторизации. Если Вы являетесь гостем на нашем сайте, то кроме email придумайте пароль, который вмести с адресом электронной почты будет использоваться для доступа к личному кабинету. Внимание после запроса данный отчет будет доступен на нашем сайте в течении 7 дней.</label>
    </div>
    <button type="submit" class="form-btn1 width-100">Далее</button>
</form>