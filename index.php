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
    </style>

</head>

<body>

    <?php  include ("mainTable.php");?>

    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Очень хорошо что вы решили заказать у нас дом! Выберите из списка
                интересующую вас постройку!</h2>

            <table>
                <?php
                include ("Setup.php");
                $query = mysqli_query($mysqli, "SELECT * FROM photo_home");
                while ($result = mysqli_fetch_array($query)) {
                    $foto = "ourWorks\\" . $result["Photo"];
                    echo "
            <tr >
            <td style='border: 1px solid black;'>$result[Name]<td>
            </tr>
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