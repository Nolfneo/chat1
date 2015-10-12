<!DOCTYPE html>
<html lang="ru">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <meta name="description" content="<?= $model->description;?>">
   <meta name="keywords" content="<?= $model->keywords;?>">
   <title><?= $model->title;?></title>

</head>

<body>
    <div class="container">
    	<?php include Q_PATH.'/application/views/View_'.$view.'.php'; ?>
    </div>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-theme.min.css"> 
    <link rel="stylesheet" href="/css/style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>