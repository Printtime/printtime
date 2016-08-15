
<div class="modal-content">

      <form method="POST" action="{{ route('pay.create') }}">
      {{ csrf_field() }}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Пополнение баланса</h4>
      </div>
      <div class="modal-body">
                <div class="form-group">
				<div class="input-group">
				  <span class="input-group-addon">Сумма пополнения</span>
				  <input required name="amount" type="number" class="form-control" aria-label="Сумма (в гривне)" min="0" value="" max="5000" step="10" placeholder="0.00">
				  <span class="input-group-addon"> грн.</span>
				</div>
				</div>
                <div class="form-group">
                    <input type="submit" class="form-control btn btn-success" value="Пополнить счет">
                </div>
      </div>

      </form>

    </div>