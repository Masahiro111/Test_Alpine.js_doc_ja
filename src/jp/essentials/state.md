---
order: 2
title: State
---

# 状態


状態（Alpine が変更を監視する JavaScript データ）は、Alpine で行うすべてのコアです。ローカルデータを HTML のチャンクに提供することも、それぞれ `x-data` または `Alpine.store()` を使用してページ上のどこでも使用できるようにグローバルに利用できるようにすることもできます。

<!-- State (JavaScript data that Alpine watches for changes) is at the core of everything you do in Alpine. You can provide local data to a chunk of HTML, or make it globally available for use anywhere on a page using `x-data` or `Alpine.store()` respectively. -->

<a name="local-state-x-data"></a>

## ローカル状態

Alpine を使用すると、マークアップを離れることなく、単一の `x-data` 属性でHTMLブロックの状態を宣言できます。

基本的な例は次のとおりです。

<!-- Alpine allows you to declare an HTML block's state in a single `x-data` attribute without ever leaving your markup. -->

<!-- Here's a basic example: -->

```html
<div x-data="{ open: false }">
    ...
</div>
```

<!-- Now any other Alpine syntax on or within this element will be able to access `open`. And like you'd guess, when `open` changes for any reason, everything that depends on it will react automatically. -->

これで、この要素上またはこの要素内の他のAlpine 構文は、`open` にアクセスできるようになります。そして、ご想像のとおり、何らかの理由で「open」が変更されると、それに依存するすべてのものが自動的に反応します。

[→ x-data についてもっと読む](/directives/data)

<a name="nesting-data"></a>

### データのネスト

データはアルパインでネスト可能です。たとえば、Alpine データがアタッチされた2つの要素（一方が他方の内部）がある場合、子要素の内部から親のデータにアクセスできます。

<!-- Data is nestable in Alpine. For example, if you have two elements with Alpine data attached (one inside the other), you can access the parent's data from inside the child element. -->

```html
<div x-data="{ open: false }">
    <div x-data="{ label: 'Content:' }">
        <span x-text="label"></span>
        <span x-show="open"></span>
    </div>
</div>
```

<!-- This is similar to scoping in JavaScript itself (code within a function can access variables declared outside that function.) -->

<!-- Like you may have guessed, if the child has a data property matching the name of a parent's property, the child property will take precedence. -->

これは、JavaScript 自体のスコープに似ています（関数内のコードは、その関数の外部で宣言された変数にアクセスできます）。

ご想像のとおり、子に親のプロパティの名前と一致するデータプロパティがある場合は、子プロパティが優先されます。

<a name="single-element-data"></a>

### 単一要素のデータ

これは一部の人には明白に思えるかもしれませんが、Alpine データを同じ要素内で使用できることは言及する価値があります。例えば：

<!-- Although this may seem obvious to some, it's worth mentioning that Alpine data can be used within the same element. For example: -->

```html
<button x-data="{ label: 'Click Here' }" x-text="label"></button>
```

<a name="data-less-alpine"></a>

### データの記述がない場合

<!-- Sometimes you may want to use Alpine functionality, but don't need any reactive data. In these cases, you can opt out of passing an expression to `x-data` entirely. For example: -->

Alpine 機能を使用したいが、リアクティブデータは必要ない場合があります。このような場合、式を `x-data` に完全に渡すことをオプトアウトできます。例えば：

```html
<button x-data @click="alert('I\'ve been clicked!')">Click Me</button>
```

<a name="re-usable-data"></a>

### 再利用可能なデータ

Alpine を使用する場合、データのチャンクやそれに対応するテンプレートを再利用する必要がある場合があります。

Rails や Laravel などのバックエンドフレームワークを使用している場合、Alpine はまず、HTML のブロック全体をテンプレートの一部またはインクルードに抽出することをお勧めします。

何らかの理由で理想的でない場合、またはバックエンドのテンプレート環境にいない場合、Alpine では、`Alpine.data(...)` を使用して、コンポーネントのデータ部分をグローバルに登録して再利用できます。

<!-- When using Alpine, you may find the need to re-use a chunk of data and/or its corresponding template. -->

<!-- If you are using a backend framework like Rails or Laravel, Alpine first recommends that you extract the entire block of HTML into a template partial or include. -->

<!-- If for some reason that isn't ideal for you or you're not in a back-end templating environment, Alpine allows you to globally register and re-use the data portion of a component using `Alpine.data(...)`. -->

```js
Alpine.data('dropdown', () => ({
    open: false,

    toggle() {
        this.open = ! this.open
    }
}))
```

<!-- Now that you've registered the "dropdown" data, you can use it inside your markup in as many places as you like: -->

「ドロップダウン」データを登録したので、マークアップ内の好きなだけ多くの場所でそれを使用できます。

```html
<div x-data="dropdown">
    <button @click="toggle">Expand</button>

    <span x-show="open">Content...</span>
</div>

<div x-data="dropdown">
    <button @click="toggle">Expand</button>

    <span x-show="open">Some Other Content...</span>
</div>
```

[→ Alpine.data() の使用についてもっと読む](/globals/alpine-data)

<a name="global-state"></a>

## グローバルの状態

ページ上のすべてのコンポーネントでデータを利用できるようにする場合は、Alpine の「グローバルストア」機能を使用して行うことができます。

`Alpine.store(...)` を使用してストアを登録し、魔法の `$store()` メソッドを使用してストアを参照できます。

簡単な例を見てみましょう。まず、ストアをグローバルに登録します。

<!-- If you wish to make some data available to every component on the page, you can do so using Alpine's "global store" feature. -->

<!-- You can register a store using `Alpine.store(...)`, and reference one with the magic `$store()` method. -->

<!-- Let's look at a simple example. First we'll register the store globally: -->

```js
Alpine.store('tabs', {
    current: 'first',

    items: ['first', 'second', 'third'],
})
```

<!-- Now we can access or modify its data from anywhere on our page: -->

これで、ページのどこからでもそのデータにアクセスまたは変更できます。

```html
<div x-data>
    <template x-for="tab in $store.tabs.items">
        ...
    </template>
</div>

<div x-data>
    <button @click="$store.tabs.current = 'first'">First Tab</button>
    <button @click="$store.tabs.current = 'second'">Second Tab</button>
    <button @click="$store.tabs.current = 'third'">Third Tab</button>
</div>
```

[→ Alpine.store() についてもっと読む](/globals/alpine-store)
