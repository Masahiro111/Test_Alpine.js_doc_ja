---
order: 1
title: Alpine.js をはじめよう！
---

# Alpine.js をはじめよう

<!-- Create a blank HTML file somewhere on your computer with a name like: `i-love-alpine.html` -->

まず、空の HTML ファイルを好きな場所に作成して、`i-love-alpine.html` と名前を付けましょう。

<!-- Using a text editor, fill the file with these contents: -->

テキストエディターを使用して、以下のようにファイル内を埋めてください。

```alpine
<html>
<head>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    <h1 x-data="{ message: 'I ❤️ Alpine' }" x-text="message"></h1>
</body>
</html>
```

<!-- Open your file in a web browser, if you see `I ❤️ Alpine`, you're ready to rumble! -->

ブラウザを開いたて、`I ❤️ Alpine` と表示されたら準備完了です！

<!-- Now that you're all set up to play around, let's look at three practical examples as a foundation for teaching you the basics of Alpine. By the end of this exercise, you should be more than equipped to start building stuff on your own. Let's goooooo. -->

<!-- START_VERBATIM -->
<!-- <ul class="flex flex-col space-y-2 list-inside !list-decimal">
    <li><a href="#building-a-counter">Building a counter</a></li>
    <li><a href="#building-a-dropdown">Building a dropdown</a></li>
    <li><a href="#building-a-search-input">Building a search Input</a></li>
</ul> -->
<!-- END_VERBATIM -->

準備が整ったので、Alpine の基本を学ぶために、3つの実用的な例を見てみましょう。この演習が終了するまでに、自分で作成を開始する準備が整っているはずです。

<ul class="flex flex-col space-y-2 list-inside !list-decimal">
    <li><a href="#building-a-counter">カウンターの構築</a></li>
    <li><a href="#building-a-dropdown">ドロップダウンの作成</a></li>
    <li><a href="#building-a-search-input">検索入力の作成</a></li>
</ul>

<a name="building-a-counter"></a>

## カウンターの構築

<!-- Let's start with a simple "counter" component to demonstrate the basics of state and event listening in Alpine, two core features. -->

単純な「カウンター」コンポーネントから始めて、2つのコア機能である Alpine での基本の状態とイベントリスニングを示しましょう。

<!-- Insert the following into the `<body>` tag: -->

`<body>` タグに以下を挿入します。

