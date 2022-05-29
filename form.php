<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
    .error {
        border: 2px solid red;
    }
    </style>
    <title>Практика номер 5</title>
</head>

<body>

    <header class="header">
        <div>
            <h1><a href="admin.php" title="Я админ ">Я админ</a></h1>
        </div>
    </header>
    <div class="form">
        <?php
    if (!empty($messages)) {
        print('<div id="messages">');
        foreach ($messages as $message) {
            print($message);
        }
        print('</div>');
    }
    ?>
        <h4>Форма:</h4>
        <form action="index.php" method="POST">
            <p>
                <label>
                    Имя:<br>
                    <input name="name" <?php if ($errors["name"]) {print 'class="error"';} ?>
                        value="<?php print $values["name"]; ?>" />
                </label><br>
            </p>
            <p>
                <label>
                    e-mail:<br>
                    <input name="email" <?php 
                   if ($errors['email'] || $errors['checem']){print "class='error'";}?>
                        value="<?php print $values['email']; ?>" />
                </label><br>
            </p>
            <p>
                <label>
                    Дата рождения:<br>
                    <input name="bthD" type="date" placeholder="yyyy-mm-dd" <?php 
                if ($errors['bthD']) {print 'class="error"' ;} ?> value="<?php print $values['bthD']; ?>" value="Дата">
                </label><br>
            </p>
            <p>
                Пол:<br>
                <label>
                    <input type="radio" checked="checked" name="point1" <?php 
                if ($errors['point1']) {print 'class="error"' ;} 
                if( $values['point1'] == 'man') {print "checked='checked'";}?> value="man">
                    муж</label>
                <label>
                    <input type="radio" name="point1" <?php 
                if ($errors['point1']) {print 'class="error"' ;} 
                if( $values['point1'] == 'woman') {print "checked='checked'";}?> value="woman">
                    жен</label><br>
            </p>
            <p>
                Количество конечностей :<br>
                <label> <input type="radio" checked="checked" name="point2" <?php 
                if ($errors['point2']) {print "checked='checked'" ;} 
                if($values['point2']=='1') {print "checked='checked'";}?> value="1">1</label>

                <label><input type="radio" name="point2" <?php 
                if ($errors['point2']) {print "checked='checked'" ;}                 
                if($values['point2']=='2') {print "checked='checked'";}?> value="2">2</label>

                <label><input type="radio" name="point2" <?php 
                if ($errors['point2']) {print "checked='checked'" ;}
                if($values['point2']=='3') {print "checked='checked'";}?> value="3">3</label>

                <label><input type="radio" name="point2" <?php 
                if ($errors['point2']) {print "checked='checked'" ;}                 
                if($values['point2']=='4') {print "checked='checked'";}?> value="4">4</label>
                <br>
            </p>
            <label>
                Сверхспособности:<br>
                <select name="superpowers[]" multiple="multiple" size="3">
                    <option value="бессмертие" <?php 
                      if($values['sup1']=='бессмертие'){print  "selected='selected'";}
                      ?>>бессмертие</option>
                    <option value="прохождение сквозь стены" <?php 
                      if($values['sup2']=='прохождение сквозь стены'){print  "selected='selected'";}
                      ?>>прохождение сквозь стены</option>
                    <option value="левитация" <?php 
                      if($values['sup3']=="левитация"){print "selected='selected'";}
                      ?>>левитация </option>
                </select>
            </label>
            <p>
                <label>
                    Биография:<br>
                    <textarea name="biograf" <?php 
                if ($errors['biograf']) {print 'class="error"' ;} ?>
                        value="<?php print $values['biograf']; ?>">расскажи о себе</textarea>
                </label><br>
            </p>
            <label>
                С контрактом ознакомлен:
                <input type="checkbox" name="checkk" value="1" <?php 
                if ($values['checkk']=='1') {print "checked='checked'";} ?>><br>
            </label><br>
            <input type="submit" value="Отправить">
            <div>
                <?php
        print'<div>
          <p><a href="login.php">войти</a></p>
         </div>';?>
            </div>
    </div>
    <div class="footer">(с) 2022</div>

</body>

</html>