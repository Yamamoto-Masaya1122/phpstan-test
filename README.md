# PHPStan 技術検証

PHPStanをLaravelプロジェクトへ導入する手順と、静的解析レベルの挙動を検証したデモリポジトリです。

## 実行環境

| 項目 | バージョン |
|------|-----------|
| OS | macOS 26.4.1（25E253） |
| チップ | Apple M5 |
| PHP | 8.3 |
| Laravel | 13.x |
| PHPStan | 2.1 |
| Larastan | 3.9（Laravel向けPHPStan拡張） |

---

## 導入手順

### 1. パッケージインストール

```bash
# PHPStan + Larastan のインストール
docker-compose exec app composer require --dev phpstan/phpstan
docker-compose exec app composer require --dev nunomaduro/larastan
```

### 2. 設定ファイル作成

プロジェクトルートに `phpstan.neon` を作成します。

```neon
includes:
    - ./vendor/nunomaduro/larastan/extension.neon

parameters:
    paths:
        - app
        - routes
        - config
        - database
        - resources/views

    level: 6

    excludePaths:
        - ./*/*/FileToBeExcluded.php
```

Larastanの `extension.neon` をインクルードすることで、Eloquentモデルやファサードなど Laravel固有のパターンを PHPStan が理解できるようになります。

### 3. 実行

```bash
docker-compose exec app ./vendor/bin/phpstan analyse --memory-limit=2G
```

`composer.json` にスクリプトを登録しておくと便利です。

```json
"scripts": {
    "phpstan": "./vendor/bin/phpstan analyse"
}
```

```bash
composer phpstan
```

---

## 静的解析レベル一覧

PHPStan はレベル 0〜9 の段階的なルールセットを持ちます。レベルが上がるほど厳格なチェックが追加されます。

| レベル | 追加されるチェック内容 |
|--------|----------------------|
| **0** | 基本的な構文エラー、存在しないクラス・関数・メソッドの呼び出し |
| **1** | 未定義変数、`$this` の未定義プロパティへのアクセス |
| **2** | 未知のメソッド・プロパティの型チェック、`phpDoc` コメントの型検証 |
| **3** | 戻り値の型チェック、プロパティへの代入型チェック |
| **4** | 基本的な型不一致（nullableな値の未チェック利用など） |
| **5** | `checkMissingIterableValueType` が有効化、メソッド・関数の引数型チェック強化 |
| **6** | `checkUnionTypes` が有効化、Union型の各ケースを考慮した型チェック ★本デモで採用 |
| **7** | 戻り値の型が明示されていないメソッドを報告 |
| **8** | `null` 安全性チェックのさらなる強化（nullable型の扱いがより厳格に） |
| **9** | `mixed` 型の使用を全面的に禁止（最も厳格） |

> **本デモではレベル 6 を採用しています。**  
> Union型を含む複雑な型推論まで検証でき、実務導入の出発点として適切なバランスと判断しました。

---

## 検証内容

- Larastan を用いた Laravel プロジェクトへの PHPStan 導入可否の確認
- 各解析レベルが検出するエラー種別の差異の把握
- level 6 運用時に発生するエラーパターンと修正方針の整理
