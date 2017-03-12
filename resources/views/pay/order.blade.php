
<div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Списание с баланса</h4>
      </div>
      <div class="modal-body text-center">
                <div>Оплатить заказ №{{ $order->id }} ({{ $order->title }}) на сумму {{ $order->sum }} грн. ?</div>
                <hr>
                <div><a href="{{ route('pay.orderPay', [$order->id, 'confirm']) }}" class="btn btn-success">Да</a> <a href="#" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Нет</a></div>
                
      </div>
      </div>