```alpine
<div x-data="{ count: 0 }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ count: 0 }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>
</div>
<!-- END_VERBATIM -->

<!-- Now, you can see with 3 bits of Alpine sprinkled into this HTML, we've created an interactive "counter" component. -->

<!-- Let's walk through what's happening briefly: -->

これで、このHTMLに 3つのAlpine が散りばめられていることがわかります。これで、インタラクティブな「カウンター」コンポーネントが作成されました。

何が起こっているのかを簡単に見ていきましょう。

<a name="declaring-data"></a>

### データの宣言

```alpine
<div x-data="{ count: 0 }">
```

<!-- Everything in Alpine starts with an `x-data` directive. Inside of `x-data`, in plain JavaScript, you declare an object of data that Alpine will track. -->

<!-- Every property inside this object will be made available to other directives inside this HTML element. In addition, when one of these properties changes, everything that relies on it will change as well. -->


Alpine.js のすべては `x-data` ディレクティブで始まります。プレーンな JavaScript を含んでいる `x-data` の内部で、Alpine.js が追跡するデータのオブジェクトを宣言します。

このオブジェクト内のすべてのプロパティは、この HTML 要素内の他のディレクティブで使用できるようになります。さらに、これらのプロパティの1つが変更されると、それに依存するすべてのものも変更されます。

[→「x-data」の詳細を読む](/directives/data)


Let's look at `x-on` and see how it can access and modify the `count` property from above:

上記コードを参考に、`count` プロパティを変更する方法を `x-on`を利用して学んでいきましょう。

<a name="listening-for-events"></a>

### イベントリスナー

```alpine
<button x-on:click="count++">Increment</button>
```

<!-- `x-on` is a directive you can use to listen for any event on an element. We're listening for a `click` event in this case, so ours looks like `x-on:click`. -->

<!-- You can listen for other events as you'd imagine. For example, listening for a `mouseenter` event would look like this: `x-on:mouseenter`. -->

<!-- When a `click` event happens, Alpine will call the associated JavaScript expression, `count++` in our case. As you can see, we have direct access to data declared in the `x-data` expression. -->

`x-on` は、要素のイベントをリッスンするために使用できるディレクティブです。この場合、`click` イベントをリッスンしているので、`x-on:click` のようになります。

あなたが想像するように、あなたは他のイベントをリッスンすることができます。たとえば、`mouseenter` イベントをリッスンすると、`x-on:mouseenter` のようになります。

`click` イベントが発生すると、Alpine は関連する JavaScript 式を呼び出します（今回の例では、`count++`）。ご覧のとおり、 `x-data` 式で宣言されたデータに直接アクセスできます。

<!-- > You will often see `@` instead of `x-on:`. This is a shorter, friendlier syntax that many prefer. From now on, this documentation will likely use `@` instead of `x-on:`. -->

> `x-on:` の代わりに `@` を使用することもできます。これは、多くの人が好む、短くて親しみやすい構文です。今後、このドキュメントでは`x-on` の代わりに `@` を使用することもあります。

[→ 「x-on」の詳細を読む](/directives/on)

<a name="reacting-to-changes"></a>

### 変化への対応

```alpine
<h1 x-text="count"></h1>
```

<!-- `x-text` is an Alpine directive you can use to set the text content of an element to the result of a JavaScript expression. -->

<!-- In this case, we're telling Alpine to always make sure that the contents of this `h1` tag reflect the value of the `count` property. -->

<!-- In case it's not clear, `x-text`, like most directives accepts a plain JavaScript expression as an argument. So for example, you could instead set its contents to: `x-text="count * 2"` and the text content of the `h1` will now always be 2 times the value of `count`. -->

`x-text` は、要素のテキストコンテンツを JavaScript 式の結果に設定するために使用できる Alpine のディレクティブです。

この場合、この `h1` タグの内容が `count` プロパティの値を反映していることを常に確認するように Alpine に指示しています。

`x-text` は、引数に JavaScript 式を受け入れることができます。たとえば、内容を `x-text="count * 2"` に設定すると、`h1` のテキストの内容は常に `count` の値の2倍になります。

[→ 「x-text」の詳細を読む](/directives/text)

<a name="building-a-dropdown"></a>

## ドロップダウンの作成

<!-- Now that we've seen some basic functionality, let's keep going and look at an important directive in Alpine: `x-show`, by building a contrived "dropdown" component. -->

<!-- Insert the following code into the `<body>` tag: -->

いくつかの基本的な機能を確認したので、続けて、Alpine の重要な `x-show` ディレクティブを見てみましょう。今回は「ドロップダウン」コンポーネントを作成してみます。

次のコードを `body` タグに挿入してください。

```alpine
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <div x-show="open" @click.outside="open = false">Contents...</div>
</div>
```

<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>
        <div x-show="open" @click.outside="open = false">Contents...</div>
    </div>
</div>
<!-- END_VERBATIM -->

<!-- If you load this component, you should see that the "Contents..." are hidden by default. You can toggle showing them on the page by clicking the "Toggle" button. -->

<!-- The `x-data` and `x-on` directives should be familiar to you from the previous example, so we'll skip those explanations. -->

このコンポーネントをロードすると、「Contents...」がデフォルトで非表示になっていることがわかります。「Toggle」ボタンをクリックすると、ページの表示を切り替えることができます。

`x-data` と `x-on` ディレクティブは前の例でおなじみのはずなので、これらの説明はスキップします。

<a name="toggling-elements"></a>

### 要素の切り替え

```alpine
<div x-show="open" ...>Contents...</div>
```

<!-- `x-show` is an extremely powerful directive in Alpine that can be used to show and hide a block of HTML on a page based on the result of a JavaScript expression, in our case: `open`. -->

`x-show` は Alpine の非常に強力なディレクティブであり、JavaScript 式の結果に基づいてページ上の HTML のブロックを表示および非表示にするために使用できます。この場合は次のようになります。

[→ 「x-show」の詳細を読む](/directives/show)

<a name="listening-for-a-click-outside"></a>

### クリックの外側でのリスナー

```alpine
<div ... @click.outside="open = false">Contents...</div>
```

<!-- You'll notice something new in this example: `.outside`. Many directives in Alpine accept "modifiers" that are chained onto the end of the directive and are separated by periods. -->

<!-- In this case, `.outside` tells Alpine to instead of listening for a click INSIDE the `<div>`, to listen for the click only if it happens OUTSIDE the `<div>`. -->

<!-- This is a convenience helper built into Alpine because this is a common need and implementing it by hand is annoying and complex. -->

<!-- [→ 「x-on」の詳細を読む](/directives/on#modifiers) -->

この例では、何か新しいことに気付くでしょう（`.outside`）。Alpineの多くのディレクティブは、ディレクティブの最後にチェーンされ、ピリオドで区切られた **「修飾子」** を付け加えることができます。

この場合、`.outside` は、Alpineに対して `<div>` の内側でクリックをリッスンする代わりに、`<div>` の外側でクリックが発生した場合にのみクリックをリッスンするように指示します。

これは Alpine に組み込まれている便利なヘルパーです。これは一般的なニーズであり、手動で実装するのは面倒で複雑だからです。

[→ 「x-on」の修飾子の詳細を読む](/directives/on#modifiers)

<a name="building-a-search-input"></a>

## 検索入力の作成

<!-- Let's now build a more complex component and introduce a handful of other directives and patterns. -->

<!-- Insert the following code into the `<body>` tag: -->

次に、より複雑なコンポーネントを作成し、他のいくつかのディレクティブとパターンを紹介しましょう。

次のコードを `<body>` タグに挿入します。

```alpine
<div
    x-data="{
        search: '',

        items: ['foo', 'bar', 'baz'],

        get filteredItems() {
            return this.items.filter(
                i => i.startsWith(this.search)
            )
        }
    }"
