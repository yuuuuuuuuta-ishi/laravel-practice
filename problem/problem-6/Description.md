# 教育課題6(基礎総合①)

- 以下の要件を満たすアプリケーションを作成して下さい
- **dockerでPHPのコンテナの立ち上がる環境を構築し、そのコンテナで動くアプリケーションを作成し実行すること**

## 要件

### 勤怠管理システムの作成

1. 「社員ID」、「パスワード」を入力し、ログインを行う。
2. 「出社時刻」、「退社時刻」、「作業内容」を入力し、勤怠の登録を行う。
3. １ヵ月単位で勤務時間の一覧が表示できる。

**※その他、必要と思われるものは自由に追加可。**

  
## 実装時の制限

**MVC基礎課題で作成したアプリケーションにリクエストクラスを追加し入力チェックを行ってください**

### Blade・controller・modelによるMVCモデリングアプリケーション開発
1. 各画面の表示はBlade、ビジネスロジックはController、DB関連の処理はModelで作成を行う。
2. 送信はGET、POSTどちらか適したものを利用する。
3. データの入出力はDB(postgres)を利用する。
4. テーブル作成の際は各カラムで論理名を参考に物理名をつけてください
5. 入力値に対するバリデーションのチェックをリクエストクラスで行う


## データベースサンプル

テーブル情報
|論理名|物理名|
|:----|:----|
|社員||

カラム情報
|論理名|物理名|データ型|Not Null|デフォルト|
|:----|:----|:----|:----|:----|
|id| |serial|Yes| |
|社員コード| |character(4)| | |
|パスワード| |character varying(50)| | |
|社員名| |character varying(256)| | |
|支店| |character varying(256)| | |
|部署| |character varying(256)| | |
|役職| |character varying(256)| | |
|入社日| |date| | |
|年齢| |integer| | |
|登録日時| |timestamp(6) without time zone| | |
|更新日時| |timestamp(6) without time zone| | |

テーブル情報
|論理名|物理名|
|:----|:----|
|日次勤務情報||

カラム情報
|論理名|物理名|データ型|Not Null|デフォルト|
|:----|:----|:----|:----|:----|
|id| |serial|Yes| |
|社員コード| |character(4)| | |
|勤務日| |date| | |
|出勤時間| |timestamp(6) without time zone| | |
|退勤時間| |timestamp(6) without time zone| | |
|勤務時間（分）| |integer| | |
|勤務内容| |character varying(256)| | |
|登録日時| |timestamp(6) without time zone| | |
|登録者| |character varying(256)| | |
|更新日時| |timestamp(6) without time zone| | |
|更新者| |character varying(256)| | |
