<?php
//モジュール読み込み
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

//設定ファイルをロード
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$MAIL_ID = getenv('ACADEMIC_ID');
$MAIL_PASS = getenv('ACADEMIC_PASS');
$MAIL_SERVER = getenv('SMTP_SERVER');
$MAIL_GROUP = getenv('MAIL_GROUP');
//メーラーのインスタンス生成
$mail = new PHPMailer;

//インスタンスにSMTPで通信することを宣言
$mail->isSMTP();

//デバッグモード設定
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//SMTPサーバの情報を設定
$mail->Host = $MAIL_SERVER;
//SMTPサーバのポートを指定
$mail->Port = 465;
//暗号化の方式をTLSかSSLに指定
$mail->SMTPSecure = 'ssl';
//SMTP認証を行うか宣言
$mail->SMTPAuth = true;
//SMTP認証に用いるユーザ名
$mail->Username = $MAIL_ID;
//SMTP認証に用いるパスワード
$mail->Password = $MAIL_PASS;

//メールが誰からの送信なのか宣言
$mail->setFrom($MAIL_ID, "アジェ男");

//メールの宛先を宣言
//$mail->addAddress($MAIL_GROUP, 'Miraikeitai_only_FUN');
//テスト用
$mail->addAddress($MAIL_ID, '戸澤');

//件名
$mail->Subject = "TEST TEST [SHARE] Minutes";

//本文
$line_1 = "教員の皆様、プロジェクトメンバーの皆さん"."\n";
$line_2 = "お疲れ様です。議事録担当です。"."\n";
$line_3 = "議事録の作成が完了致しましたので、添付にて共有させて頂きます。"."\n";
$line_4 = "以上です。よろしくお願い致します。"."\n";
$ps = "GitHubのイベント管理によるシステムの自動送信になります。"."\n";
$Body = $line_1.$line_2.$line_3.$line4;
$mail->Body = $Body;

//添付ファイル
//$mail->addAttachment('master/minutes/output.pdf');
//メール送信時のエラーチェック
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
