<?php

$name = $_POST['name'];
$email = $_POST['email'];
$bthD = $_POST['bthD'];
$point1 = $_POST['point1'];
$point2 = $_POST['point2'];
$biograf = $_POST['biograf'];
$id=$_POST['id'];
$user = 'u47508';
$passMy = '1199006';
$db = new PDO('mysql:host=localhost;dbname=u47508', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));

$stmt = $db->prepare('UPDATE form SET name=?, email=?, date=?, gender=?, limbs=?, biograf=? WHERE id = ?');
$stmt->execute(array($name, $email, $bthD, $point1,$point2, $biograf,$id));

header('Location: admin.php');
exit();

?>
© 2022 GitHub, Inc.