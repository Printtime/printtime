<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Удалить заказ №{{ $order->id}} ?</h4>
    </div>
    <div class="modal-body text-center">
		<div>Удалить заказ <b>{{ $order->title }}</b> полность?</div>
		<hr>
		<div><a href="{{ route('order.trash', [$order->id, 'confirm']) }}" class="btn btn-success">Да</a> <a href="#" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Нет</a></div>  
    </div>
</div>