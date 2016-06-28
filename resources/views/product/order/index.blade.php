
<div class="modal-content">

      <form method="POST" action="{{ route('product.orderSend', ['product'=>$product]) }}" data-async="">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Отправить запрос на просчет</h4>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email"  name="email" placeholder="Введите email" value="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Телефон</label>
                    <input required="required" type="text" placeholder="+380" name="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label>Комментарий</label>
                    <input type="text" name="comment"  class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" class="submit form-control btn btn-success" value="Отправить">
                </div>
      </div>

      </form>

    </div>