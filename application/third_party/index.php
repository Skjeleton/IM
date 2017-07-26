<html>
<body>

<?php
	require_once '/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
echo "kurwa mac";
$mpdf->WriteHTML('<h1>Hello world!</h1>');
$mpdf->Output();
?>
	
</body>
</html>
