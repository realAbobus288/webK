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
if (isset($_POST['back'])){
    $_SESSION['proekrID'] = null;
    $_SESSION['proekrName'] = null;
    header("Location: proekt.php");
}
?>
    <h1 style="text-align: center;">Строительная фирма "У Костика!"<h1>

            <h2 style="text-align: center;">Галерея проекта "<?php echo $_SESSION['proekrName'] ?>"</h2>

            <form class="sticky" action='' method='POST'>
                    <button type='submit' name="back" >Вернуться</button>
            </form>
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