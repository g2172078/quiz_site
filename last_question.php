<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>クイズ出題画面</title>
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
        <h1> クイズ出題画面 </h1>
        <?php
        if (array_key_exists("a", $_POST)){
            $input_answer = $_POST["a"];
        }else{
            $input_answer = array_fill(0,5,"");
        }
        ?>
        <form method="POST" action="last_confirm.php">
            <p>第1問：3! = □</p>
            <input type="text" name="a[]" value="<?php echo $input_answer[0] ?>" required>
            <br>
            <p>第2問：「12月は何日まで？」 = □ 日</p>
            <input type="text" name="a[]" value="<?php echo $input_answer[1] ?>"required>
            <br>
            <p>第3問：1+2 = □</p>
            <input type="text" name="a[]" value="<?php echo $input_answer[2] ?>"required>
            <br>
            <p>第4問：1+3 = □</p>
            <input type="text" name="a[]" value="<?php echo $input_answer[3] ?>"required>
            <br>
            <p>第5問：1+4 = □</p>
            <input type="text" name="a[]" value="<?php echo $input_answer[4] ?>"required>
            <br>
            <button type="submit" name="確認ボタン" value="確認ボタン">確認ボタン</button>
        </form>
    </body>
</html>
