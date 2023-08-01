# application-traning
アプリケーション作成課題用


## 初期環境構築手順
1. environment_constructionのブランチの資源をローカルにダウンロードする
2. doker配下のディレクトリに移動しコンテナを起動する(実行コマンド：```doker compose up -d```)
3. コンテナが立ち上がったら,laravelコンテナに入る(実行コマンド：```docker compose exec -it {コンテナ名} bash```)
4. composerのインストールをする(実行コマンド： ```composer install```)
5. laravelのプロジェクトを作成する(実行コマンド： ```composer create-project laravel/ laravel sample --prefer-dist```)
6. .envのDBの接続情報を編集する
7. Laravelのログを標準出力に出力する設定を行う(config/logging.phpファイルを編集し```'channels' => ['single'],```の部分に,```'stderr'```を追記して```'channels'=>['single','stderr']```,と変更します
