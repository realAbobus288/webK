<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Строительная фирма "У Костика"</title>
    <link rel="stylesheet" href="css.css">

    <style>
        .b1 {
            height: 100%;
            width: 100%;
            border: 0px;
            background: white;
        }

        .b1:hover {
            background-color: #DCDCDC;
        }

        .main {
            height: 40px;
            width: 100%;
            background: white;
        }

        .works {
            border: 1px solid black;
        }

        table {
            margin: 0 auto;
            background: none;
            text-align: center;
        }

        img {
            float: center;
        }

        body {
            background: #E6E6FA;
        }

        h1 {
            text-align: center;
        }
        .mail{
            position: absolute;
            margin: 2% 75% ;
        }
    </style>

</head>

<body>

    <?php include ("mainTable.php");
    session_start();
    ?>

    <?php
    if (isset($_POST['update'])) {
        $_SESSION['userName'] = $_POST['name'];
        include ("Setup.php");
        $query = mysqli_query($mysqli, "UPDATE polzovatel 
        SET Surname = '$_POST[surn]', 
        Login = '$_POST[login]', 
        Password = '$_POST[pass]', 
        Phone= '$_POST[phone]',
         Email= '$_POST[email]', 
         Name = '$_POST[name]', 
         Patronymic = '$_POST[patr]'
        WHERE Code_polz = $_SESSION[userID]");
    }
    ?>

    <?php
    if (isset($_POST['oformAll'])){
        $date = date('Y-m-d H:i:s');
        include ("Setup.php");
        $query = mysqli_query($mysqli, "UPDATE zakaz 
        SET Date_offirm = '$date', 
        Code_sost = 1, 
        Code_brig = 1, 
        Code_rab = 1
        WHERE Code_polz = $_SESSION[userID] AND Date_offirm IS NULL");
        mysqli_close($mysqli);
    }
    if (isset($_POST['deleteAll'])) {
        include ("Setup.php");
        $query = mysqli_query($mysqli, "DELETE FROM zakaz WHERE Code_polz = $_SESSION[userID] AND Date_offirm IS NULL");
        mysqli_close($mysqli);
    }

    if (isset($_POST['oform'])) {
        $date = date('Y-m-d H:i:s');
        include ("Setup.php");
        $query = mysqli_query($mysqli, "UPDATE zakaz 
        SET Date_offirm = '$date', 
        Code_sost = 1, 
        Code_brig = 1, 
        Code_rab = 1
        WHERE Code_zakaza = $_POST[oform]");
        mysqli_close($mysqli);
    }

    if (isset($_POST['delete'])) {
        include ("Setup.php");
        $query = mysqli_query($mysqli, "DELETE FROM zakaz WHERE Code_zakaza = $_POST[delete]");
        mysqli_close($mysqli);
    }
    $nameStr = "Напишите нам письмо!";
    if (isset($_POST['mailB'])) {
        include ("Setup.php");
        $query = mysqli_query($mysqli, "SELECT Name, Email FROM polzovatel WHERE Code_polz = $_SESSION[userID]");
        $result = mysqli_fetch_array($query);
        $name = $result[0];
        $email = $result[1];
        $text = $_POST['mail'];
        if (mail('openServerTest@yandex.ru', $name, $text, $email)) {
            $nameStr = 'Письмо успешно отправлено';
        } else {
            $nameStr = 'Ошибка';
        }
    }

    ?>
                <table class="mail">
                <form action='' method='POST'>
                <tr>
                    <td><?php echo $nameStr?></td>
                </tr>
                <tr>
                    <td>
                        <textarea cols=20 rows=5 name='mail'></textarea>
                    </td>
                </tr>
                <tr>
                    <td><button type='submit' name="mailB" class="b1">Написать</button></td>
                </tr>
          
                </form>
            </table>

    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Личный кабинет пользователя <?php echo $_SESSION['userName'] ?></h2>

            <table>

                <?php
                if ($_SESSION['pokazLI'] == NULL) {
                    $_SESSION['pokazLI'] = false;
                }

                if (isset($_POST['perek'])) {
                    $_SESSION['pokazLI'] = !$_SESSION['pokazLI'];
                }
                if ($_SESSION['pokazLI']) {
                    ?>
                    <tr>
                        <td colspan="2">
                            <h3> Изменить личную информацию </h3>
                        </td>
                    </tr>
                    <tr>
                        <?php
                        include ("Setup.php");
                        $query = mysqli_query($mysqli, "SELECT * FROM polzovatel WHERE Code_polz = $_SESSION[userID]");
                        $result = mysqli_fetch_array($query);
                        ?>
                        <form action='' method='POST'>
                    <tr>
                        <td>
                            Имя
                        </td>
                        <td>
                            <input type="text" name="surn" value=<?php echo $result['Surname'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Фамилия
                        </td>
                        <td>
                            <input type="text" name="name" value=<?php echo $result['Name'] ?>>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            Отчество
                        </td>
                        <td>
                            <input type="text" name="patr" value=<?php echo $result['Patronymic'] ?>>
                        </td>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input type="e-mail" name="email" value=<?php echo $result['Email'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Телефон
                        </td>
                        <td>
                            <input type="text" name="phone" value=<?php echo $result['Phone'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Логин
                        </td>
                        <td>
                            <input type="text" name="login" value=<?php echo $result['Login'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Пароль
                        </td>
                        <td>
                            <input type="text" name="pass" value=<?php echo $result['Password'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type='submit' name="update" class="b1">Обновить поля</button>
                        </td>
                        </form>
                        <form action='' method='POST'>
                    <tr>
                        <td colspan="2"><button type='submit' name="perek" class="b1">Свернуть</button>
                        </td>
                    </tr>
                    </form>
                    </tr>
                <?
                } else {
                    ?>
                    <form action='' method='POST'>
                        <tr>
                            <td><button type='submit' name="perek" class="b1">Посмотреть личную информацию</button>
                            </td>
                        </tr>
                    </form>
                <? } ?>
            </table>

            <table style="">
                <tr>
                    <td colspan="11">
                        <h3> Заказы клиента </h3>
                    </td>
                </tr>
                <tr>
                    <td class='works'>
                        Адрес постройки
                    </td>
                    <td class='works'>
                        Дата начала строительства
                    </td>
                    <td class='works'>
                        Дата окончания строительства
                    </td>
                    <td class='works'>
                        Цена(руб)
                    </td>
                    <td class='works'>
                        Название постройки
                    </td>
                    <td class='works'>
                        Бригада
                    </td>
                    <td class='works'>
                        Состояние заказа
                    </td>
                    <td class='works'>
                        Ведущиеся работы
                    </td>
                    <td class='works'>
                        Дата оформления
                    </td>
                    <td class='works'>
                        Дата заключения договора
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <?php
                    include ("Setup.php");
                    $query = mysqli_query($mysqli, "SELECT * FROM viewzakaz WHERE Code_polz = $_SESSION[userID]");
                    $count = 0;
                    while ($result = mysqli_fetch_array($query)) {
                        $db = date("d.m.Y H:i:s", strtotime($result['Date_begin']));
                        $de = date("d.m.Y H:i:s", strtotime($result['Date_end']));
                        $do = date("d.m.Y H:i:s", strtotime($result['Date_offirm']));
                        $count++;
                        echo "
                        <form action='' method='POST'>
                <tr>
                <td>
                $result[Adress_postr]
                </td>
                <td>
                $db
                </td>
                <td>
                $de
                </td>
                <td>
                $result[Cost_postr]
                </td>
                <td>
                $result[NamePostr]
                </td>
                <td>
                $result[Surname_brig]
                </td>
                <td>
                $result[sostName]
                </td>
                <td>
                $result[nameRab]
                </td>
                <td>
                $do
                </td>
                <td>
                $result[Date_zak_dog]
                </td>
                <td>
                ";
                        if ($result['Date_offirm'] == null) {
                            echo "
                            <form action='' method='POST'>
                    <button type='submit' name='oform' class='b1' value = $result[Code_zakaza]>Оформить</button>
                </form>
                <form action='' method='POST'>
                    <button type='submit' name='delete' class='b1' value = $result[Code_zakaza]>Удалить</button>
                </form>
                ";
                        } else {
                            echo "Уже оформлено!";
                        }
                        echo "
                </td></tr>
                ";

                    }
                    ?>
                    </form>
                <tr>
                    <td colspan="10"></td>
                    <td>
                        <form action='' method='POST'>
                            <button type='submit' name='oformAll' class='b1'>Оформить все</button>
                        </form>
                        <form action='' method='POST'>
                            <button type='submit' name='deleteAll' class='b1'>Очистить все</button>
                        </form>
                    </td>
                </tr>
            </table>
</body>

</html>