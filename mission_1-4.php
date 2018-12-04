<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
        <form action="mission_1-4.php" method="post">
                <input type="text" name="comment" value="コメント">
                <input type="submit" value="送信する">
        </form>
        <?php
                if(empty($_POST["comment"])) {
                        echo "コメントが入力されていません";
                } else {
                        echo "ご入力ありがとうございます。" , nl2br("\n");
                        echo date("Y年m月d日H時i分") . "に";
                        echo htmlspecialchars($_POST["comment"],ENT_QUOTES,'UTF-8');
                        echo "を受け付けました";
                }
        ?>
</body>
</html>