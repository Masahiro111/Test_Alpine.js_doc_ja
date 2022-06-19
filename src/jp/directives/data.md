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

Properties defined in an `x-data` directive are available to all element children. Even ones inside other, nested `x-data` components.

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

Because `x-data` is evaluated as a normal JavaScript object, in addition to state, you can store methods and even getters.

For example, let's extract the "Toggle Content" behavior into a method on  `x-data`.

`x-data` は通常の JavaScript オブジェクトとして評価されるため、状態に加えて、メソッドやゲッターを保存することもできます。

たとえば、「コンテンツの切り替え」動作をのメソッドに抽出してみましょう x-data。

```alpine
<div x-data="{ open: false, toggle() { this.open = ! this.open } }">
    <button @click="toggle()">Toggle Content</button>

    <div x-show="open">
        Content...
    </div>
</div>
```

Notice the added `toggle() { this.open = ! this.open }` method on `x-data`. This method can now be called from anywhere inside the component.

You'll also notice the usage of `this.` to access state on the object itself. This is because Alpine evaluates this data object like any standard JavaScript object with a `this` context.

If you prefer, you can leave the calling parenthesis off of the `toggle` method completely. For example:

に追加されたtoggle() { this.open = ! this.open }メソッドに注意してくださいx-data。このメソッドは、コンポーネント内のどこからでも呼び出すことができるようになりました。

this.また、オブジェクト自体の状態にアクセスするためのの使用法にも気付くでしょう。これは、Alpineがこのデータオブジェクトを、thisコンテキストを持つ標準のJavaScriptオブジェクトと同じように評価するためです。

必要に応じて、呼び出し元の括弧をtoggleメソッドから完全に省略できます。例えば：

```alpine
<!-- Before -->
<button @click="toggle()">...</button>

<!-- After -->
<button @click="toggle">...</button>
```

<a name="getters"></a>

## Getters

JavaScript [getters](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get) are handy when the sole purpose of a method is to return data based on other state.

Think of them like "computed properties" (although, they are not cached like Vue's computed properties).

Let's refactor our component to use a getter called `isOpen` instead of accessing `open` directly.

ゲッター
JavaScriptゲッターは、メソッドの唯一の目的が他の状態に基づいてデータを返すことである場合に便利です。

それらを「計算されたプロパティ」のように考えてください（ただし、Vueの計算されたプロパティのようにキャッシュされません）。

コンポーネントをリファクタリングして、直接isOpenアクセスする代わりに呼び出されるゲッターを使用してみましょう。open

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

Notice the "Content" now depends on the `isOpen` getter instead of the `open` property directly.

In this case there is no tangible benefit. But in some cases, getters are helpful for providing a more expressive syntax in your components.

「コンテンツ」は、プロパティisOpenではなくゲッターに直接依存するようになっていることに注意してください。open

この場合、具体的なメリットはありません。ただし、場合によっては、ゲッターがコンポーネントでより表現力豊かな構文を提供するのに役立つことがあります。

<a name="data-less-components"></a>

## Data-less components

Occasionally, you want to create an Alpine component, but you don't need any data.

In these cases, you can always pass in an empty object.

データレスコンポーネント
Alpineコンポーネントを作成したい場合がありますが、データは必要ありません。

このような場合、いつでも空のオブジェクトを渡すことができます。

```alpine
<div x-data="{}">
```

However, if you wish, you can also eliminate the attribute value entirely if it looks better to you.

ただし、必要に応じて、見栄えがよい場合は属性値を完全に削除することもできます。

```alpine
<div x-data>
```

<a name="single-element-components"></a>

## 単一要素コンポーネント

Sometimes you may only have a single element inside your Alpine component, like the following:

次のように、Alpineコンポーネント内に要素が1つしかない場合があります。

```alpine
<div x-data="{ open: true }">
    <button @click="open = false" x-show="open">Hide Me</button>
</div>
```

In these cases, you can declare `x-data` directly on that single element:

このような場合、x-dataその単一の要素で直接宣言できます。

```alpine
<button x-data="{ open: true }" @click="open = false" x-show="open">
    Hide Me
</button>
```

<a name="re-usable-data"></a>

## Re-usable Data

If you find yourself duplicating the contents of `x-data`, or you find the inline syntax verbose, you can extract the `x-data` object out to a dedicated component using `Alpine.data`.

再利用可能なデータ
の内容を複製している場合x-data、またはインライン構文が冗長である場合は、をx-data使用してオブジェクトを専用コンポーネントに抽出できますAlpine.data。

Here's a quick example:

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

[→ Read more about `Alpine.data(...)`](/globals/alpine-data)


→詳細を読むAlpine.data(...)