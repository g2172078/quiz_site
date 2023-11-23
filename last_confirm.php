<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>回答確認画面</title>
        <style>
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 50px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            margin-top: 20px;
        }


        div{
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            margin-top: 20px;
        }
        p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
        }
    </style>
    </head>
    <body>

        <h1>回答確認画面</h1>
        <?php
        $input_answer = $_POST["a"];

        echo"<div>";
        for($i=1; $i <= 5; $i++){
            //echo "問$i:{$input_answer[$i - 1]}<br>";
            echo "<p>問$i:" . htmlspecialchars($input_answer[$i - 1]) . "</p>";
        }
        echo "</div>";
        ?>
        
        <form method="POST" action="last_question.php">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[0];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[1];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[2];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[3];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[4];?>">
            <div><button type="submit" name="修正ボタン" value="修正ボタン">修正ボタン</button></div>
        </form>
        <form method="POST" action="last_result.php">
            <p>ランキング登録ユーザネーム</p>
            <p>(ログインしたユーザネームを入力してください)</p>
            <input type="text" name="register_username" value= "" require>
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[0];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[1];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[2];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[3];?>">
            <input type="hidden" name="a[]" value= "<?php echo $input_answer[4];?>">
            <button type="submit" name="回答確定ボタン" value="回答確定ボタン">回答確定</button>
        </form>
    </body>
</html>