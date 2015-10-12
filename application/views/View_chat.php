<div class="wrap">
	<div class="row">
		<h2 class="logo">Green Chat</h2>
		<a href="/user/logout" class="btn btn-danger logout">Выход</a>
		<h3 class="pull-right login-name" >Привет: <?= $_SESSION['login'];?> </h3>
	</div>
	<div class="row chat-box">
		<div class="col-xs-6 col-md-4">
			<h3>Каналы</h3><?if( $model->rank == 1 ) { ?><span><a href="/chat/new">Создать канал +</a></span><? } ?>
			<ul class="list-group">
			<?foreach ($model->data['room'] as $key => $value) { ?>
			  <li class="list-group-item" id="room-<?= $value['id'] ?>" data-id="<?= $value['id'] ?>" data-name="<?= $value['Name'] ?>">
			    <span class="badge"><? //if(isset($value['Count']) && $value['Count']>0) echo $value['Count']; ?></span>
			    <?= $value['Name'] ?>
			    <?if( $model->rank == 1 ) { ?><a class="pull-right" href="/chat/delete_room/<?= $value['id']?>">X</a> <? } ?>
			  </li>
			<? } ?>
			</ul>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-8">
			
			<h4 class="title_room"></h4>
			<div class="chat">
				<div class="select">
					<h4>Выберете комнату</h4>
					<img src="/img/left.png" width="50px" />
				</div>
				<div class="box">
				<div class="message">

				</div>
					<form id="send">
					<a hre="#" onClick="send_to(0, 'Всем')">Написать всем</a>
					<div class="input-group">
						<span class="input-group-addon" id="reader" data-reader="0">Всем: </span>
					  <input type="text" class="form-control" id="text" aria-describedby="basic-addon3">
					  <span class="input-group-btn">
				        <button class="btn btn-default" type="button">Отправить</button>
				      </span>	
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>