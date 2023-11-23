<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ログイン画面</title>
        <!--///////////////////////////////////この画面のCSS////////////////////////////////////////////-->
        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 300px;
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: #ff0000;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
    <body>

        <?php
        $hostname = '127.0.0.1';
        $username = 'root';
        $password = 'dbpass';
        $dbname = 'last_report';
        $tablename = 'user_info';//ユーザネーム(user)とパスワード(pass)が入っているテーブル

        ///////////ユーザネームとパスワードが入力されていた場合if文の中を実行する
        if((isset($_POST['input_username']))&&(isset($_POST['input_password']))){

            $input_username = $_POST['input_username'];
            $input_password = $_POST['input_password'];
                

            mysqli_report(MYSQLI_REPORT_OFF);

            $link = mysqli_connect($hostname,$username,$password);
            if (! $link){ exit("Connect error!"); }

            $input_username = mysqli_real_escape_string($link, $_POST['input_username']);
            $input_password = mysqli_real_escape_string($link, $_POST['input_password']);


            $result = mysqli_query($link,"USE $dbname");
            if (!$result) { exit("USE failed!"); }

            // データベースでuserとpassが一致しているか検証
            $result = mysqli_query($link,"SELECT COUNT(*) AS cnt  FROM $tablename WHERE user = '$input_username' AND pass = '$input_password'");
            if (!$result){ exit("Select error on table ($tablename)!"); } 
        
            $row = mysqli_fetch_assoc($result);

            if ($row['cnt'] > 0) { 
                //ユーザネームとパスワードが一致した場合の処理
                //メイン画面に遷移
                header("Location: last_main.php");   
                // データベース接続のクローズ  
                mysqli_close($link);         
                exit();
            } else{
                //ユーザネームとパスワードが一致しない場合の処理
                echo "ユーザ名、またはパスワードが間違っています";
            }
        }
        ?>
        <h2>Login Form</h2>

        <form method="post" action="last_login.php" >
            <label for="username">ユーザネーム:</label>
            <input type="text" id="input_username" name="input_username" required>
            <br>

            <label for="password">パスワード:</label>
            <input type="password" id="input_password" name="input_password" required>
            <br>

            <button type="submit">ログイン</button>
        </form>

        
    </body>
</html>  