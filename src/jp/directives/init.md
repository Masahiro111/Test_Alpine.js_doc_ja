---
order: 2
title: init
---

# x-init

<!-- The `x-init` directive allows you to hook into the initialization phase of any element in Alpine. -->

この `x-init` ディレクティブを使用すると、Alpine の任意の要素の初期化フェーズにフックできます。

```html
<div x-init="console.log('I\'m being initialized!')"></div>
```

<!-- In the above example, "I\'m being initialized!" will be output in the console before it makes further DOM updates. -->

<!-- Consider another example where `x-init` is used to fetch some JSON and store it in `x-data` before the component is processed. -->

上記の例では、「 I\'m being initialized! 」は、DOMが更新される前に、コンソールに出力されます。

コンポーネントが処理される前に、`x-init` を使用してJSON をフェッチし、それを `x-data` に保存する別の例を考えてみましょう。

```html
<div
    x-data="{ posts: [] }"
    x-init="posts = await (await fetch('/posts')).json()"
>...</div>
```

<a name="next-tick"></a>

## $nextTick

<!-- Sometimes, you want to wait until after Alpine has completely finished rendering to execute some code. -->

<!-- This would be something like `useEffect(..., [])` in react, or `mount` in Vue. -->

<!-- By using Alpine's internal `$nextTick` magic, you can make this happen. -->

場合によっては、Alpineがレンダリングを完全に終了してから、コードを実行するまで待ちたいことがあります。

これは、react の `useEffect(..., [])` や Vue の `mount` ようなものになります。

Alpine の内部 $nextTick の魔法を使用することで、これを実現できます。

```html
<div x-init="$nextTick(() => { ... })"></div>
```

<a name="standalone-x-init"></a>

## x-init の設置方法

<!-- You can add `x-init` to any elements inside or outside an `x-data` HTML block. For example: -->

`x-data` のあるHTMLブロックの内側、または外側の任意の要素に `x-init` を追加できます。例えば

```html
<div x-data>
    <span x-init="console.log('I can initialize')"></span>
</div>

<span x-init="console.log('I can initialize too')"></span>
```

<a name="auto-evaluate-init-method"></a>

## init() メソッドの自動評価

<!-- If the `x-data` object of a component contains an `init()` method, it will be called automatically. For example: -->

コンポーネントの `x-data` オブジェクトに `init()` メソッドが含まれている場合、そのオブジェクトは自動的に呼び出されます。 例えば

```html
<div x-data="{
    init() {
        console.log('I am called automatically')
    }
}">
    ...
</div>
```

<!-- This is also the case for components that were registered using the `Alpine.data()` syntax. -->

これは、`Alpine.data()` 構文を使用して登録されたコンポーネントにも当てはまります。

```js
Alpine.data('dropdown', () => ({
    init() {
        console.log('I will get evaluated when initializing each "dropdown" component.')
    },
}))
```
