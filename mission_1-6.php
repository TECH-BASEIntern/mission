<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
        <form action="mission_1-6.php" method="post">
                <input type="text" name="comment" value="コメント">
                <input type="submit" value="送信する">
        </form>
        <?php
                if(empty($_POST["comment"])) {
                        echo "コメントが入力されていません";
                } else if($_POST["comment"] === '完成！'){
                        echo "おめでとう！";
                } else {
                        $filename = "mission_1-6_yourname.txt";
                        $comment = "{$_POST["comment"]}\n";
                        /*
                        fopen, fwrite, fcloseを使ったファイル書き込み
                        $fp = fopen($filename, 'a');
                        fwrite($fp, $comment);
                        fclose($fp);
                        */
                        if(file_put_contents($filename, $comment, FILE_APPEND)) {
                                echo "ファイルに書き込みました";
                        } else {
                                echo "ファイル書き込みに失敗しました";
                        }
                }
        ?>
</body>
</html>