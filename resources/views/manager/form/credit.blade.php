  <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="deviceModalLabel">Обновить данные</h4>
            </div>


{!! Form::model($user, ['route' => ['manager.users.credit_update', 'id='.$user->id.'']]) !!}
            <div class="modal-body">

<div class="row">

        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('credit', 'Кредитный лимит в грн.') !!}
                {!! Form::text('credit', null, ['class' => 'form-control', 'required'=>'required']) !!}
            </div>
        </div>
</div>

            </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
              </div>



{!! Form::close() !!}

        </div>