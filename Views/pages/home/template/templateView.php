<!DOCTYPE html>
<html>
<head>
	<title>Teste template</title>
</head>
<body>
    <?php $this->view->loadDefaultFrontDependences (); ?>
    <?php /** @var array $viewData */
    echo $viewData ['algo'];  ?>
</body>
</html>