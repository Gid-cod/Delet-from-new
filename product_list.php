<?php
require ('connect.php')
?>

  <?php
  if (isset($_POST["Name"])) {
      //Если это запрос на обновление, то обновляем
      if (isset($_GET['red_id'])) {
          $result = $connect->query("UPDATE `products` SET `Name` = '{$_POST['Name']}',`Price` = '{$_POST['Price']}' WHERE `ID`={$_GET['red_id']}");
      } else {
          //Иначе вставляем данные, подставляя их в запрос
          $result = $connect->query("INSERT INTO `products` (`Name`, `Price`) VALUES ('{$_POST['Name']}', '{$_POST['Price']}')");
      }
  }
  //Если вставка прошла успешно
  if ($connect) {
      echo '<p>Успешно!</p>';
  } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($connect) . '</p>';
  }
  if (isset($_GET['del_id'])) { //проверяем, есть ли переменная
      //удаляем строку из таблицы
      $result = $connect->query( "DELETE FROM `products` WHERE `ID` = {$_GET['del_id']}");
      if ($connect) {
          echo "<p>Товар удален.</p>";
      } else {
          echo '<p>Произошла ошибка: ' . mysqli_error($connect) . '</p>';
      }
  }
  if (isset($_GET['red_id'])) {
      $result = $connect->query( "SELECT `ID`, `Name`, `Price` FROM `products` WHERE `ID`={$_GET['red_id']}");
      $product = mysqli_fetch_array($result);
  }
  ?>
  <form action="" method="post" >
    <table>
        <tr>
            <td>Наименование:</td>
            <td><input type="text" name="Name" value="<?= isset($_GET['red_id']) ? $product['Name'] : ''; ?>"></td>
        </tr>
        <tr>
            <td>Цена:</td>
            <td><input type="text" name="Price" size="3" value="<?= isset($_GET['red_id']) ? $product['Price'] : ''; ?>"> руб.</td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="OK"></td>
        </tr>
    </table>
</form>
<table border='1'>
    <tr>
        <td>Идентификатор</td>
        <td>Наименование</td>
        <td>Цена</td>
        <td>Удаление</td>
        <td>Редактирование</td>
    </tr>

<?php
    $result = $connect->query( "SELECT `ID`, `Name`, `Price` FROM `products`");
    while ($connect =mysqli_fetch_array($result)) {
        echo '<tr>' .
            "<td>{$connect['ID']}</td>" .
            "<td>{$connect['Name']}</td>" .
            "<td>{$connect['Price']} ₽</td>" .
            "<td><a href='?del_id={$connect['ID']}'>Удалить</a></td>" .
            "<td><a href='?red_id={$connect['ID']}'>Изменить</a></td>" .
            '</tr>';
    }
    ?>
</table>
<p><a href="index.php">Назад</a></p>

