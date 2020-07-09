<?php
$submitPressed=filter_input(INPUT_POST,'submit');
if (isset($submitPressed)){
    $name=filter_input(INPUT_POST,"isi");
    $link=mysqli_connect('localhost','root','','pwl20194','3306') or die(mysqli_connect_error());
    $query='INSERT INTO category(name) VALUES (?)';
    mysqli_autocommit($link,false);
    if($stmt=mysqli_prepare($link,$query)){
        mysqli_stmt_bind_param($stmt,'s',$name);
        mysqli_stmt_execute($stmt) or die (mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<table>
    <form action="" method="POST">
        <input type="text" class="form-control" name="isi" placeholder="Input..">
        <input type="submit" name="submit" value="masuk">
    </form>
    <thead>
    <tr>
        <th>
            ID
        </th>
        <th>
            Name
        </th>
    </tr>
    </thead>
    <tbody><?php

$link = mysqli_connect('localhost','root','','pwl20194','3306') or die(mysqli_connect_error());
$query = 'SELECT * FROM category';
if($result= mysqli_query($link,$query) or die(mysqli_error($link))){
    while ($row=mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>'.$row['id'] .'</td>';
        echo '<td>'.$row['name'] .'</td>';
        echo '</tr>';

    }
}
?>
    </tbody>
</table>