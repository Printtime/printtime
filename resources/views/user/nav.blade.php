

<div class="container ">
<div class="row user">



<nav class="navbar">
  <div class="container">

      <ul class="nav navbar-nav">
        <li{{ Helper::setActive('products') }}><a href="{!! route('products') !!}"><span class="glyphicon glyphicon-shopping-cart"></span> Сделать заказ</a></li>
        <li{{ Helper::setActive('order') }}><a href="{!! route('order.index') !!}"><span class="glyphicon glyphicon-th-list"></span> Мои заказы</a></li>
        <li{{ Helper::setActive('user/profile') }}><a href="{!! route('user.profile') !!}"><span class="glyphicon glyphicon glyphicon-user"></span> Профиль</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
		<li{{ Helper::setActive('pays') }}><a href="{!! route('pays') !!}"><span class="glyphicon glyphicon-stats"></span> История операций</a></li>
		<li{{ Helper::setActive('user/transfer') }}><a href="{!! route('user.transfer') !!}" class="ajax-pay" data-toggle="modal" data-target="#open-modal-pay"><span class="glyphicon glyphicon-transfer"></span> Пополнить баланс</a></li>
      </ul>

  </div>
</nav>




</div>
</div>