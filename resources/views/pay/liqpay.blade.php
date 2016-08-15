@extends('layouts.app')

@section('content')

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-12 text-center">

<div class="well well-lg">
<p>Для пополнение баланса на сумму {!! $request->amount !!} грн. и выбора метода оплаты нажмите кнопку оплатить.</p>
{!! $form !!}
</div>

</div>
</div>
</div>

@endsection


