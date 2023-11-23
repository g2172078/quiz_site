<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>結果画面</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                text-align: center;
                margin: 50px;
                background-color: #f4f4f4;
            }

            h1, h3 {
                color: #333;
            }

            h3 {
                margin-top: 20px;
            }

            .result-container {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                max-width: 400px;
                margin: 0 auto;
                margin-top: 20px;
            }

            .answer {
                font-size: 18px;
                margin-bottom: 10px;
            }

            .correct {
                color: #4CAF50;
            }

            .incorrect {
                color: #FF0000;
            }

            .link-button {
                display: inline-block;
                background-color: #4CAF50;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 8px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>

        <h1>結果画面</h1>
        <div class="result-container">
        <?php
        $input_answer = $_POST["a"];
        $answer = [6,31,3,4,5];
        $score = 0;
        $register_username = $_POST['register_username'];///last_confirm.php　回答確認画面で入力されたユーザネームを受け取る

        ///////["a"]に入っている回答データの正誤を判定し、正答数に合わせて得点を追加する
        for($i=0; $i < sizeof($_POST["a"]); $i++){
            echo "問".($i+1).":" . htmlspecialchars($input_answer[$i]) ;
            if($answer[$i] == $input_answer[$i]){
                $score += 10;
                echo "正解○<br>";
            }
            else{
                echo "不正解×<br>";
            }
        }
        ?>

        <h3>あなたの得点は <?php echo $score ?>点です！</h3>
        <?php 
        $hostname = '127.0.0.1';
        $username = 'root';
        $password = 'dbpass';
        $dbname = 'last_report';
        $tablename = 'ranking';
        ///////////////////////////////////////////////////////////ユーザネームと得点をデータベースに登録する
        mysqli_report(MYSQLI_REPORT_OFF);

        $link = mysqli_connect($hostname,$username,$password);
        if (! $link){ exit("Connect error!"); }

        $result = mysqli_query($link,"USE $dbname");
        if (!$result) { exit("USE failed!"); }

        $result = mysqli_query($link,"INSERT INTO $tablename SET user='$register_username', point='$score'");
        if (!$result) { exit ("INSERT failed!\n"); }
        mysqli_close($link);
        ?>
        
        <a class="link-button" href="http://127.0.0.1:10800/~sspuser/last_ranking.php">ランキング画面表示</a>        
    </body>
</html>