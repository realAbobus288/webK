<!DOCTYPE html>
<html>

<head>
    <meta charset='UTF-8'>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <title>Строительная фирма "У Костика"</title>
    <link rel="stylesheet" href="css.css">

    <style>
        .b1 {
            height: 30px;
            width: 120px;
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
            margin: 10% 40%;
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

        .sticky {
            position: -webkit-sticky;
            position: sticky;
            height: 40px;
            top: 20px;
            float: right;

        }
    </style>

</head>

<body>
    <?php
    session_start();
    $TEXT = "Мы всегда рады новым пользователям! Введи свои данные в поля!";
    if (isset($_POST['enter'])) {
        if(empty($_POST['login']) || empty($_POST['password']) || empty($_POST['name'])
        || empty($_POST['sern']) || empty($_POST['patr']) || empty($_POST['phone']) || empty($_POST['email'])){
            $TEXT = "Заполните все поля регистрации";
        }else{
            include("Setup.php");
            $query = mysqli_query($mysqli, "SELECT COUNT(*) FROM polzovatel WHERE Login = '$_POST[login]'");
            $result = mysqli_fetch_array($query);
            if($result[0]>0) $TEXT = "Пользователь уже зарегистрировался";
            if($result[0]==0)
            {
                $query = mysqli_query($mysqli, "
                INSERT INTO `polzovatel` (`Code_polz`, `Surname`, `Login`, `Password`, `Phone`, `Email`, `Name`, `Patronymic`) 
                VALUES (NULL, '$_POST[sern]', '$_POST[login]', '$_POST[password]', '$_POST[phone]', '$_POST[email]', '$_POST[name]', '$_POST[patr]');");

                $_SESSION['userName'] = $_POST['name'];
                $_SESSION['password'] = $_POST['password'];
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['userID'] = $mysqli->insert_id;;
                header("Location: index.php");
            }
        }
    }
    ?>

    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Страница регистрации!</h2>
            <h3 style="text-align: center;"><?php echo $TEXT ?></h3>

            <form action='index.php'>
                <button type='submit' class="sticky" style="right: 20px; width: 100px;">Вернуться на главную</button>
            </form>
            <form action='autoriz.php'>
                <button type='submit' class="sticky" style="right: 130px; width: 100px;">Авторизация</button>
            </form>

            <table>
                <form action='' method='POST'>
                    <tr>
                        <td>
                            Логин
                        </td>
                        <td>
                                <input type="text" name='login'><?php echo $_POST['login'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Пароль
                        </td>
                        <td>
                        <input type="text"name='password'><?php echo $_POST['password'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Имя
                        </td>
                        <td>
                            <input type="text"name='name'><?php echo $_POST['name'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Фамилия
                        </td>
                        <td>
                        <input type="text"name='sern'><?php echo $_POST['sern'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Отчество
                        </td>
                        <td>
                            <input type="text"name='patr'><?php echo $_POST['patr'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Телефон
                        </td>
                        <td>
                        <input type="text"name='phone'><?php echo $_POST['phone'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email
                        </td>
                        <td>
                            <input type="e-mail" name="email" value=<?php echo $_POST['email'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                             <button name='enter' type='submit' class="b1">Создать аккаунт!</button>
                        </td>
                    </tr>
                </form>


            </table>

</body>

</html>