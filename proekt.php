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

        td{
            font-size: 16px;
        }
    </style>

</head>
<?php
session_start();

if (isset($_POST['gal'])){
    $str = explode(';', $_POST['gal']);
    $_SESSION['proekrID'] = $str[0];
    $_SESSION['proekrName'] = $str[1];
    header("Location: gal.php");
}

if (isset($_POST['buy'])){
    $str = explode(';', $_POST['buy']);
    $_SESSION['proekrID'] = $str[0];
    $_SESSION['proekrName'] = $str[1];
    $_SESSION['cost'] = $str[2];
    header("Location: buyPage.php");
}
?>
<body>
    
<?php  include ("mainTable.php");?>


    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Это страница с проектами, выберите проект, который хотите заказать!<h2>

            <form action='' method='POST'>
                    <p>Найти по названию</p>
                    <input type="text" name="filtr" >
                    <button name='find' type='submit' class='b1' style="height: 30px;width: 80px;">Найти</button>
                    <button name='sbros' type='submit' class='b1' style="height: 30px;width: 80px;">Сбросить</button>
                </form>

                    <table style="border: 1px solid black;">
                        <tr>
                            <td style='border: 1px solid black;'>
                                Название
                            </td>
                            <td style='border: 1px solid black;'>
                                Количество этажей
                            </td>
                            <td style='border: 1px solid black;'>
                                Количество комнат
                            </td>
                            <td style='border: 1px solid black;'>
                                Базовая цена (руб)
                            </td>
                            <td style='border: 1px solid black;'>
                                Метраж
                            </td>
                            <td style='border: 1px solid black;'>
                                Фундамент
                            </td>
                            <td style='border: 1px solid black;'>
                                Материалы
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        <?php
                        include ("Setup.php");
                        $query = mysqli_query($mysqli, "SELECT * FROM type_postr");
                        if (isset($_POST['find'])){
                            $query = mysqli_query($mysqli, "SELECT * FROM type_postr WHERE `Name` LIKE '%$_POST[filtr]%'");
                        }
                        if (isset($_POST['sbros'])){
                            $query = mysqli_query($mysqli, "SELECT * FROM type_postr");
                        }
                        while ($result = mysqli_fetch_array($query)) {
                            echo "
            <tr>
                <td>$result[Name]</td>
                <td >$result[Count_etashey]</td>
                <td >$result[Count_comnat]</td>
                <td >$result[Baze_cost]</td>
                <td >$result[Metrazh]</td>
                <td >$result[fund]</td>
                <td>$result[mater]</td>
                <td>
                <form action='' method='POST' style = 'height: 40px; width: 160px;'>
                    <button name='gal' type='submit' class='b1' value='$result[Code_postr];$result[Name]'>Посмотреть Галерею</button>
                </form>
                </td>
                <td>"; 

                if ($_SESSION['userID'] == null){
                    echo "Авторизуйтесь!";
                }else{
                echo"
                <form action='' method='POST' style = 'height: 40px; width: 160px;'>
                    <button name ='buy' type='submit' class='b1' value='$result[Code_postr];$result[Name];$result[Baze_cost]'>Заказать</button>
                </form>
                "; 
            } 
                echo"

                </td>
            </tr>
            ";
                        }
                        mysqli_close($mysqli);
                        ?>
                    </table>

</body>

</html>