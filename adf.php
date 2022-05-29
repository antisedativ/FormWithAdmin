<form action="admin.php" method="POST">
    <input type="hidden" name="id" value="<?php print $row["id"]; ?>" /> <br>
    <div>id <?php print $row["id"]; ?></div>
    <p>
        <label>
            Имя:<br>
            <input name="name" value="<?php print $values["name"]; ?>" />
        </label><br>
    </p>
    <p>
        <label>
            e-mail:<br>
            <input name="email" value="<?php print $values['email']; ?>" />
        </label><br>
    </p>
    <p>
        <label>
            Дата рождения:<br>
            <input name="bthD" type="date" placeholder="yyyy-mm-dd" value="<?php print $row['date']; ?>" value="Дата">
        </label><br>
    </p>
    <p>
        Пол:<br>
        <label>
            <input type="radio" checked="checked" name="point1" <?php 
                if( $row['gender'] == 'man') {print "checked='checked'";}?> value="man">
            муж</label>
        <label>
            <input type="radio" name="point1" <?php 
                if( $row['gender'] == 'woman') {print "checked='checked'";}?> value="woman">
            жен</label><br>
    </p>
    <p>
        Количество конечностей :<br>
        <label> <input type="radio" checked="checked" name="point2" <?php 
                if($row['limbs']=='1') {print "checked='checked'";}?> value="1">1</label>

        <label><input type="radio" name="point2" <?php 
                if($row['limbs']=='2') {print "checked='checked'";}?> value="2">2</label>

        <label><input type="radio" name="point2" <?php 
                if($row['limbs']=='3') {print "checked='checked'";}?> value="3">3</label>

        <label><input type="radio" name="point2" <?php 
                if($row['limbs']=='4') {print "checked='checked'";}?> value="4">4</label>
        <br>
    </p>
    <label>
        Сверхспособности:<br>
        <select name="superpowers[]" multiple="multiple" size="3">
            <option value="бессмертие" <?php 
                      if($roww['sup1']=='бессмертие'){print  "selected='selected'";}
                      ?>>бессмертие</option>
            <option value="прохождение сквозь стены" <?php 
                      if($roww['sup2']=='прохождение сквозь стены'){print  "selected='selected'";}
                      ?>>прохождение сквозь стены</option>
            <option value="левитация" <?php 
                      if($roww['sup3']=="левитация"){print "selected='selected'";}
                      ?>>левитация </option>
        </select>
    </label>
    <p>
        <label>
            Биография:<br>
            <textarea name="biograf" value="<?php print $row['biograf']; ?>">расскажи о себе</textarea>
        </label><br>
    </p>
    <br>
    <!-- <label>Введите id пользователя которого хотите изменить<input name='id' value=""></label><br> -->
    <input type="submit" value="Изменить" name="update" />
    <input type="submit" value="Удалить" name="delete" />
</form>