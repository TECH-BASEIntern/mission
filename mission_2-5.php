<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
</head>
<body>
	<?php
                $filename = "mission_2-5_yourname.txt";
                $lines = file($filename, FILE_IGNORE_NEW_LINES);
                $name = $_POST['name'];
                $comment = $_POST['comment'];
                $password = $_POST['password'];
                $delete_target = $_POST['delete_target'];
                $delete_password = $_POST['delete_password'];
                $edit_target = $_POST['edit_target'];
                $edit_password = $_POST['edit_password'];
                $editting_target = $_POST['editting_target'];

                if (!empty($edit_target)) {
                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($edit_target == $data[0]) {
                                        if ($edit_password == $data[4]) {
                                                $old_name = $data[1];
                                                $old_comment = $data[2];
                                                $old_password = $data[4];
                                        } else {
                                                echo "パスワードが違います。>編集処理を行えませんでした。".nl2br("\n");
                                        }
                                }
                	}
                }

        ?>
        <form action="mission_2-5.php" method="post">
        	<input type="text" name="name" placeholder="名前" value="<?= $old_name; ?>">
                <input type="text" name="comment" placeholder="コメント" value="<?= $old_comment; ?>">
                <input type="password" name="password" placeholder="パスワー>ド" value="<?= $old_password; ?>">
                <input type="hidden" name="editting_target" value="<?= $edit_target; ?>">
                <input type="submit" value="送信する"><br>
                <input type="text" name="delete_target" placeholder="削除番号">
                <input type="password" name="delete_password" placeholder="パスワード">
                <input type="submit" value="削除する"><br>
                <input type="text" name="edit_target" placeholder="編集番号">
                <input type="password" name="edit_password" placeholder="パスワード">
                <input type="submit" value="編集する"><br>
        </form>
        <?php
                # 新規投稿処理
                if (!empty($name) && !empty($comment) && !empty($password) &&empty($editing_target)) {
                        if (file_exists($filename)) {
                                $count = count($lines) + 1;
                        } else {
                                $count = 1;
                        }
                        $date = date("Y/m/d H:i:s");
                        $line = "$count<>$name<>$comment<>$date<>$password\n";
                        
                        $fp = fopen($filename, 'a');
                        fwrite($fp, $line);
                        fclose($fp);
                }

                # 削除処理
                if (!empty($delete_target) && !empty($delete_password)) {
                        # パスワード判定
                        $password_match = false;
                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($delete_target == $data[0] && $delete_password == $data[4]) {
                                        $password_match = true;
                                }
                        }

                        if ($password_match) {
                                $fp = fopen($filename, 'w');
                                foreach ($lines as $line) {
                                        $data = explode('<>', $line);
                                        if ($delete_target != $data[0]) {
                                                fwrite($fp, "$line\n");
                                        }
                                }

                                fclose($fp);
                        } else {
                                echo "パスワードが違います。削除処理を行えま>せんでした".nl2br("\n");
                        }
                }
                
                 # 編集処理
                if (!empty($name) && !empty($comment) && !empty($password) && !empty($editting_target)) {
                        $fp = fopen($filename, 'w');

                        foreach ($lines as $line) {
                                $data = explode('<>', $line);
                                if ($editting_target != $data[0]) {
                                        fwrite($fp, "$line\n");
                                } else {
                                        $date = date("Y/m/d H:i:s");
                                        $new_line = "{$date[0]}<>$name<>$comment<>$date<>$password\n";
                                        fwrite($fp, $new_line);
                                }
                        }

                        fclose($fp);
                }
                # 表示処理
                $lines = file($filename, FILE_IGNORE_NEW_LINES);

                foreach($lines as $line) {
                        $record = explode("<>", $line);
                        echo "投稿番号: " . $record[0];
                        echo " 名前: " . $record[1];
                        echo " コメント: " . $record[2];
                        echo " 投稿日時: " . $record[3];
                        echo nl2br("\n");
                }
        ?>
</body>
</html>