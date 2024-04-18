

<?php
session_start();

if (isset($_POST['exit'])){
    $_SESSION['userID'] = NULL;
    $_SESSION['userName'] = NULL;
    header("Location: index.php");
}
?>

<table class="main">
        <tr>
                <form action='proekt.php'>
            <th width=20%>

                    <button type='submit' class="b1">Выбрать проект дома</button>
            </th>

                </form>
                <form action='index.php'>
            <th width=20%>

                    <button type='submit' class="b1">На главную страницу</button>
            </th>

                </form>
            <th width=20%>
                <?php 
                if ($_SESSION["userID"] == null){
                    ?>
                     <form action='autoriz.php'>
                         <button type='submit' class="b1">Авторизоваться</button>
                    </form>
                    <?php
                }else{
                    echo "Здравствуйте ".$_SESSION["userName"]."<br>";
                    ?>
                     <form action='userPage.php'>
                         <button type='submit' class="b1">В личный кабинет</button>
                    </form>
                    <form action='' method='POST'>
                         <button type='submit' name = "exit" class="b1">Выйти</button>
                    </form>
                    <?php
                }
                ?>
               
            </th>
        </tr>
    </table>