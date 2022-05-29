<!-- name="name" value="<?php print $line["name"]; ?>" -->
<?php 
 $line["name"]=$row["name"];
 echo
'<form action="adf.php" method="POST">'.
'<p>'.
' <div>'.'id'.
'<input type="hidden" name="id" value='.print $row["id"].
'</div>'.'<br>'.
' <div>'.'name'.
'<div type="hidden" name="name" value='. print $row["name"].' | '.

' <div>'.'email'.
'<div type="hidden" email="email" value='. print $row["email"].' | '.

' <div>'.'Дата рождения:'.
'<div type="hidden" name="bthD" type="date" placeholder="yyyy-mm-dd"
 value='. print $row['date'].'| '.

' <div>'.'gender'.
'<div type="hidden" name="point1" value='. print $row["gender"].' | '.

' <div>'.'limbs'.
'<div type="hidden" name="point2" value='. print $row["limbs"].' | '.

// ' <div>'.'name'.
// '<div type="hidden" name="name" value='. print $row["name"].' | '.

// ' <div>'.'name'.
// '<div type="hidden" name="name" value='. print $row["name"].' | '.

 'limbs = '.$row['limbs'].' | '.
 'бессмертие = '.$roww['sup1'].' | '.
 'прохождение сквозь стены = '.$roww['sup2'].' | '.
 'левитация = '.$roww['sup3'].' | '.
 'biograf = '.$row['biograf'].'</p>'.
 '<input  type="submit" value="Изменить" name="update" />'.
 '</form>';
 ?>