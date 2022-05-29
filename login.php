<?php


header('Content-Type: text/html; charset=UTF-8');

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

if (!empty($_SESSION['login'])) {
  
  header('Location: index.php');
  
}else{
?>

<form action="login.php" method="post">
    <input name="login" />
    <input name="pass" />
    <input type="submit" value="Войти" />
</form>
<?php
}
}
else {
  $user = 'u47508';
  $pass = '1199006';
  $db = new PDO('mysql:host=localhost;dbname=u47508', $user, $pass, array(PDO::ATTR_PERSISTENT => true));

  $passLogin = $_POST['pass'];
  $logLogin = $_POST['login'];

  $data = $db->prepare("SELECT pass FROM form where login = '$logLogin' ");
  $data->execute();
  $pas = $data->fetch(PDO::FETCH_ASSOC);

  if($pas['pass']!=$_POST['pass'] and $pas['login']!=$_POST['login']){     
    exit ("Логин или email не существует"); 
  }
  else{
      $_SESSION['login'] =  $logLogin;
      $_SESSION['pass'] =  $passLogin;
      $_SESSION['id'] = $pas['id'];

      echo 'вы успешно вошли';
    header('Location: index.php');
  }
    
}
?>