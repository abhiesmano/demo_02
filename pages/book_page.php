
<?php
$submitPressed=filter_input(INPUT_POST,'submit');
if (isset($submitPressed)){
    $isbn=filter_input(INPUT_POST,"isbn");
    $title=filter_input(INPUT_POST,"title");
    $author=filter_input(INPUT_POST,"author");
    $pub=filter_input(INPUT_POST,"publisher");
    $desc=filter_input(INPUT_POST,"desc");
    $cover=filter_input(INPUT_POST,"cover");
    $idcat=filter_input(INPUT_POST,"idcat");
    $link=mysqli_connect('localhost','root','','pwl20194','3306') or die(mysqli_connect_error());
    $query='INSERT INTO book(isbn,title,author,publisher,description,cover,category_id) VALUES (?,?,?,?,?,?,?)';
    mysqli_autocommit($link,false);
    if($stmt=mysqli_prepare($link,$query)){
        mysqli_stmt_bind_param($stmt,'ssssssi',$isbn,$title,$author,$pub,$desc,$cover,$idcat);
        mysqli_stmt_execute($stmt) or die (mysqli_error($link));
        mysqli_commit($link);
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>
<table>
    <form action="" method="POST">
        <input type="text" class="form-control" name="isbn" placeholder="Masukkan ISBN....">
        <input type="text" class="form-control" name="title" placeholder="Masukkan Title....">
        <input type="text" class="form-control" name="author" placeholder="Masukkan Author....">
        <input type="text" class="form-control" name="publisher" placeholder="Masukkan Publisher....">
        <input type="text" class="form-control" name="desc" placeholder="Masukkan Description....">
        <input type="text" class="form-control" name="cover" placeholder="Masukkan Cover....">
        <input type="text" class="form-control" name="idcat" placeholder="Masukkan ID Category....">
        <input type="submit" name="submit" value="masuk">
    </form>
    <thead>
    <tr>
        <th>ISBN</th>
        <th>TITLE</th>
        <th>AUTHOR</th>
        <th>PUBLISHER</th>
        <th>DESCRIPTION</th>
        <th>COVER</th>
        <th>ID CATEGORY</th>
    </tr>
    </thead>
    <tbody>
    <?php

    $link = mysqli_connect('localhost','root','','pwl20194','3306') or die(mysqli_connect_error());
    $query = 'SELECT * FROM book';
    if($result= mysqli_query($link,$query) or die(mysqli_error($link))){
        while ($row=mysqli_fetch_array($result)){
            echo '<tr>';
            echo '<td>'.$row['isbn'] .'</td>';
            echo '<td>'.$row['title'] .'</td>';
            echo '<td>'.$row['author'] .'</td>';
            echo '<td>'.$row['publisher'] .'</td>';
            echo '<td>'.$row['description'] .'</td>';
            echo '<td>'.$row['cover'] .'</td>';
            echo '<td>'.$row['category_id'] .'</td>';
            echo '</tr>';

        }
    }
    ?>
    </tbody>
</table>