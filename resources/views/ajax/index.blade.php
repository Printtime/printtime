<div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Отправить запрос на просчет</h3>
        </div>
        <div class="panel-body">
                 <form method="POST" action="/ajax" data-async="">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email"  name="email" placeholder="Введите email" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Телефон</label>
                    <input required type="text" placeholder="+380" name="phone" id="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input type="text" name="comment"  class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="submit form-control btn btn-success" value="Отправить">
                </div>
            </form>
        </div>
    </div>