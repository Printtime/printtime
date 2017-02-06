  <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="deviceModalLabel">Управление счетом</h4>
            </div>


{!! Form::model($user, ['route' => ['manager.pay.create', 'id='.$user->id.'']]) !!}

<div class="modal-body">


            <div class="form-group">
                {!! Form::label('balance', 'Текущий баланс '.$user->balance.' грн.') !!}
            </div>


            <div class="form-group">
                {!! Form::label('amount', 'Сумма в грн.') !!}
                {!! Form::text('amount', '0.00', ['class' => 'form-control amount', 'required'=>'required']) !!}
            </div>

            <div class="form-group">
                <label><input type="radio" class="type" name="type" id="buy" value="buy"> Зачислить</label>
                <label><input type="radio" class="type" name="type" id="sell" value="sell"> Списать</label>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Описание платежа') !!}
                {!! Form::textarea('description', '', ['class'=>'form-control description', 'required'=>'required', 'rows'=>'3']) !!}
            </div>
 </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                {!! Form::submit('Выполнить', ['class' => 'btn btn-success']) !!}
              </div>

<script type="text/javascript">
(function ($) {

function genDescription() {

    amount = $('.amount').val();

	if ($('#buy').prop("checked")) {
                $('.description').html('Зачисление '+amount+' грн., пополнение баланса в центральном офисе');
	}
	if ($('#sell').prop("checked")) {
                $('.description').html('Списание '+amount+' грн., по заказу от ...');
	}
}

$("input[name='type']").change(function(){
    event.preventDefault();
	genDescription(event);
});

$('.amount').keyup(function() {  genDescription(); });
$('.amount').change(function() { genDescription(); });


})(jQuery);
</script>


{!! Form::close() !!}

        </div>