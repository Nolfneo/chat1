<div class="wrap">
	<div class="row">
		<h2 class="logo">Green Chat</h2>
		<a href="/user/logout" class="btn btn-danger logout">Выход</a>
	</div>
	<div class="row chat-box">
		<div class="col-xs-6 col-md-4">
		<form action="/chat/create" method="POST">
			<input type="text" name="name" required placeholder="Название комнаты">
			<ul class="list-group">
			<?foreach ($model->data['users'] as $key => $value) { ?>
			  <li class="list-group-items" data-id="<?= $value['id'] ?>" data-name="<?= $value['Name'] ?>">
			    <?= $value['Login'] ?>
			    <input type="checkbox" id="<?= $value['Id'] ?>" name="id_user[]" value="<?= $value['Id'] ?>" class="pull-right">
			  </li>
			<? } ?>
			</ul>
			<button class="btn btn-success" type="submit">Создать</button>
		</form>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-8">

		</div>
	</div>
</div>