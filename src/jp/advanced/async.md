---
order: 4
title: Async
---

# Async

Alpine is built to support asynchronous functions in most places it supports standard ones.

For example, let's say you have a simple function called `getLabel()` that you use as the input to an `x-text` directive:

非同期

Alpineは、標準の関数をサポートするほとんどの場所で非同期関数をサポートするように構築されています。

たとえば、`x-text`ディレクティブへの入力として使用する`getLabel（）`という単純な関数があるとします。

```js
function getLabel() {
    return 'Hello World!'
}
```
```alpine
<span x-text="getLabel()"></span>
```

Because `getLabel` is synchronous, everything works as expected.

Now let's pretend that `getLabel` makes a network request to retrieve the label and can't return one instantaneously (asynchronous). By making `getLabel` an async function, you can call it from Alpine using JavaScript's `await` syntax.

`getLabel`は同期しているため、すべてが期待どおりに機能します。

ここで、 `getLabel`がラベルを取得するためのネットワーク要求を行い、ラベルを瞬時に返すことができない（非同期）と仮定しましょう。 `getLabel`を非同期関数にすることで、JavaScriptの`await`構文を使用してAlpineから呼び出すことができます。

```js
async function getLabel() {
    let response = await fetch('/api/label')

    return await response.text()
}
```
```alpine
<span x-text="await getLabel()"></span>
```

Additionally, if you prefer calling methods in Alpine without the trailing parenthesis, you can leave them out and Alpine will detect that the provided function is async and handle it accordingly. For example:

さらに、末尾に括弧を付けずにAlpineでメソッドを呼び出す場合は、メソッドを省略できます。Alpineは、提供された関数が非同期であることを検出し、それに応じて処理します。 例えば：

```alpine
<span x-text="getLabel"></span>
```
