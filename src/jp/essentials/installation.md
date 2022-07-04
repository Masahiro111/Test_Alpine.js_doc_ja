---
order: 1
title: Installation
---

# インストール

<!-- There are 2 ways to include Alpine into your project: -->

Alpine をプロジェクトに含めるには2つの方法があります。

<!-- * Including it from a `<script>` tag -->
<!-- * Importing it as a module -->

* `<script>`タグを使用してインクルードする
* モジュールとしてインポートする

<!-- Either is perfectly valid. It all depends on the project's needs and the developer's taste. -->

どちらも完全に有効です。それはすべて、プロジェクトのニーズと開発者の好みに依存します。

<a name="from-a-script-tag"></a>

## スクリプトタグから

<!-- This is by far the simplest way to get started with Alpine. Include the following `<script>` tag in the head of your HTML page. -->

これは、アルパインを始める最も簡単な方法です。 HTML ページの先頭に次の `<script>` タグを含めます。

```html
<html>
  <head>
    ...

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  ...
</html>
```

<!-- > Don't forget the "defer" attribute in the `<script>` tag. -->

> `<script>` タグの「defer」属性を忘れないでください。

<!-- Notice the `@3.x.x` in the provided CDN link. This will pull the latest version of Alpine version 3. For stability in production, it's recommended that you hardcode the latest version in the CDN link. -->

提供されている CDN リンクの `@3.x.x` に注意してください。これにより、Alpine バージョン 3 の最新バージョンがプルされます。本番環境での安定性のために、CDN リンクに最新バージョンをハードコーディングすることをお勧めします。

```html
<script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
```

<!-- That's it! Alpine is now available for use inside your page. -->

それでおしまい！ Alpine がページ内で使用できるようになりました。

<a name="as-a-module"></a>

## モジュールとして

<!-- If you prefer the more robust approach, you can install Alpine via NPM and import it into a bundle. -->

<!-- Run the following command to install it. -->

より堅牢なアプローチが必要な場合は、NPM を介して Alpine をインストールし、バンドルにインポートできます。

次のコマンドを実行してインストールします。

```shell
npm install alpinejs
```

<!-- Now import Alpine into your bundle and initialize it like so: -->

次に、Alpine をバンドルにインポートし、次のように初期化します。

```js
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
```

<!-- > The `window.Alpine = Alpine` bit is optional, but is nice to have for freedom and flexibility. Like when tinkering with Alpine from the devtools for example. -->

<!-- > If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the `Alpine` global object, and when you initialize Alpine by calling `Alpine.start()`. -->

> `window.Alpine = Alpine` ビットはオプションですが、自由と柔軟性のために持っていると便利です。たとえば、devtools から Alpine をいじくり回すときのように。

> Alpine をバンドルにインポートした場合は、`Alpine` グローバルオブジェクトをインポートするときと、`Alpine.start()` を呼び出して Alpine を初期化するときに、間に拡張コードを登録していることを確認する必要があります。

[→ Alpine の拡張についてもっと読む](/advanced/extending)）

