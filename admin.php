<head>
    <title>Практика номер 6</title>
</head>

<body>
    <?php

/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin') {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

$user = 'u47436';
$passMy = '2041646';
$db = new PDO('mysql:host=localhost;dbname=u47436', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));
$log_admin = $_SERVER['PHP_AUTH_USER'];
$pass_admin = $_SERVER['PHP_AUTH_PW'];

$data = $db->prepare("SELECT admin_pass FROM admin where admin_login = '$log_admin' ");
$data->execute();
$row = $data->fetch(PDO::FETCH_ASSOC);

if ($row == false || $row['admin_pass'] != $pass_admin) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="Invalid login or password"');
  print('<h1>401 Неверный логин или пароль</h1>');
  exit();
}
$bes=0;
$proh=0;
$lev=0;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {  
  $stmt = $db->prepare("SELECT superpower from superpowers");
  $stmt->execute();

  // print('<section>');
  while($sch = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if($sch['superpower']=='бессмертие'){
      $bes+=1;
    }
    if($sch['superpower']=='прохождение сквозь стены'){
      $proh+=1;
    }
    if($sch['superpower']=='левитация'){
      $lev+=1;
    }
  }
  print('Статистика'.'<br>'.'<br>'.'бессмертие = '.''.$bes.'<br>'.
  'прохождение сквозь стены ='.$proh.'<br>'.
  'левитация = '.$lev.'<br>');

  $stmt1 = $db->prepare('SELECT * from form');
  $stmt1->execute();

  $stmt2 = $db->prepare('SELECT superpower FROM superpowers WHERE id = ?');
 
  while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $stmt2->execute([$row['id']]);

          foreach($stmt2 as $pwr){
               if($pwr['superpower']=='бессмертие'){
                    $roww['sup1']= 'бессмертие';
                }
                if($pwr['superpower']=='прохождение сквозь стены'){
                    $roww['sup2']= 'прохождение сквозь стены';
                }
                if($pwr['superpower']=='левитация'){
                    $roww['sup3']= 'левитация';
                }
          }
    if(empty($roww['sup1'])){
      $roww['sup1'] = '';
    }
    if(empty($roww['sup2'])){
      $roww['sup2'] = '';
    }
    if(empty($roww['sup3'])){
      $roww['sup3'] = '';
    }

  include('adf.php');
  $roww=array(
    'sup1'=>'',
    'sup2'=>'',
    'sup3'=>''
  );
  }  
}
else{ 
  if(array_key_exists('update', $_POST)){    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $bthD = $_POST['bthD'];
    $point1 = $_POST['point1'];
    $point2 = $_POST['point2'];
    $biograf = $_POST['biograf'];
    $superpowers = $_POST['superpowers'];
    $id=$_POST['id'];
    $user = 'u47436';
    $passMy = '2041646';
    $db = new PDO('mysql:host=localhost;dbname=u47436', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));
    
    $stmt = $db->prepare('UPDATE form SET name=?, email=?, date=?, gender=?, limbs=?, biograf=? WHERE id = ?');
    $stmt->execute(array($name, $email, $bthD, $point1,$point2, $biograf,$id));

    $stmt2 = $db->prepare('DELETE FROM superpowers WHERE id = ?');
    $stmt2->execute(array($id));

    $stmt3 = $db->prepare('INSERT INTO superpowers SET id = ?, superpower=?');
    foreach ($superpowers as $s)
      $stmt3->execute(array($id,$s));

    header('Location: admin.php');
    exit();
  }
  if(array_key_exists('delete', $_POST)){   
    $user = 'u47436';
    $passMy = '2041646';
    $db = new PDO('mysql:host=localhost;dbname=u47436', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));
    $stmt4 = $db->prepare('DELETE FROM form WHERE id = ?');
    $stmt4->execute([$_POST['id']]);
    $stmt5 = $db->prepare('DELETE FROM superpowers WHERE id = ?');
    $stmt5->execute([$_POST['id']]);
    header('Location: admin.php');
    exit();
  }
}
?>

</body>