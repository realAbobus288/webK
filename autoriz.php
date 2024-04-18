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
$TEXT = "Введите свой логин и пароль в поля! А если вы еще не регистрировались, 
то нажмите на 'Регистрацию'";
if(isset($_POST['enter'])){
        if(empty($_POST['login']) || empty($_POST['password']) ){
            $TEXT = "Заполните все поля авторизации";
        }else{
            include("Setup.php");
            $query = mysqli_query($mysqli, "SELECT * FROM polzovatel WHERE Login = '$_POST[login]' AND Password = '$_POST[password]'");
            $result = mysqli_fetch_array($query);
            if($result['Code_polz'] == NULL){
                $TEXT = "Ошибка в логине или пароле!";
            }else{
                $_SESSION['userName'] = $result['Name'];
                $_SESSION['userID'] = $result['Code_polz'];
                $_SESSION['login'] = $result['Login'];
                $_SESSION['password'] = $result['Password'];
                header("Location: index.php");
            }
            mysqli_close($mysqli);
        }
    }
?>

    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Страница авторизации!</h2>
            <h3 style="text-align: center;"><?php echo $TEXT ?></h3>

            <form action='index.php'>
                    <button type='submit' class="sticky" style="right: 20px; width: 100px;">Вернуться на главную</button>
                </form>
                <form action='reg.php'>
                    <button type='submit' class="sticky" style="right: 130px; width: 100px;">Регистрация</button>
                </form>

            <table>
                <form action='' method='POST'>
                <tr>
                    <td>
                        Введите логин
                    </td>
                    <td>
                        <input type="text" name="login" >
                    </td>
                </tr>
                <tr>
                    <td>
                        Введите пароль
                    </td>
                    <td>
                        <input type="text" name="password" >
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button name='enter' type='submit' class="b1">Войти!</button>
                    </td>

                </tr>
                </form>

                
            </table>

</body>

</html>