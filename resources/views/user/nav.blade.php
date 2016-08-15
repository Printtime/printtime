

<div class="container ">
<div class="row user">



<nav class="navbar">
  <div class="container">

      <ul class="nav navbar-nav">
        <li><a href="/user"><span class="glyphicon glyphicon-shopping-cart"></span> Сделать заказ</a></li>
        <li class="active"><a href="/user"><span class="glyphicon glyphicon-th-list"></span> Мои заказы</a></li>
        <li><a href="#"><span class="glyphicon glyphicon glyphicon-user"></span> Профиль</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
		<li><a href="#"><span class="glyphicon glyphicon-stats"></span> История операций</a></li>
		<li><a href="{!! route('user.transfer') !!}" class="ajax-pay" data-toggle="modal" data-target="#open-modal-pay"><span class="glyphicon glyphicon-transfer"></span> Пополнить баланс</a></li>
      </ul>

  </div>
</nav>




</div>
</div>