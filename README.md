# Minutes-Flow
現在、大学で1年間を通して、開発をしています。  
現在、議事録作成は、docxで作成しPDFに変換し、メールにて共有するというフローになっています。  
このプログラムは、Markdownで、議事録を書きPushすると、Webhookで、mdをPDFに変換し、メールで共有してくれるものです。  

# Dependency
{
    "require": {
        "phpmailer/phpmailer": "^6.0",
        "vlucas/phpdotenv": "^2.4"
    }
}

# Setup
- Apacheの導入    
- PHPの導入  
- 任意の場所にgit clone  
- cloneしたレポジトリ配下に`.env`を配置  
  - ACADEMIC_ID="メールアドレス"
  - ACADEMIC_PASS="ログインパスワード"
  - SMTP_SERVER="SMTPサーバアドレス"
  - MAIL_GROUP="メーリングリスト"
- 議事録用のレポジトリを作成
- settingsのwebhookにApacheに対応させたURLを記載

# Usage
- Markdownを書いてPushするだけ！

# Licence
This software is released under the MIT License, see LICENSE.

# Authors
- DoSuKoI

# References
- [PHPMailer]()
- [【PHP】指定したパス以下にあるディレクトリ一覧を取得する方法](https://nodoame.net/archives/6603)

