---
order: 5
title: CSP
---

# CSP（コンテンツセキュリティポリシー）

<!-- In order for Alpine to be able to execute plain strings from HTML attributes as JavaScript expressions, for example `x-on:click="console.log()"`, it needs to rely on utilities that violate the "unsafe-eval" content security policy. -->

<!-- > Under the hood, Alpine doesn't actually use eval() itself because it's slow and problematic. Instead it uses Function declarations, which are much better, but still violate "unsafe-eval". -->

<!-- In order to accommodate environments where this CSP is necessary, Alpine offers an alternate build that doesn't violate "unsafe-eval", but has a more restrictive syntax. -->

<!-- CSP（コンテンツセキュリティポリシー） -->

Alpine が HTML 属性から JavaScript 式としてプレーン文字列（ たとえば、`x-on:click = "console.log()"` ）を実行できるようにするには、「unsafe-eval」に違反するユーティリティに依存する必要があります。 コンテンツセキュリティポリシー。

> 内部的には、Alpine は遅くて問題があるため、実際には eval() 自体を使用しません。 代わりに、関数宣言を使用します。これははるかに優れていますが、それでも「unsafe-eval」に違反します。

この CSP が必要な環境に対応するために、Alpine は、「unsafe-eval」に違反しないが、構文がより制限された代替ビルドを提供しています。

<a name="installation"></a>

## インストール

<!-- Like all Alpine extensions, you can include this either via `<script>` tag or module import: -->

すべての Alpine 拡張機能と同様に、これは `<script>` タグまたはモジュールインポートのいずれかを介して含めることができます。

<a name="script-tag"></a>

### Script タグ

```html
<html>
    <script src="alpinejs/alpinejs-csp/cdn.js" defer></script>
</html>
```

<a name="module-import"></a>

### モジュールのインポート

```js
import Alpine from '@alpinejs/csp'

window.Alpine = Alpine
window.Alpine.start()
```

<a name="restrictions"></a>

## 制限

<!-- Since Alpine can no longer interpret strings as plain JavaScript, it has to parse and construct JavaScript functions from them manually. -->

<!-- Due to this limitation, you must use `Alpine.data` to register your `x-data` objects, and must reference properties and methods from it by key only. -->

<!-- For example, an inline component like this will not work. -->

<!-- 制限 -->

Alpine は文字列をプレーンな JavaScript として解釈できなくなったため、文字列から JavaScript 関数を手動で解析および構築する必要があります。

この制限により、 `Alpine.data` を使用して `x-data` オブジェクトを登録し、そこからプロパティとメソッドをキーのみで参照する必要があります。

たとえば、このようなインラインコンポーネントは機能しません。

```html
<!-- Bad -->
<div x-data="{ count: 1 }">
    <button @click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<!-- However, breaking out the expressions into external APIs, the following is valid with the CSP build: -->

ただし、式を外部 API に分割すると、CSP ビルドでは次のことが有効になります。

```html
<!-- Good -->
<div x-data="counter">
    <button @click="increment">Increment</button>

    <span x-text="count"></span>
</div>
```
```js
Alpine.data('counter', () => ({
    count: 1,

    increment() { this.count++ }
}))
```