>
    <input x-model="search" placeholder="Search...">

    <ul>
        <template x-for="item in filteredItems" :key="item">
            <li x-text="item"></li>
        </template>
    </ul>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div
        x-data="{
            search: '',

            items: ['foo', 'bar', 'baz'],

            get filteredItems() {
                return this.items.filter(
                    i => i.startsWith(this.search)
                )
            }
        }"
    >
        <input x-model="search" placeholder="Search...">

        <ul class="pl-6 pt-2">
            <template x-for="item in filteredItems" :key="item">
                <li x-text="item"></li>
            </template>
        </ul>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- By default, all of the "items" (foo, bar, and baz) will be shown on the page, but you can filter them by typing into the text input. As you type, the list of items will change to reflect what you're searching for. -->

<!-- Now there's quite a bit happening here, so let's go through this snippet piece by piece. -->

デフォルトでは、すべての「アイテム」（foo、bar、および baz）がページに表示されますが、テキスト入力に入力することでそれらをフィルタリングできます。入力すると、アイテムのリストが変更され、検索内容が反映されます。

ここではかなりのことが起こっているので、このスニペットを少しずつ見ていきましょう。

<a name="multi-line-formatting"></a>

### 複数行のフォーマット

<!-- The first thing I'd like to point out is that `x-data` now has a lot more going on in it than before. To make it easier to write and read, we've split it up into multiple lines in our HTML. This is completely optional and we'll talk more in a bit about how to avoid this problem altogether, but for now, we'll keep all of this JavaScript directly in the HTML. -->

