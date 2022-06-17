---
order: 2
title: init
---

# x-init

The `x-init` directive allows you to hook into the initialization phase of any element in Alpine.

このx-initディレクティブを使用すると、Alpineの任意の要素の初期化フェーズにフックできます。

```alpine
<div x-init="console.log('I\'m being initialized!')"></div>
```

In the above example, "I\'m being initialized!" will be output in the console before it makes further DOM updates.

Consider another example where `x-init` is used to fetch some JSON and store it in `x-data` before the component is processed.

上記の例では、「初期化中です！」DOMをさらに更新する前に、コンソールに出力されます。

コンポーネントが処理される前に、x-initJSONをフェッチして保存するために使用される別の例を考えてみましょう。x-data

```alpine
<div
    x-data="{ posts: [] }"
    x-init="posts = await (await fetch('/posts')).json()"
>...</div>
```

<a name="next-tick"></a>
## $nextTick

Sometimes, you want to wait until after Alpine has completely finished rendering to execute some code.

This would be something like `useEffect(..., [])` in react, or `mount` in Vue.

By using Alpine's internal `$nextTick` magic, you can make this happen.

場合によっては、Alpineがレンダリングを完全に終了してから、コードを実行するまで待ちたいことがあります。

useEffect(..., [])これは、reactやmountVueのようなものになります。

アルパインの内部$nextTick魔法を使用することで、これを実現できます。

```alpine
<div x-init="$nextTick(() => { ... })"></div>
```

<a name="standalone-x-init"></a>
## Standalone `x-init`

You can add `x-init` to any elements inside or outside an `x-data` HTML block. For example:

HTMLブロックx-initの内側または外側の任意の要素に追加できます。x-data例えば：

```alpine
<div x-data>
    <span x-init="console.log('I can initialize')"></span>
</div>

<span x-init="console.log('I can initialize too')"></span>
```

<a name="auto-evaluate-init-method"></a>
## init() メソッドの自動評価

If the `x-data` object of a component contains an `init()` method, it will be called automatically. For example:

x-dataコンポーネントのオブジェクトにメソッドが含まれている場合、そのオブジェクトはinit()自動的に呼び出されます。例えば：

```alpine
<div x-data="{
    init() {
        console.log('I am called automatically')
    }
}">
    ...
</div>
```

This is also the case for components that were registered using the `Alpine.data()` syntax.

Alpine.data()これは、構文を使用して登録されたコンポーネントにも当てはまります。

```js
Alpine.data('dropdown', () => ({
    init() {
        console.log('I will get evaluated when initializing each "dropdown" component.')
    },
}))
```
