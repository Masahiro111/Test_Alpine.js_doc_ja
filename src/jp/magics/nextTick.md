---
order: 6
prefix: $
title: nextTick
---

# $nextTick

<!-- `$nextTick` is a magic property that allows you to only execute a given expression AFTER Alpine has made its reactive DOM updates. This is useful for times you want to interact with the DOM state AFTER it's reflected any data updates you've made. -->

`$nextTick` は、Alpine がリアクティブ DOM を更新した後でのみ、特定の式を実行できるようにする魔法のプロパティです。これは、行ったデータ更新が反映された後に DOM 状態を操作する場合に役立ちます。

```html
<div x-data="{ title: 'Hello' }">
    <button
        @click="
            title = 'Hello World!';
            $nextTick(() => { console.log($el.innerText) });
        "
        x-text="title"
    ></button>
</div>
```

In the above example, rather than logging "Hello" to the console, "Hello World!" will be logged because `$nextTick` was used to wait until Alpine was finished updating the DOM.

上記の例では 「Hello」をコンソールに記録するのではなく 「HelloWorld！」 Alpine がDOMの更新を完了するまで待機するために`$nextTick` が使用されたため、ログに記録されます。

<a name="promises"></a>

## Promises

`$ nextTick`はpromiseを返し、`$nextTick`を使用してdomの更新が保留されるまで非同期関数を一時停止できるようにします。このように使用する場合、`$nextTick`も引数を渡す必要はありません。

`$nextTick` returns a promise, allowing the use of `$nextTick` to pause an async function until after pending dom updates. When used like this, `$nextTick` also does not require an argument to be passed.

```html
<div x-data="{ title: 'Hello' }">
    <button
        @click="
            title = 'Hello World!';
            await $nextTick();
            console.log($el.innerText);
        "
        x-text="title"
    ></button>
</div>
```