私が最初に指摘したいのは、今回の `x-data` は、以前よりも多くのことが起こっているということです。書き込みと読み取りを簡単にするために、HTML では複数の行に分割しています。これは完全にオプションであり、この問題を完全に回避する方法についてもう少し詳しく説明しますが、今のところ、この JavaScript をすべて HTML 内に直接保持します。

<a name="binding-to-inputs"></a>

### 入力値へのバインド

```alpine
<input x-model="search" placeholder="Search...">
```

<!-- You'll notice a new directive we haven't seen yet: `x-model`. -->

<!-- `x-model` is used to "bind" the value of an input element with a data property: "search" from `x-data="{ search: '', ... }"` in our case. -->

<!-- This means that anytime the value of the input changes, the value of "search" will change to reflect that. -->

<!-- `x-model` is capable of much more than this simple example. -->

<!-- [→ Read more about `x-model`](/directives/model) -->

まだ見たことがない `x-model` という新しいディレクティブに気付くでしょう。

`x-model` は、input 要素の値をデータプロパティに「バインド」するために使用されます。今回の x-model の `search` は `x-data="{ search: '', ... }"` から来ています。

これは、入力の値が変更されるたびに、「search」の値がそれを反映して変更されることを意味します。

`x-model` は、この単純な例よりもはるかに多くのことができます。

[→ 「x-model」の詳細を読む](/directives/model)

<a name="computed-properties-using-getters"></a>

### ゲッターを使用して計算されたプロパティ

<!-- The next bit I'd like to draw your attention to is the `items` and `filteredItems` properties from the `x-data` directive. -->

次に注目したいのは、`x-data` ディレクティブの`items` と `filteredItems` プロパティです。

```js
{
    ...
    items: ['foo', 'bar', 'baz'],

    get filteredItems() {
        return this.items.filter(
            i => i.startsWith(this.search)
        )
    }
}
```

<!-- The `items` property should be self-explanatory. Here we are setting the value of `items` to a JavaScript array of 3 different items (foo, bar, and baz). -->

<!-- The interesting part of this snippet is the `filteredItems` property. -->

<!-- Denoted by the `get` prefix for this property, `filteredItems` is a "getter" property in this object. This means we can access `filteredItems` as if it was a normal property in our data object, but when we do, JavaScript will evaluate the provided function under the hood and return the result. -->

<!-- It's completely acceptable to forgo the `get` and just make this a method that you can call from the template, but some prefer the nicer syntax of the getter. -->

<!-- [→ Read more about JavaScript getters](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get) -->

<!-- Now let's look inside the `filteredItems` getter and make sure we understand what's going on there: -->

`items` プロパティは自明である必要があります。ここでは、`items`の値を3つの異なるアイテム（foo、bar、baz）の JavaScript 配列として設定しています。

このスニペットの興味深い部分は `filteredItems` プロパティです。

このプロパティの `get` プレフィックスで示される `filteredItems` は、このオブジェクトの「getter」プロパティです。これは、データオブジェクトの通常のプロパティであるかのように `filteredItems` にアクセスできることを意味しますが、アクセスすると、JavaScript は内部で提供された関数を評価し、結果を返します。

`get` を省略して、これをテンプレートから呼び出すことができるメソッドにすることは完全に許容されますが、ゲッターのより優れた構文を好む人もいます。

[→ JavaScriptゲッターについてもっと読む](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get)

それでは、`filteredItems` ゲッターの内部を見て、そこで何が起こっているのかを理解していることを確認しましょう。

```js
return this.items.filter(
    i => i.startsWith(this.search)
)
```

<!-- This is all plain JavaScript. We are first getting the array of items (foo, bar, and baz) and filtering them using the provided callback: `i => i.startsWith(this.search)`. -->

<!-- By passing in this callback to `filter`, we are telling JavaScript to only return the items that start with the string: `this.search`, which like we saw with `x-model` will always reflect the value of the input. -->

