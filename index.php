<?php
header('Content-Type: text/html; charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {  
    $messages = array();
	if (!empty($_COOKIE['save'])) {
      setcookie('save', '', 100000);
      setcookie('login', '', 100000);
      setcookie('pass', '', 100000);
    	$messages[] = '<div>Данные сохранены</div><br\>';

        if (!empty($_COOKIE['pass'])) {
            $messages[] = sprintf('войдите <a href="login.php">войти</a> с логином <strong>%s</strong>
              и паролем <strong>%s</strong> для изменения данных.',
              strip_tags($_COOKIE['login']),
              strip_tags($_COOKIE['pass']));
          }
        }

    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['bthD'] = !empty($_COOKIE['bthD_error']);
    $errors['point1'] = !empty($_COOKIE['point1_error']);
    $errors['point2'] = !empty($_COOKIE['point2_error']);
    $errors['biograf'] = !empty($_COOKIE['biograf_error']);
    $errors['checkk'] = !empty($_COOKIE['checkk_error']);
    $errors['checnam'] = !empty($_COOKIE['checnam_error']);
    $errors['checem'] = !empty($_COOKIE['checem_error']);
    $errors['checdat'] = !empty($_COOKIE['checkk_error']);


    if ($errors['name']) {
        setcookie('name_error', '', 100000);
        $messages[] = '<div class="error">Введите имя</div>';
    }
    if ($errors['checnam']) {
        setcookie('checnam_error', '', 100000);
        $messages[] = '<div class="error">Введите русскими буквами</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', 100000);
        $messages[] = '<div class="error">Введите email</div>';
    }
    if ($errors['checem']) {
        setcookie('checem_error', '', 100000);
        $messages[] = '<div class="error">Введите E-mail вида: test@example.com</div>';
    }
    if ($errors['bthD']) {
        setcookie('bthD_error', '', 100000);
        $messages[] = '<div class="error">Введите email</div>';
    }
    if ($errors['point2']) {
        setcookie('point2_error', '', 100000);
        $messages[] = '<div class="error">Введите кол-во конечностей</div>';
    }
    if ($errors['point1']) {
        setcookie('point1_error', '', 100000);
        $messages[] = '<div class="error">Введите пол</div>';
    }
    if ($errors['biograf']) {
        setcookie('biograf_error', '', 100000);
        $messages[] = '<div class="error">Введите биографию</div>';
    }
    if ($errors['checkk']) {
        setcookie('checkk_error', '', 100000);
        $messages[] = '<div class="error">Примите условие</div>';
    }

    $values = array();

    $values['name'] = empty($_COOKIE['name_value']) ? ' ' : strip_tags($_COOKIE['name_value']);
    $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
    $values['bthD'] = empty($_COOKIE['bthD_value']) ? '' : strip_tags($_COOKIE['bthD_value']);
    $values['point1'] = empty($_COOKIE['point1_value']) ? '' : strip_tags($_COOKIE['point1_value']);
    $values['point2'] = empty($_COOKIE['point2_value']) ? '' : strip_tags($_COOKIE['point2_value']);
    $values['sup1']=empty($_COOKIE['sup1_value']) ? '' : strip_tags($_COOKIE['sup1_value']);
    $values['sup2']=empty($_COOKIE['sup2_value']) ? '' : strip_tags($_COOKIE['sup2_value']);
    $values['sup3']=empty($_COOKIE['sup3_value']) ? '' : strip_tags($_COOKIE['sup3_value']);   
    $values['superpowers'] = empty($_COOKIE['superpowers_value']) ? '' : strip_tags($_COOKIE['superpowers_value']);
    $values['biograf'] = empty($_COOKIE['biograf_value']) ? '' : strip_tags($_COOKIE['biography_value']);
    $values['checkk'] = empty($_COOKIE['checkk_value']) ? '' : strip_tags($_COOKIE['checkk_value']);

    if (empty($errors) && !empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
        try {
            $user = 'u47508';
            $passMy = '1199006';
            $db = new PDO('mysql:host=localhost;dbname=u47508', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));
            $log = $_SESSION['login'];
            $passForm = $_SESSION['pass'];
            $stmt  = $db->query("SELECT * FROM form where id = ? ");  
            $stmt->execute([$_SESSION['id']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
              $values['name'] = $row['name'];
              $values['email'] = $row['email'];
              $values['bthD'] = $row['bthD'];
              $values['sup1']= $row['sup1'];
              $values['sup2']= $row['sup2'];
              $values['sup3']= $row['sup3'];
              $values['point1'] = $row['point1'];
              $values['point2'] = $row['point2'];
              $values['biograf'] = $row['biograf'];
              $values['checkk'] =$row['checkk'];
            
            $stmt  = $db->query("SELECT superpower FROM superpowers where id = ?");  

            $stmt1->execute([$_SESSION['id']]);
            $stmt2=$stmt1->fetchALL();
           
            for($i=0;$i<4;$i++){

                if($stmt2[$i]['superpower']=='бессмертие'){
                    $values['sup1']= 'бессмертие';
                }
                if($stmt2[$i]['superpower']=='прохождение сквозь стены'){
                    $values['sup2']= 'прохождение сквозь стены';
                }
                if($stmt2[$i]['superpower']=='левитация'){
                    $values['sup3']= 'левитация';
                }
            }
            } catch(PDOException $e) {
              echo 'Ошибка: ' . $e->getMessage();
          }
    printf('Вход с логином %s,', $_SESSION['login']);
    }


  include('form.php');
}
else{
    $errors = FALSE;

    if (!preg_match("/^[а-я А-Я]+$/u",$_POST['name'])or(empty($_POST['name']))){
        setcookie('checnam_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('name_value', $_POST['name'], time() + 365 * 24 * 60 * 60);
    }
    if (!preg_match("/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/",$_POST['email'])or(empty($_POST['email']))){
        setcookie('checem_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('email_value', $_POST['email'], time() + 365 * 24 * 60 * 60);
    }
    if (empty($_POST['bthD'])) {
        setcookie('bthD_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('bthD_value', $_POST['bthD'], time() + 365 * 24 * 60 * 60);
    }
    if (empty($_POST['point1'])) {
        setcookie('point1_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('point1_value', $_POST['point1'], time() + 365 * 24 * 60 * 60);
    }
    if (empty($_POST['point2'])) {
        setcookie('point2_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('point2_value', $_POST['point2'], time() + 365 * 24 * 60 * 60);
    }
    if (empty($_POST['superpowers'])) {
        setcookie('superpowers_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        $superpower = implode(',',$_POST['superpowers']);
        $sup=explode(',',$superpower);
        
        $array = array(
            "sup1_value" => 0,
            "sup2_value" => 0,
            "sup3_value" => 0,
        );
        if(!empty($sup[0])){
            if($sup[0]=='бессмертие')
            {
                setcookie('sup1_value', 'бессмертие', time() + 365 * 24 * 60 * 60);
                $array['sup1_value']=1;
            }
            if($sup[0]=='прохождение сквозь стены')
            {
                setcookie('sup2_value', 'прохождение сквозь стены', time() + 365 * 24 * 60 * 60);
                $array['sup2_value']=1;
            }
            if($sup[0]=='левитация')
            {
                setcookie('sup3_value', 'левитация', time() + 365 * 24 * 60 * 60);
                $array['sup3_value']=1;
            }
        }
        if(!empty($sup[1])){
            if($sup[1]=='бессмертие')
            {
                setcookie('sup1_value', 'бессмертие', time() + 365 * 24 * 60 * 60);
                $array['sup1_value']=1;
            }
            if($sup[1]=='прохождение сквозь стены')
            {
                setcookie('sup2_value', 'прохождение сквозь стены', time() + 365 * 24 * 60 * 60);
                $array['sup2_value']=1;
            }
            if($sup[1]=='левитация')
            {
                setcookie('sup3_value', 'левитация', time() + 365 * 24 * 60 * 60);
                $array['sup3_value']=1;
            }
        }
        if(!empty($sup[2])){
            if($sup[2]=='бессмертие')
            {
                setcookie('sup1_value', 'бессмертие', time() + 365 * 24 * 60 * 60);
                $array['sup1_value']=1;
            }
            if($sup[2]=='прохождение сквозь стены')
            {
                setcookie('sup2_value', 'прохождение сквозь стены', time() + 365 * 24 * 60 * 60);
                $array['sup2_value']=1;
            }
            if($sup[2]=='левитация')
            {
                setcookie('sup3_value', 'левитация', time() + 365 * 24 * 60 * 60);
                $array['sup3_value']=1;
            }
        }
        foreach($array as $key => $val){ 
            if($val==0){
                setcookie($key,'',100000);
            } 
        } 
    }    
    if (empty($_POST['checkk'])) {
        setcookie('checkk_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    }
    else{
        setcookie('checkk_value', $_POST['checkk'], time() + 365 * 24 * 60 * 60);
    }

    if ($errors) {
        header('Location: index.php');
        exit();
    }

    else {
        setcookie('name_error', '', 100000);
        setcookie('checnam_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('checem_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('point1_error', '', 100000);
        setcookie('point2_error', '', 100000);
        setcookie('biograf_error', '', 100000);
        setcookie('checkk_error', '', 100000);
    }
    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $bthD = $_POST['bthD'];
        $point1 = $_POST['point1'];
        $point2 = $_POST['point2'];
        $superpowers = implode(',',$_POST['superpowers']);
        $sup=explode(',',$superpower);
        $biograf = $_POST['biograf'];
        $checkk = $_POST['checkk'];

        $user = 'u47508';
        $passMy = '1199006';
        $db = new PDO('mysql:host=localhost;dbname=u47508', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));
        $logForm = $_SESSION['login'];
        $passForm = $_SESSION['pass'];
        $user_id = $db->lastInsertId();

        try {
            $stmt = $db->prepare("UPDATE form SET 'name'=$name,'email'=$email,
            'bthD'=$bthD,'point1'=$point1,
            'point2'=$point2,'biograf'=$biograf,'checkk'=$checkk 
            where login = '$logForm' AND pass='$passForm'");
      
            $stmt -> execute();
            $user_id = $db->lastInsertId();


            if(!empty( $sup[0])){
                $stmt = $db->prepare("UPDATE superpower SET 'id'=$user_id,'superpowers'=$sup[0] where login = '$logForm' AND pass='$passForm'");
                $stmt->execute();
            }
        
            if(!empty( $sup[1])){
                $stmt = $db->prepare("UPDATE superpower SET 'id'=$user_id,'superpowers'= $sup[1] where login = '$logForm' AND pass='$passForm'");
                $stmt->execute();
            }
        
            if(!empty( $sup[2])){
                $stmt = $db->prepare("UPDATE superpower SET 'id'=$user_id,'superpowers'= $sup[2] where login = '$logForm' AND pass='$passForm'");
                $stmt->execute();
            }
            $stmt -> execute();
            print ('Спасибо, результаты сохранены.<br/>');
          }
          catch(PDOException $e){
            print('Error : ' . $e->getMessage());
            exit();
          }
    }
    else{
        $login = uniqid();
        $paddHash=rand(1,3);
        $passX = substr(md5($paddHash),0,8);
        setcookie('login', $login);
        setcookie('pass', $passX);

        $name = $_POST['name'];
        $email = $_POST['email'];
        $bthD = $_POST['bthD'];
        $point1 = $_POST['point1'];
        $point2 = $_POST['point2'];
        $superpowers = implode(',',$_POST['superpowers']);
        $sup=explode(',',$superpower);
        $biograf = $_POST['biograf'];
        $checkk = $_POST['checkk'];

        $user = 'u47508';
        $passMy = '1199006';
        $db = new PDO('mysql:host=localhost;dbname=u47508', $user, $passMy, array(PDO::ATTR_PERSISTENT => true));
       
        try {
            $stmt = $db->prepare("INSERT INTO form (name,email,date,gender,limbs,biograf,
            agree,hash,login,pass)".
            " VALUES(:name,:email,:bthD,:point1,:point2,:biograf,:checkk,:hash,:login,:pass)");
      
            $stmt -> execute(array('name'=>$name,'email'=>$email,'bthD'=>$bthD,'point1'=>$point1,
            'point2'=>$point2,'biograf'=>$biograf,'checkk'=>$checkk,'hash'=> $paddHash,
            'login'=> $login,'pass'=>$passX));
            $user_id = $db->lastInsertId();

            if(!empty( $sup[0])){
                $stmt = $db->prepare("INSERT INTO superpowers SET id = ?, superpower = ? ,login=?,pass=?");
                $stmt->execute(array($user_id,$sup[0],$login,$passX));
            }
            if(!empty( $sup[1])){
                $stmt = $db->prepare("INSERT INTO superpowers SET id = ?, superpower = ?,login=?,pass=?");
                $stmt->execute(array($user_id,$sup[1],$login,$passX));
            }
            if(!empty( $sup[2])){
                $stmt = $db->prepare("INSERT INTO superpowers SET id = ?, superpower = ?,login=?,pass=?");
                $stmt->execute(array($user_id,$sup[2],$login,$passX));
            }
            print ('Спасибо, результаты сохранены.<br/>');
          }
          catch(PDOException $e){
            print('Error : ' . $e->getMessage());
            exit();
          }
    }
    
    setcookie('save', '1');
    header('Location: index.php');
}

?>