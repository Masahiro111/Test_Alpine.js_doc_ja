---
order: 5
title: Lifecycle
---

# ライフサイクル

Alpine には、ライフサイクルのさまざまな部分に接続するためのさまざまな手法がいくつかあります。以下に精通するために最も役立つものを見ていきましょう。

<!-- Alpine has a handful of different techniques for hooking into different parts of its lifecycle. Let's go through the most useful ones to familiarize yourself with: -->

<a name="element-initialization"></a>

## 要素の初期化

Alpineのもう1つの非常に便利なライフサイクルフックは、`x-init` ディレクティブです。

`x-init` はページ上の任意の要素に追加でき、Alpineがその要素の初期化を開始すると、ページ内で呼び出す JavaScript を実行します。

<!-- Another extremely useful lifecycle hook in Alpine is the `x-init` directive. -->

<!-- `x-init` can be added to any element on a page and will execute any JavaScript you call inside it when Alpine begins initializing that element. -->

```html
<button x-init="console.log('Im initing')">
```

<!-- In addition to the directive, Alpine will automatically call any `init()` methods stored on a data object. For example: -->

ディレクティブに加えて、Alpineはデータオブジェクトに格納されているすべての `init()` メソッドを自動的に呼び出します。例えば：

```js
Alpine.data('dropdown', () => ({
    init() {
        // I get called before the element using this data initializes.
    }
}))
```

<a name="after-a-state-change"></a>

## 状態変化後

Alpine を使用すると、データ（状態）が変更されたときにコードを実行できます。このようなタスクには、`$watch` と `x-effect` の2つの異なる API が用意されています。

<!-- Alpine allows you to execute code when a piece of data (state) changes. It offers two different APIs for such a task: `$watch` and `x-effect`. -->

<a name="watch"></a>

### `$watch`

```html
<div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">
```

<!-- As you can see above, `$watch` allows you to hook into data changes using a dot-notation key. When that piece of data changes, Alpine will call the passed callback and pass it the new value. along with the old value before the change. -->

上記のように、 `$watch` を使用すると、ドット表記キーを使用してデータの変更にフックできます。そのデータが変更されると、Alpine は渡されたコールバックを呼び出し、新しい値を渡します。変更前の古い値と一緒に。

[→ $watch についてもっと読む](/magics/watch)

<a name="x-effect"></a>

### `x-effect`

`x-effect` uses the same mechanism under the hood as `$watch` but has very different usage.

Instead of specifying which data key you wish to watch, `x-effect` will call the provided code and intelligently look for any Alpine data used within it. Now when one of those pieces of data changes, the `x-effect` expression will be re-run.

Here's the same bit of code from the `$watch` example rewritten using `x-effect`:

`x-effect` は、内部で `$watch` と同じメカニズムを使用しますが、使用方法が大きく異なります。

監視するデータキーを指定する代わりに、 `x-effect` は提供されたコードを呼び出し、その中で使用されている Alpine データをインテリジェントに検索します。これらのデータの1つが変更されると、`x-effect` 式が再実行されます。

これは、`x-effect` を使用して書き直された `$watch` の例と同じコードです。

```html
<div x-data="{ open: false }" x-effect="console.log(open)">
```

<!-- Now, this expression will be called right away, and re-called every time `open` is updated. -->

<!-- The two main behavioral differences with this approach are: -->

<!-- 1. The provided code will be run right away AND when data changes (`$watch` is "lazy" -- won't run until the first data change) -->
<!-- 2. No knowledge of the previous value. (The callback provided to `$watch` receives both the new value AND the old one) -->

これで、この式はすぐに呼び出され、`open` が更新されるたびに再呼び出されます。

このアプローチとの 2つの主な動作の違いは次のとおりです。

1. 提供されたコードはすぐに実行され、データが変更されたときに実行されます（ `$watch` は"lazy" であり、最初のデータ変更まで実行されません）
2. 以前の値についての知識がありません。 （`$watch` に提供されたコールバックは、新しい値と古い値の両方を受け取ります）

[→ x-effect についてもっと読む](/directives/effect)

<a name="alpine-initialization"></a>

## Alpine initialization

<a name="alpine-initializing"></a>

### `alpine:init`

<!-- Ensuring a bit of code executes after Alpine is loaded, but BEFORE it initializes itself on the page is a necessary task. -->

<!-- This hook allows you to register custom data, directives, magics, etc. before Alpine does its thing on a page. -->

<!-- You can hook into this point in the lifecycle by listening for an event that Alpine dispatches called: `alpine:init` -->

Alpine がロードされた後に少しのコードが実行されることを確認しますが、ページ上でそれ自体を初期化する前に、必要なタスクです。

このフックを使用すると、Alpine がページ上で処理を実行する前に、カスタムデータ、ディレクティブ、マジックなどを登録できます。

Alpine がディスパッチするイベント `alpine:init` をリッスンすることで、ライフサイクルのこのポイントにフックできます。

```js
document.addEventListener('alpine:init', () => {
    Alpine.data(...)
})
```

<a name="alpine-initialized"></a>

### `alpine:initialized`

<!-- Alpine also offers a hook that you can use to execute code After it's done initializing called `alpine:initialized`: -->

Alpine には、初期化が完了した後に実行できる `alpine:initialized` と呼ばれるフックも用意されています。

```js
document.addEventListener('alpine:initialized', () => {
    //
})
```
