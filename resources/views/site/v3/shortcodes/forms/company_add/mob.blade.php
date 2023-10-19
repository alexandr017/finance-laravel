<form class="form" id="company_add">
    <h2>Добавить организацию</h2>
    <div class="form-group">
        <label for="name"><i class="red">*</i> Имя:</label>
        <input type="text" name="name" class="form-control" id="name" placeholder="Иван" required="true">
    </div>
    <div class="form-group">
        <label for="email"><i class="red">*</i> E-Mail:</label>
        <input type="email" name="email" class="form-control" id="email" placeholder="ivanov@mail.ru" required="true">
    </div>
    <div class="form-group">
        <label for="comment">Подобное описание предложения:</label>
        <textarea name="comment" class="form-control" id="comment" rows="8"></textarea>
    </div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LdYqz0UAAAAAPKI1karX0-Gr35D7_MVfO8IN2TD"></div>
    </div>
    <div class="form-group">
        <label for="checkbox1"><input type="checkbox" checked="true" name="checkbox1" id="checkbox1" required="true"> <i class="red">*</i> Я согласен на обработку моих персональных данных</label>
    </div>
    <div class="form-group">
        <label for="checkbox2"><input type="checkbox" checked="true" name="checkbox2" id="checkbox2" required="true"> <i class="red">*</i> Я согласен с <a href="/rules">условиями</a> предоставления услуг</label>
    </div>
    <button type="submit" class="form-btn1">Отправить</button>
</form>