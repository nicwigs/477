<?php
require_once "lib/enigma.inc.php";
$view = new Enigma\EnigmaView($system);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>The Endless Enigma</title>
    <?php echo $view->head(); ?>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="site.con.js"></script>
    <script>
        $(document).ready(function() {
            new Buttons("form");
        });
    </script>
</head>

<body>
<?php
echo $view->present();
?>
</body>
</html>
