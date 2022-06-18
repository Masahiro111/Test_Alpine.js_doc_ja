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

準備が整ったので、Alpine.js の基本を学ぶための基礎として、3つの実用的な例を見てみましょう。この演習が終了するまでに、自分で作成を開始する準備が整っているはずです。

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


アルパインのすべては `x-data` ディレクティブで始まります。プレーンな JavaScript を含むことができる `x-data` の内部で、Alpine が追跡するデータのオブジェクトを宣言します。

このオブジェクト内のすべてのプロパティは、このHTML要素内の他のディレクティブで使用できるようになります。さらに、これらのプロパティの1つが変更されると、それに依存するすべてのものも変更されます。

[→ 詳細を読む`x-data`](/directives/data)


Let's look at `x-on` and see how it can access and modify the `count` property from above:

上からプロパティにx-onアクセスして変更する方法を見てみましょう。count

<a name="listening-for-events"></a>

### イベントリスナー

```alpine
<button x-on:click="count++">Increment</button>
```

`x-on` is a directive you can use to listen for any event on an element. We're listening for a `click` event in this case, so ours looks like `x-on:click`.

You can listen for other events as you'd imagine. For example, listening for a `mouseenter` event would look like this: `x-on:mouseenter`.

When a `click` event happens, Alpine will call the associated JavaScript expression, `count++` in our case. As you can see, we have direct access to data declared in the `x-data` expression.

x-on要素のイベントをリッスンするために使用できるディレクティブです。clickこの場合、イベントをリッスンしているので、のようになりx-on:clickます。

あなたが想像するようにあなたは他のイベントを聞くことができます。たとえば、mouseenterイベントをリッスンすると、次のようになりますx-on:mouseenter。

イベントが発生するclickと、Alpineは関連するJavaScript式を呼び出しますcount++（この場合）。ご覧のとおり、x-data式で宣言されたデータに直接アクセスできます。

> You will often see `@` instead of `x-on:`. This is a shorter, friendlier syntax that many prefer. From now on, this documentation will likely use `@` instead of `x-on:`.

@の代わりによく表示されx-on:ます。これは、多くの人が好む、短くて親しみやすい構文です。今後、このドキュメントでは@の代わりに使用する可能性がありx-on:ます。

[→ Read more about `x-on`](/directives/on)

<a name="reacting-to-changes"></a>

### 変化への対応

```alpine
<h1 x-text="count"></h1>
```

`x-text` is an Alpine directive you can use to set the text content of an element to the result of a JavaScript expression.

In this case, we're telling Alpine to always make sure that the contents of this `h1` tag reflect the value of the `count` property.

In case it's not clear, `x-text`, like most directives accepts a plain JavaScript expression as an argument. So for example, you could instead set its contents to: `x-text="count * 2"` and the text content of the `h1` will now always be 2 times the value of `count`.

x-text要素のテキストコンテンツをJavaScript式の結果に設定するために使用できるAlpineディレクティブです。

この場合、このh1タグの内容がプロパティの値を反映していることを常に確認するようにAlpineに指示していcountます。

明確でない場合はx-text、ほとんどのディレクティブが引数としてプレーンなJavaScript式を受け入れるように。したがって、たとえば、代わりにその内容を：に設定するx-text="count * 2"と、のテキストの内容はh1常にの値の2倍になりますcount。

[→ Read more about `x-text`](/directives/text)

詳細を読むx-text

<a name="building-a-dropdown"></a>

## ドロップダウンの作成

Now that we've seen some basic functionality, let's keep going and look at an important directive in Alpine: `x-show`, by building a contrived "dropdown" component.

Insert the following code into the `<body>` tag:

いくつかの基本的な機能を確認したので、続けて、Alpineの重要なディレクティブを見てみましょうx-show。考案された「ドロップダウン」コンポーネントを作成します。

<body>次のコードをタグに挿入します。

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

If you load this component, you should see that the "Contents..." are hidden by default. You can toggle showing them on the page by clicking the "Toggle" button.

The `x-data` and `x-on` directives should be familiar to you from the previous example, so we'll skip those explanations.

このコンポーネントをロードすると、「コンテンツ...」がデフォルトで非表示になっていることがわかります。「トグル」ボタンをクリックすると、ページへの表示を切り替えることができます。

