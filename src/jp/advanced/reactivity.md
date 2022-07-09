---
order: 1
title: Reactivity
---

# Reactivity ( 反応性 )

Alpine は、データを変更すると、そのデータに依存するすべてのものがその変更に自動的に「反応」するという意味で「反応的」です。

アルパインで発生する反応性のすべてのビットは、アルパインのコアの2つの非常に重要な反応性関数、`Alpine.reactive()` と `Alpine.effect()` のために発生します。

> Alpine は、これらの機能を提供するために、内部で VueJS の反応性エンジンを使用しています。
> [→ @vue/reactivity についてもっと読む](https://github.com/vuejs/vue-next/tree/master/packages/reactivity)

これらの2つの機能を理解すると、Alpine 開発者としてだけでなく、一般的な Web 開発者としても非常に強力になります。

<!-- Alpine is "reactive" in the sense that when you change a piece of data, everything that depends on that data "reacts" automatically to that change.

Every bit of reactivity that takes place in Alpine, happens because of two very important reactive functions in Alpine's core: `Alpine.reactive()`, and `Alpine.effect()`.

> Alpine uses VueJS's reactivity engine under the hood to provide these functions.
> [→ Read more about @vue/reactivity](https://github.com/vuejs/vue-next/tree/master/packages/reactivity)

Understanding these two functions will give you super powers as an Alpine developer, but also just as a web developer in general. -->

<a name="alpine-reactive"></a>

## Alpine.reactive()

<!-- Let's first look at `Alpine.reactive()`. This function accepts a JavaScript object as its parameter and returns a "reactive" version of that object. For example: -->

まず、`Alpine.reactive()` を見てみましょう。この関数は、JavaScriptオブジェクトをパラメーターとして受け入れ、そのオブジェクトの「リアクティブ」バージョンを返します。例えば：

```js
let data = { count: 1 }

let reactiveData = Alpine.reactive(data)
```

<!-- Under the hood, when `Alpine.reactive` receives `data`, it wraps it inside a custom JavaScript proxy. -->

<!-- A proxy is a special kind of object in JavaScript that can intercept "get" and "set" calls to a JavaScript object. -->

<!-- [→ Read more about JavaScript proxies](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy) -->

<!-- At face value, `reactiveData` should behave exactly like `data`. For example: -->

内部的には、`Alpine.reactive`が`data`を受信すると、カスタムJavaScriptプロキシ内にラップします。

プロキシはJavaScriptの特殊な種類のオブジェクトであり、JavaScriptオブジェクトへの「get」および「set」呼び出しをインターセプトできます。

[→ JavaScript プロキシの詳細を読む](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Proxy)

額面どおり、`reactiveData` は `data` とまったく同じように動作する必要があります。例えば：

```js
console.log(data.count) // 1
console.log(reactiveData.count) // 1

reactiveData.count = 2

console.log(data.count) // 2
console.log(reactiveData.count) // 2
```

<!-- What you see here is that because `reactiveData` is a thin wrapper around `data`, any attempts to get or set a property will behave exactly as if you had interacted with `data` directly. -->

<!-- The main difference here is that any time you modify or retrieve (get or set) a value from `reactiveData`, Alpine is aware of it and can execute any other logic that depends on this data. -->

<!-- `Alpine.reactive` is only the first half of the story. `Alpine.effect` is the other half, let's dig in. -->

ここに表示されるのは、`reactiveData` は `data` の薄いラッパーであるため、プロパティを取得または設定しようとすると、`data` を直接操作した場合とまったく同じように動作することです。

ここでの主な違いは、`reactiveData` から値を変更または取得（取得または設定）するときはいつでも、Alpine はそれを認識し、このデータに依存する他のロジックを実行できることです。

`Alpine.reactive` は物語の前半に過ぎません。`Alpine.effect` は残りの半分です、掘り下げましょう。


<a name="alpine-effect"></a><a name="alpine-effect"></a>

## Alpine.effect()

<!-- `Alpine.effect` accepts a single callback function. As soon as `Alpine.effect` is called, it will run the provided function, but actively look for any interactions with reactive data. If it detects an interaction (a get or set from the aforementioned reactive proxy) it will keep track of it and make sure to re-run the callback if any of reactive data changes in the future. For example: -->

`Alpine.effect` は単一のコールバック関数を受け入れます。 `Alpine.effect` が呼び出されるとすぐに、提供された関数を実行しますが、リアクティブデータとの相互作用を積極的に探します。インタラクション（前述のリアクティブプロキシからの取得または設定）を検出すると、それを追跡し、リアクティブデータのいずれかが将来変更された場合は、必ずコールバックを再実行します。例えば：

```js
let data = Alpine.reactive({ count: 1 })

Alpine.effect(() => {
    console.log(data.count)
})
```

このコードを最初に実行すると、「1」がコンソールに記録されます。 `data.count` が変更されるたびに、その値が再びコンソールに記録されます。

これは、アルパインのコアですべての反応性を解き放つメカニズムです。

ドットをさらに接続するために、Alpine構文をまったく使用せず、`Alpine.reactive` と `Alpine.effect` のみを使用した単純な「counter」コンポーネントの例を見てみましょう。

<!-- When this code is first run, "1" will be logged to the console. Any time `data.count` changes, it's value will be logged to the console again. -->

<!-- This is the mechanism that unlocks all of the reactivity at the core of Alpine. -->

<!-- To connect the dots further, let's look at a simple "counter" component example without using Alpine syntax at all, only using `Alpine.reactive` and `Alpine.effect`: -->

```html
<button>Increment</button>

Count: <span></span>
```
```js
let button = document.querySelector('button')
let span = document.querySelector('span')

let data = Alpine.reactive({ count: 1 })

Alpine.effect(() => {
    span.textContent = data.count
})

button.addEventListener('click', () => {
    data.count = data.count + 1
})
```

```html
<!-- START_VERBATIM -->
<div x-data="{ count: 1 }" class="demo">
    <button @click="count++">Increment</button>

    <div>Count: <span x-text="count"></span></div>
</div>
<!-- END_VERBATIM -->
```

<!-- As you can see, you can make any data reactive, and you can also wrap any functionality in `Alpine.effect`. -->

<!-- This combination unlocks an incredibly powerful programming paradigm for web development. Run wild and free. -->

ご覧のとおり、任意のデータをリアクティブにすることができ、`Alpine.effect` で任意の機能をラップすることもできます。

この組み合わせにより、Web 開発のための非常に強力なプログラミングパラダイムが解き放たれます。ワイルドで自由に走りましょう。