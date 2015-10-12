
  <form class="form-signup" action="/user/register" method="POST">
        <h2 class="form-signin-heading text-center">Форма регистрации</h2>
        <label for="inputEmail" class="sr-only">Логин</label>
        <input type="text" name="login" class="form-control" placeholder="Логин" required="" autofocus="">
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" name="password" class="form-control" placeholder="Пароль" required="">
        <label for="inputPassword" class="sr-only">Повтор пароля</label>
        <input type="password" name="re_password" class="form-control" placeholder="Повторите пароль" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Зарегистрироваться</button>
        <a href="/" class="btn btn-link">< Назад</a>
  </form>