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

        .sticky {
            position: -webkit-sticky;
            position: sticky;
            height: 40px;
            width: 80px;
            top: 20px;
            float: right;
            right: 20px;
        }
    </style>

</head>

<body>
    <?php
    session_start();
    if (isset($_POST['back'])) {
        $_SESSION['proekrID'] = null;
        $_SESSION['proekrName'] = null;
        header("Location: proekt.php");
    }
    $TEXT = "";

    if (isset($_POST['buy'])) {
        if(empty($_POST['adr']) || empty($_POST['dataBeg']) || empty($_POST['dataEnd'])){
            $TEXT = "Заполните все поля!";
        }else{
            include("Setup.php");
            $query = mysqli_query($mysqli, "INSERT INTO zakaz 
            (Code_zakaza, Adress_postr, Date_begin, Date_end, Cost_postr, Code_polz, Code_postr,  
            Code_brig, Code_sost, Code_rab, Date_offirm, Date_zak_dog) 
            VALUES(NULL, '$_POST[adr]', '$_POST[dataBeg]', '$_POST[dataEnd]', '$_SESSION[cost]', $_SESSION[userID], $_SESSION[proekrID],
             NULL,  NULL, NULL, NULL, NULL)");
            $result = mysqli_fetch_array($query);
            header("Location: userPage.php");
            mysqli_close($mysqli);
        }
    }
    ?>
    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Это страница заказа здания "<?php echo $_SESSION['proekrName'] ?>"!
                <?php echo $TEXT ?> </h2>

            <form class="sticky" action='' method='POST'>
                <button type='submit' name="back">Вернуться</button>
            </form>

            <table>
                <form action='' method='POST'>

                    <tr>
                        <td>
                            Адрес постройки
                        </td>
                        <td>
                            <textarea cols=20 rows=1 name='adr'><?php echo $_POST['adr'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Дата начала строительства
                        </td>
                        <td>
                            <INPUT TYPE="date" NAME="dataBeg" value=<?php echo $_POST['dataBeg'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Дата окончания строительства
                        </td>
                        <td>
                            <INPUT TYPE="date" NAME="dataEnd" value=<?php echo $_POST['dataEnd'] ?>>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Цена постройки <?php echo $_SESSION['cost'] ?> руб
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <form action='' method='POST'>
                                <button type='submit' class="b1" name="buy">В корзину!</button>
                            </form>
                        </td>
                    </tr>
            </table>


            <table>
                <?php
                include ("Setup.php");
                $query = mysqli_query($mysqli, "SELECT * FROM photo_rab WHERE Code_postr = $_SESSION[proekrID]");
                while ($result = mysqli_fetch_array($query)) {
                    $foto = "rab\\" . $result["Photo"];
                    echo "
                    <tr>
                        <td style='border: 1px solid black;'><img width= 1200px height=800px src = '$foto'><td>
                    </tr>
                    ";
                }
                mysqli_close($mysqli);
                ?>
            </table>

</body>

</html>