x-dataandディレクティブは前の例でおなじみのx-onはずなので、これらの説明はスキップします。

<a name="toggling-elements"></a>

### 要素の切り替え

```alpine
<div x-show="open" ...>Contents...</div>
```

`x-show` is an extremely powerful directive in Alpine that can be used to show and hide a block of HTML on a page based on the result of a JavaScript expression, in our case: `open`.

[→ Read more about `x-show`](/directives/show)

x-showはAlpineの非常に強力なディレクティブであり、JavaScript式の結果に基づいてページ上のHTMLのブロックを表示および非表示にするために使用できます。この場合は次のようになりますopen。

→詳細を読むx-show

<a name="listening-for-a-click-outside"></a>

### クリックの外側でのリスナー

```alpine
<div ... @click.outside="open = false">Contents...</div>
```

You'll notice something new in this example: `.outside`. Many directives in Alpine accept "modifiers" that are chained onto the end of the directive and are separated by periods.

In this case, `.outside` tells Alpine to instead of listening for a click INSIDE the `<div>`, to listen for the click only if it happens OUTSIDE the `<div>`.

This is a convenience helper built into Alpine because this is a common need and implementing it by hand is annoying and complex.

[→ Read more about `x-on` modifiers](/directives/on#modifiers)

この例では、何か新しいことに気付くでしょう.outside。Alpineの多くのディレクティブは、ディレクティブの最後にチェーンされ、ピリオドで区切られた「修飾子」を受け入れます。

この場合、.outsideAlpineに、の内側でクリックをリッスンする代わりに、の<div>外側でクリックが発生した場合にのみクリックをリッスンするように指示します<div>。

これはAlpineに組み込まれている便利なヘルパーです。これは一般的なニーズであり、手動で実装するのは面倒で複雑だからです。

x-on→修飾子についてもっと読む

<a name="building-a-search-input"></a>

## 検索入力の作成

Let's now build a more complex component and introduce a handful of other directives and patterns.

Insert the following code into the `<body>` tag:

次に、より複雑なコンポーネントを作成し、他のいくつかのディレクティブとパターンを紹介しましょう。

<body>次のコードをタグに挿入します。

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

By default, all of the "items" (foo, bar, and baz) will be shown on the page, but you can filter them by typing into the text input. As you type, the list of items will change to reflect what you're searching for.

Now there's quite a bit happening here, so let's go through this snippet piece by piece.

デフォルトでは、すべての「アイテム」（foo、bar、およびbaz）がページに表示されますが、テキスト入力に入力することでそれらをフィルタリングできます。入力すると、アイテムのリストが変更され、検索内容が反映されます。

ここではかなりのことが起こっているので、このスニペットを少しずつ見ていきましょう。

<a name="multi-line-formatting"></a>

### 複数行のフォーマット

The first thing I'd like to point out is that `x-data` now has a lot more going on in it than before. To make it easier to write and read, we've split it up into multiple lines in our HTML. This is completely optional and we'll talk more in a bit about how to avoid this problem altogether, but for now, we'll keep all of this JavaScript directly in the HTML.

私が最初に指摘したいのは、x-data今では以前よりも多くのことが起こっているということです。書き込みと読み取りを簡単にするために、HTMLでは複数の行に分割しています。これは完全にオプションであり、この問題を完全に回避する方法についてもう少し詳しく説明しますが、今のところ、このJavaScriptをすべてHTMLに直接保持します。

<a name="binding-to-inputs"></a>

### 入力へのバインド

```alpine
<input x-model="search" placeholder="Search...">
```

You'll notice a new directive we haven't seen yet: `x-model`.

`x-model` is used to "bind" the value of an input element with a data property: "search" from `x-data="{ search: '', ... }"` in our case.

This means that anytime the value of the input changes, the value of "search" will change to reflect that.

`x-model` is capable of much more than this simple example.

[→ Read more about `x-model`](/directives/model)

まだ見たことがない新しいディレクティブに気付くでしょう：x-model。

x-modelinput要素の値をデータプロパティに「バインド」するために使用されます。この場合は「search」からx-data="{ search: '', ... }"です。

これは、入力の値が変更されるたびに、「検索」の値がそれを反映して変更されることを意味します。

x-modelこの単純な例よりもはるかに多くのことができます。

→詳細を読むx-model

<a name="computed-properties-using-getters"></a>

### ゲッターを使用して計算されたプロパティ

The next bit I'd like to draw your attention to is the `items` and `filteredItems` properties from the `x-data` directive.

次に注目したいのは、ディレクティブのitemsandfilteredItemsプロパティです。x-data

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

The `items` property should be self-explanatory. Here we are setting the value of `items` to a JavaScript array of 3 different items (foo, bar, and baz).

The interesting part of this snippet is the `filteredItems` property.

Denoted by the `get` prefix for this property, `filteredItems` is a "getter" property in this object. This means we can access `filteredItems` as if it was a normal property in our data object, but when we do, JavaScript will evaluate the provided function under the hood and return the result.

It's completely acceptable to forgo the `get` and just make this a method that you can call from the template, but some prefer the nicer syntax of the getter.

[→ Read more about JavaScript getters](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Functions/get)

Now let's look inside the `filteredItems` getter and make sure we understand what's going on there:

プロパティはitems自明である必要があります。itemsここでは、の値を3つの異なるアイテム（foo、bar、baz）のJavaScript配列に設定しています。

このスニペットの興味深い部分はfilteredItemsプロパティです。

getこのプロパティのプレフィックスで示されるのfilteredItemsは、このオブジェクトの「getter」プロパティです。これはfilteredItems、データオブジェクトの通常のプロパティであるかのようにアクセスできることを意味しますが、アクセスすると、JavaScriptは内部で提供された関数を評価し、結果を返します。

を省略して、これをテンプレートから呼び出すことができるメソッドにすることは完全に許容されgetますが、ゲッターのより優れた構文を好む人もいます。

→JavaScriptゲッターについてもっと読む

それでは、filteredItemsゲッターの内部を見て、そこで何が起こっているのかを理解していることを確認しましょう。

```js
return this.items.filter(
    i => i.startsWith(this.search)
)
```

This is all plain JavaScript. We are first getting the array of items (foo, bar, and baz) and filtering them using the provided callback: `i => i.startsWith(this.search)`.

By passing in this callback to `filter`, we are telling JavaScript to only return the items that start with the string: `this.search`, which like we saw with `x-model` will always reflect the value of the input.

You may notice that up until now, we haven't had to use `this.` to reference properties. However, because we are working directly inside the `x-data` object, we must reference any properties using `this.[property]` instead of simply `[property]`.

Because Alpine is a "reactive" framework. Any time the value of `this.search` changes, parts of the template that use `filteredItems` will automatically be updated.

これはすべてプレーンなJavaScriptです。まず、アイテムの配列（foo、bar、baz）を取得し、提供されたコールバックを使用してそれらをフィルタリングしますi => i.startsWith(this.search)。

このコールバックをに渡すことでfilter、JavaScriptに、文字列：で始まるアイテムのみを返すように指示しています。this.searchこれは、で見たように、x-model常に入力の値を反映します。

これまで、this.プロパティを参照するために使用する必要がなかったことにお気づきかもしれません。ただし、オブジェクト内で直接作業しているため、単に。ではなくをx-data使用してプロパティを参照する必要があります。this.[property][property]

アルパインは「リアクティブ」フレームワークだからです。値がthis.search変更されるたびに、使用するテンプレートの一部filteredItemsが自動的に更新されます。

<a name="looping-elements"></a>

### ループ要素

Now that we understand the data part of our component, let's understand what's happening in the template that allows us to loop through `filteredItems` on the page.

コンポーネントのデータ部分を理解したのでfilteredItems、ページ上をループできるようにするテンプレートで何が起こっているのかを理解しましょう。

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

ここで最初に気付くのはx-forディレクティブです。x-for式の形式は次のとおりです。[item] in [items]ここで、[items]はデータの任意の配列であり、[item]はループ内の反復に割り当てられる変数の名前です。

また、が直接ではなく要素でx-for宣言されていることに注意してください。これは、を使用するための要件です。これにより、Alpineは、ブラウザー内のタグの既存の動作を活用できるようになります。<template><li>x-for<template>

これで、タグ内のすべての要素が内部の<template>すべてのアイテムに対して繰り返され、ループ内で評価されたすべての式が反復変数（この場合）にfilteredItems直接アクセスできるようになります。item

[→ 詳細を読む `x-for`](/directives/for)

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

