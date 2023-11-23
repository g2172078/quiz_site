<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>ランキング表示画面</title>
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

            table {
                width: 50%;
                margin: 20px auto;
                border-collapse: collapse;
            }

            th, td {
                padding: 10px;
                border: 1px solid #ddd;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            a {
                display: inline-block;
                background-color: #333;
                color: white;
                padding: 10px 20px;
                text-decoration: none;
                border-radius: 8px;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>

        <h1>ランキング表示画面</h1>
        <?php
        $hostname = '127.0.0.1';
        $username = 'root';
        $password = 'dbpass';
        $dbname = 'last_report';
        $tablename = 'ranking';

        ////データベースへの接続
        mysqli_report(MYSQLI_REPORT_OFF);

        $link = mysqli_connect($hostname,$username,$password);
        if (! $link){ exit("Connect error!"); }
    
    
        $result = mysqli_query($link,"USE $dbname");
        if (!$result) { exit("USE failed!"); }
    

        ////////////rankingテーブルにおいて、pointの降順に取り出す。また、rank関数でrank(順位)をつける
        $result = mysqli_query($link,"SELECT user, point,RANK() OVER(ORDER BY point DESC) AS 'rank' FROM ranking;");
        if (!$result){ exit("Select error on table ($tablename)!"); } 

        $row_assoc = mysqli_fetch_assoc($result);

        ///////////////////////////////////////////////テーブルの初まり
        echo "<table border='1'>";
        echo "<tr>";

            echo "<th>";
                echo "ユーザネーム";
            echo "</th>";
            echo "<th>";
                echo "得点";
            echo "</th>";
            echo "<th>";
                echo "順位";
            echo "</th>";

        echo "</tr>";

        do{
            echo "<tr>";
            foreach ($row_assoc as $key => $value)
            {
                echo "<td>";
                    echo htmlspecialchars($value);
                echo "</td>";    
            }
            echo "</tr>";
        }while($row_assoc = mysqli_fetch_assoc($result));

        echo"</table>";

        mysqli_free_result($result);


        mysqli_close($link);
        ?>
        <a href="last_main.php">メイン画面へ戻る</a>
    </body>
</html>