{!! $session !!}
<form class="form" action="/login" method="POST" id="login_form">
    <input name="_token" value="{!! csrf_token() !!}" type="hidden">
    <p class="text-center">Вход</p>
    <div class="form-group">
        <label for="email"><i class="red">*</i> Email</label>
        <input class="form-control" placeholder="ivanov@gmail.com" name="email" id="email" type="email" required="true">
    </div>
    <div class="form-group">
        <label for="password"><i class="red">*</i> Пароль</label>
        <input class="form-control" placeholder="Пароль" name="password" id="password" type="password" required="true">
    </div>
    <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LdYqz0UAAAAAPKI1karX0-Gr35D7_MVfO8IN2TD"></div>
    </div>
    <div class="form-group">
        <label for="remember"><input style="vertical-align: -2px;" name="remember" value="1" type="checkbox" id="remember"> Запомнить меня</label>
    </div>
    <div class="form-group">
        <button type="submit" class="form-btn1" style="margin-right: 15px;">Войти</button>
        <a href="/password/reset">Восстановить пароль</a>
    </div>
</form>