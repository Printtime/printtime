  <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="deviceModalLabel">Обновить данные</h4>
            </div>


{!! Form::model($user, ['route' => ['manager.users.edit_update', 'id='.$user->id.'']]) !!}
            <div class="modal-body">

            <div class="form-group">
                {!! Form::label('name', 'Ф.И.О.') !!}
                {!! Form::text('name', null, ['class' => 'form-control', 'required'=>'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('balance', 'Баланс '.$user->balance.' грн.') !!}
            </div>

            <div class="form-group">
                {!! Form::label('discount', 'Скидка в %') !!}
                {!! Form::text('discount', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('credit', 'Кредитный лимит в грн.') !!}
                {!! Form::text('credit', null, ['class' => 'form-control', 'required'=>'required']) !!}
            </div>

            </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
              </div>



{!! Form::close() !!}

        </div>