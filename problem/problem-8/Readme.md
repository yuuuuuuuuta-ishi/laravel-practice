# 教育課題8(オブジェクト指向)

- 以下の要件を満たすアプリケーションを作成して下さい
- **dockerでPHPのコンテナの立ち上がる環境を構築し、そのコンテナで動くアプリケーションを作成し実行すること**

## 要件

### 入出力アプリケーション

1. 入力画面と出力画面の2画面を作成すること。
2. 入力画面には入力用のテキストボックス1つ言語が選択できるリスト、実行ボタンが1つあること。
3. 入力画面にて実行ボタン押下時、出力画面に入力されたテキストに対しての2つの外部のAPIサービスの結果のメッセージが表示されること

**その他、必要と思われるものは自由に追加可。**

## 実装時の制限

- 以下の無料APIを使用すること

1. DeepL translateAPI
   - 参考サイト:<https://developers.deepl.com/docs/api-reference/translate>
2. DeepL languagesAPI
   - 参考サイト:<https://developers.deepl.com/docs/api-reference/languages>
3. a3rt talkAPI
   - 参考サイト：<https://a3rt.recruit.co.jp/product/talkAPI/>

- 選択された言語での翻訳が可能かをlanguagesAPIを実行し確認すること
- 外部のAPIを実行した際にその履歴を記録するテーブルを以下の表を参考に作成すること（テーブルの定義は必要に応じて適した定義に変更してください）

テーブル情報
|論理名|物理名|
|:----|:----|
|API実行履歴||

カラム情報
|論理名|物理名|データ型|Not Null|デフォルト|備考|
|:----|:----|:----|:----|:----|:----|
|id| |serial|Yes| | |
|サービス名| |character(10)| | | |
|API名| |character(10)| | | |
|リクエスト| |character varying(50)| | | |
|レスポンス| |character varying(50)| | | |
|作成日時| |timestamp(6) without time zone| | | |
|更新日時| |timestamp(6) without time zone| | | |

- 以下のクラス図を基にAPI実行用のクラスを作成すること

<img src="クラス図.drawio" width="50%">