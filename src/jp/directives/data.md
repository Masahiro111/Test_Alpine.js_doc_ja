---
order: 1
title: data
---

# x-data

<!-- Everything in Alpine starts with the `x-data` directive. -->

<!-- `x-data` defines a chunk of HTML as an Alpine component and provides the reactive data for that component to reference. -->

Alpine のすべては、`x-data` ディレクティブから始まります。

`x-data` は、HTMLのチャンクを Alpine コンポーネントとして定義し、そのコンポーネントが参照するためのリアクティブデータを提供します。

考案されたドロップダウンコンポーネントの例を次に示します。

<!-- Here's an example of a contrived dropdown component: -->

```alpine
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle Content</button>

    <div x-show="open">
        Content...
    </div>
</div>
```

<!-- Don't worry about the other directives in this example (`@click` and `x-show`), we'll get to those in a bit. For now, let's focus on `x-data`. -->

この例の「`@click` および `x-show`」などのディレクティブについては心配しないでください。これらについては後で説明します。今は `x-data` に焦点を当てましょう。

<a name="scope"></a>

## スコープ

<!-- Properties defined in an `x-data` directive are available to all element children. Even ones inside other, nested `x-data` components. -->

`x-data` ディレクティブで定義されたプロパティは、すべての要素の子で使用できます。他のネストされた `x-data` コンポーネントも同様です。

<!-- For example: -->

例えば：

```alpine
<div x-data="{ foo: 'bar' }">
    <span x-text="foo"><!-- Will output: "bar" --></span>

    <div x-data="{ bar: 'baz' }">
        <span x-text="foo"><!-- Will output: "bar" --></span>

        <div x-data="{ foo: 'bob' }">
            <span x-text="foo"><!-- Will output: "bob" --></span>
        </div>
    </div>
</div>
```

<a name="methods"></a>

## メソッド

<!-- Because `x-data` is evaluated as a normal JavaScript object, in addition to state, you can store methods and even getters. -->

<!-- For example, let's extract the "Toggle Content" behavior into a method on  `x-data`. -->

`x-data`は通常の JavaScript オブジェクトとして評価されるため、状態に加えて、メソッドやゲッターを保存することもできます。

たとえば、「Toggle Content」の動作を`x-data`のメソッドに抽出してみましょう。

```alpine
<div x-data="{ open: false, toggle() { this.open = ! this.open } }">
    <button @click="toggle()">Toggle Content</button>

    <div x-show="open">
        Content...
    </div>
</div>
```

<!-- Notice the added `toggle() { this.open = ! this.open }` method on `x-data`. This method can now be called from anywhere inside the component. -->

<!-- You'll also notice the usage of `this.` to access state on the object itself. This is because Alpine evaluates this data object like any standard JavaScript object with a `this` context. -->

<!-- If you prefer, you can leave the calling parenthesis off of the `toggle` method completely. For example: -->

`x-data`に追加された `toggle() { this.open = ! this.open }` メソッドに注目してください。このメソッドは、コンポーネント内のどこからでも呼び出すことができるようになりました。

また、オブジェクト自体の状態にアクセスするための`this.` の使用法にも気付くでしょう。これは、Alpine が `this` コンテキストを持つ標準の JavaScript オブジェクトと同様にこのデータオブジェクトを評価するためです。

必要に応じて、呼び出し括弧を`toggle`メソッドから完全に省略できます。例えば：

```alpine
<!-- Before -->
<button @click="toggle()">...</button>

<!-- After -->
<button @click="toggle">...</button>
```

<a name="getters"></a>

## ゲッター

<!-- JavaScript [getters](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get) are handy when the sole purpose of a method is to return data based on other state. -->

<!-- Think of them like "computed properties" (although, they are not cached like Vue's computed properties). -->

<!-- Let's refactor our component to use a getter called `isOpen` instead of accessing `open` directly. -->

JavaScript の [ゲッター](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get) は、メソッドの唯一の目的が他の状態に基づいてデータを返すことである場合に便利です。

それらを「計算されたプロパティ」のように考えてください（ただし、Vue の計算されたプロパティのようにキャッシュされません）。

コンポーネントをリファクタリングして、`open` に直接アクセスする代わりに `isOpen` と呼び出されるゲッターを使用してみましょう。

```alpine
<div x-data="{
  open: false,
  get isOpen() { return this.open },
  toggle() { this.open = ! this.open },
}">
    <button @click="toggle()">Toggle Content</button>

    <div x-show="isOpen">
        Content...
    </div>
</div>
```

<!-- Notice the "Content" now depends on the `isOpen` getter instead of the `open` property directly. -->

<!-- In this case there is no tangible benefit. But in some cases, getters are helpful for providing a more expressive syntax in your components. -->

「`Content`」が `open` プロパティではなく `isOpen` ゲッターに直接依存するようになったことに注意してください。

この場合、具体的なメリットはありません。ただし、場合によっては、ゲッターがコンポーネントでより表現力豊かな構文を提供するのに役立つことがあります。


<a name="data-less-components"></a>

## データのないコンポーネント

<!-- Occasionally, you want to create an Alpine component, but you don't need any data. -->

<!-- In these cases, you can always pass in an empty object. -->

Alpine コンポーネントを作成したい場合がありますが、データは必要ありません。

このような場合、いつでも空のオブジェクトを渡すことができます。

```alpine
<div x-data="{}">
```

<!-- However, if you wish, you can also eliminate the attribute value entirely if it looks better to you. -->

ただし、必要に応じて、見栄えがよい場合は属性値を完全に削除することもできます。

```alpine
<div x-data>
```

<a name="single-element-components"></a>

## 単一要素コンポーネント

<!-- Sometimes you may only have a single element inside your Alpine component, like the following: -->

次のように、Alpine コンポーネント内に要素が1つしかない場合があります。

```alpine
<div x-data="{ open: true }">
    <button @click="open = false" x-show="open">Hide Me</button>
</div>
```

<!-- In these cases, you can declare `x-data` directly on that single element: -->

このような場合、その単一の要素で `x-data` を直接宣言できます。

```alpine
<button x-data="{ open: true }" @click="open = false" x-show="open">
    Hide Me
</button>
```

<a name="re-usable-data"></a>

## 再利用可能なデータ

<!-- If you find yourself duplicating the contents of `x-data`, or you find the inline syntax verbose, you can extract the `x-data` object out to a dedicated component using `Alpine.data`. -->

`x-data` の内容を複製している場合、またはインライン構文が冗長である場合は、`Alpine.data` を使用して `x-data` オブジェクトを専用コンポーネントに抽出できます

<!-- Here's a quick example: -->

簡単な例を次に示します。

```alpine
<div x-data="dropdown">
    <button @click="toggle">Toggle Content</button>

    <div x-show="open">
        Content...
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,

            toggle() {
                this.open = ! this.open
            },
        }))
    })
</script>
```

[→ `Alpine.data(...)`の詳細を読む](/globals/alpine-data)