You may notice that up until now, we haven't had to use `this.` to reference properties. However, because we are working directly inside the `x-data` object, we must reference any properties using `this.[property]` instead of simply `[property]`.

Because Alpine is a "reactive" framework. Any time the value of `this.search` changes, parts of the template that use `filteredItems` will automatically be updated.

これはすべてプレーンな JavaScript です。まず、アイテムの配列（foo、bar、baz）を取得し、提供されたコールバックを使用してそれらをフィルタリングします。「`i => i.startsWith(this.search)`」

このコールバックを `filter` に渡すことで、JavaScriptに文字列 `this.search` で始まるアイテムのみを返すように指示しています。これは、`x-model` で見たように、常に入力の値を反映します。

これまで、プロパティを参照するために`this。`を使用する必要がなかったことにお気づきかもしれません。 ただし、 `x-data`オブジェクト内で直接作業しているため、単に`[property]`ではなく`this。[property]`を使用してプロパティを参照する必要があります。

アルパインは「リアクティブ」フレームワークだからです。 `this.search`の値が変更されるたびに、`filteredItems`を使用するテンプレートの部分が自動的に更新されます。

<a name="looping-elements"></a>

### ループ要素

Now that we understand the data part of our component, let's understand what's happening in the template that allows us to loop through `filteredItems` on the page.

コンポーネントのデータ部分を理解したので、ページ上の`filteredItems`をループできるようにするテンプレートで何が起こっているのかを理解しましょう。

```alpine
<ul>
    <template x-for="item in filteredItems">
        <li x-text="item"></li>
    </template>
</ul>
```

The first thing to notice here is the `x-for` directive. `x-for` expressions take the following form: `[item] in [items]` where [items] is any array of data, and [item] is the name of the variable that will be assigned to an iteration inside the loop.

Also notice that `x-for` is declared on a `<template>` element and not directly on the `<li>`. This is a requirement of using `x-for`. It allows Alpine to leverage the existing behavior of `<template>` tags in the browser to its advantage.

Now any element inside the `<template>` tag will be repeated for every item inside `filteredItems` and all expressions evaluated inside the loop will have direct access to the iteration variable (`item` in this case).

[→ Read more about `x-for`](/directives/for)

ここで最初に気付くのは、`x-for`ディレクティブです。 `x-for`式は次の形式を取ります。`[items]in[items] `ここで、[items]はデータの任意の配列であり、[item]はループ内の反復に割り当てられる変数の名前です。 。

また、`x-for`は`<li>`ではなく、`<template>`要素で宣言されていることに注意してください。 これは`x-for`を使用するための要件です。 これにより、Alpineはブラウザの`<template>`タグの既存の動作を活用できます。

これで、 `<template>`タグ内の要素は、 `filteredItems`内のすべてのアイテムに対して繰り返され、ループ内で評価されたすべての式は、反復変数（この場合は` item`）に直接アクセスできます。

[→`x-for`についてもっと読む]（/directives/for）

<a name="recap"></a>

## 要約

<!-- If you've made it this far, you've been exposed to the following directives in Alpine: -->

<!-- * x-data
* x-on
* x-text
* x-show
* x-model
* x-for -->

これまでに達成した場合は、Alpine で次のディレクティブにさらされています。

* x-data
* x-on
* x-text
* x-show
* x-model
* x-for

<!-- That's a great start, however, there are many more directives to sink your teeth into. The best way to absorb Alpine is to read through this documentation. No need to comb over every word, but if you at least glance through every page you will be MUCH more effective when using Alpine.

Happy Coding! -->


それは素晴らしいスタートです、しかし、あなたの歯を沈めるためのより多くの指示があります。アルパインを吸収する最良の方法は、このドキュメントを読むことです。すべての単語をくしでとかす必要はありませんが、少なくともすべてのページを一瞥すれば、Alpine を使用するときにはるかに効果的です。

ハッピーコーディング！

