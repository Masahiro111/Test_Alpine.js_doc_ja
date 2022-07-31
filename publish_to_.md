

# Alpine.js をはじめよう

<!-- Create a blank HTML file somewhere on your computer with a name like: `i-love-alpine.html` -->

まず、空の HTML ファイルを好きな場所に作成して、`i-love-alpine.html` と名前を付けましょう。

<!-- Using a text editor, fill the file with these contents: -->

テキストエディターを使用して、以下のようにファイル内を埋めてください。

```html:i-love-alpine.html
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

```html
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

```html
<div x-data="{ count: 0 }">
```

<!-- Everything in Alpine starts with an `x-data` directive. Inside of `x-data`, in plain JavaScript, you declare an object of data that Alpine will track. -->

<!-- Every property inside this object will be made available to other directives inside this HTML element. In addition, when one of these properties changes, everything that relies on it will change as well. -->


Alpine.js のすべては `x-data` ディレクティブで始まります。プレーンな JavaScript を含んでいる `x-data` の内部で、Alpine.js が追跡するデータのオブジェクトを宣言します。

このオブジェクト内のすべてのプロパティは、この HTML 要素内の他のディレクティブで使用できるようになります。さらに、これらのプロパティの1つが変更されると、それに依存するすべてのものも変更されます。

[→「x-data」の詳細を読む](/directives/data)


<!-- Let's look at `x-on` and see how it can access and modify the `count` property from above: -->

上記コードを参考に、`count` プロパティを変更する方法を `x-on`を利用して学んでいきましょう。

<a name="listening-for-events"></a>

### イベントリスナー

```html
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

```html
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

```html
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

```html
<div x-show="open" ...>Contents...</div>
```

<!-- `x-show` is an extremely powerful directive in Alpine that can be used to show and hide a block of HTML on a page based on the result of a JavaScript expression, in our case: `open`. -->

`x-show` は Alpine の非常に強力なディレクティブであり、JavaScript 式の結果に基づいてページ上の HTML のブロックを表示および非表示にするために使用できます。この場合は次のようになります。

[→ 「x-show」の詳細を読む](/directives/show)

<a name="listening-for-a-click-outside"></a>

### クリックの外側でのリスナー

```html
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

```html
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

```html
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

<!-- You may notice that up until now, we haven't had to use `this.` to reference properties. However, because we are working directly inside the `x-data` object, we must reference any properties using `this.[property]` instead of simply `[property]`. -->

<!-- Because Alpine is a "reactive" framework. Any time the value of `this.search` changes, parts of the template that use `filteredItems` will automatically be updated. -->

これはすべてプレーンな JavaScript です。まず、アイテムの配列（foo、bar、baz）を取得し、提供されたコールバックを使用してそれらをフィルタリングします。「`i => i.startsWith(this.search)`」

このコールバックを `filter` に渡すことで、JavaScriptに文字列 `this.search` で始まるアイテムのみを返すように指示しています。これは、`x-model` で見たように、常に入力の値を反映します。

これまで、プロパティを参照するために`this.` を使用する必要がなかったことにお気づきかもしれません。 ただし、`x-data` オブジェクト内で直接作業しているため、単に `[property]` ではなく `this.[property]` を使用してプロパティを参照する必要があります。

Alpine は「リアクティブ」フレームワークだからです。 `this.search` の値が変更されるたびに、`filteredItems` を使用するテンプレートの部分が自動的に更新されます。

<a name="looping-elements"></a>

### ループ要素

<!-- Now that we understand the data part of our component, let's understand what's happening in the template that allows us to loop through `filteredItems` on the page. -->

コンポーネントのデータ部分を理解したので、ページ上の `filteredItems` をループできるようにするテンプレートで何が起こっているのかを理解しましょう。

```html
<ul>
    <template x-for="item in filteredItems">
        <li x-text="item"></li>
    </template>
</ul>
```

<!-- The first thing to notice here is the `x-for` directive. `x-for` expressions take the following form: `[item] in [items]` where [items] is any array of data, and [item] is the name of the variable that will be assigned to an iteration inside the loop. -->

<!-- Also notice that `x-for` is declared on a `<template>` element and not directly on the `<li>`. This is a requirement of using `x-for`. It allows Alpine to leverage the existing behavior of `<template>` tags in the browser to its advantage. -->

<!-- Now any element inside the `<template>` tag will be repeated for every item inside `filteredItems` and all expressions evaluated inside the loop will have direct access to the iteration variable (`item` in this case). -->

ここで最初に気付くのは、`x-for` ディレクティブです。`x-for` 式は `[items] in [items] ` というような形式を取ります。ここで、[items] はデータの任意の配列であり、[item] はループ内の反復に割り当てられる変数の名前です。 

また、`x-for` は `<li>` ではなく、`<template>` 要素で宣言されていることに注意してください。 これは `x-for` を使用するための要件です。 これにより、Alpine はブラウザの`<template>`タグの既存の動作を活用できます。

これで、 `<template>`タグ内の要素は、 `filteredItems` 内のすべてのアイテムに対して繰り返され、ループ内で評価されたすべての式は、反復変数（この場合は `item`）に直接アクセスできます。

[→`x-for`についてもっと読む](/directives/for)

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




# V2 からのアップグレード

<!-- Below is an exhaustive guide on the breaking changes in Alpine V3, but if you'd prefer something more lively, you can review all the changes as well as new features in V3 by watching the Alpine Day 2021 "Future of Alpine" keynote: -->

以下は、Alpine V3 の重大な変更に関する徹底的なガイドですが、より活気のあるものが必要な場合は、Alpine Day 2021「Future of Alpine」基調講演を見て、V3 のすべての変更と新機能を確認できます。

```html
<!-- START_VERBATIM -->
<div class="relative w-full" style="padding-bottom: 56.25%; padding-top: 30px; height: 0; overflow: hidden;">
    <iframe
            class="absolute top-0 left-0 right-0 bottom-0 w-full h-full"
            src="https://www.youtube.com/embed/WixS4JXMwIQ?modestbranding=1&autoplay=1"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
    ></iframe>
</div>
<!-- END_VERBATIM -->
```

<!-- Upgrading from Alpine V2 to V3 should be fairly painless. In many cases, NOTHING has to be done to your codebase to use V3. Below is an exhaustive list of breaking changes and deprecations in descending order of how likely users are to be affected by them: -->

<!-- > Note if you use Laravel Livewire and Alpine together, to use V3 of Alpine, you will need to upgrade to Livewire v2.5.1 or greater. -->

Alpine V2 から V3 へのアップグレードは、かなり簡単です。 多くの場合、V3 を使用するためにコードベースに対して何もする必要はありません。 以下は、ユーザーが影響を受ける可能性の高い順に、重大な変更と非推奨の完全なリストです。

> Laravel Livewire と Alpine を一緒に使用する場合、Alpine の V3 を使用するには、Livewire v2.5.1以降にアップグレードする必要があることに注意してください。

<a name="breaking-changes"></a>

## 大きな変更箇所

* [`$el` は常にカレントエレメントになりました](#el-no-longer-root)
* [データオブジェクトで定義された `init()` 関数を自動的に評価します](#auto-init)
* [インポート後に `Alpine.start()` を呼び出す必要があります](#need-to-call-alpine-start)
* [`x-show.transition` は `x-transition` になりました](#removed-show-dot-transition)
* [`x-if` は `x-transition` をサポートしなくなりました](#x-if-no-transitions)
* [`x-data` カスケードスコープ](#x-data-scope)
* [`x-init`はコールバックリターンを受け入れなくなりました](#x-init-no-callback)
* [イベントハンドラーから `false` を返すことは、暗黙的に "preventDefault"s ではなくなりました](#no-false-return-from-event-handlers)
* [`x-spread` は `x-bind` になりました](#x-spread-now-x-bind)
* [`x-ref` はバインディングをサポートしなくなりました](#x-ref-no-more-dynamic)
* [`Alpine.deferLoadingAlpine()` の代わりにグローバルライフサイクルイベントを使用します](#use-global-events-now)
* [IE11はサポートされなくなりました](#no-ie-11)

<a name="el-no-longer-root"></a>

### `$el` は常に現在の要素 (カレントエレメント) になりました

<!-- `$el` now always represents the element that an expression was executed on, not the root element of the component. This will replace most usages of `x-ref` and in the cases where you still want to access the root of a component, you can do so using `$root`. For example: -->

`$el` は、コンポーネントのルート要素ではなく、常に式が実行された要素を表すようになりました。 これにより、`x-ref` のほとんどの使用法が置き換えられます。それでもコンポーネントのルートにアクセスする場合は、`$root` を使用してアクセスできます。 例えば：

```html
<!-- 🚫 Before -->
<div x-data>
    <button @click="console.log($el)"></button>
    <!-- In V2, $el would have been the <div>, now it's the <button> -->
</div>

<!-- ✅ After -->
<div x-data>
    <button @click="console.log($root)"></button>
</div>
```

<!-- For a smoother upgrade experience, you can replace all instances of `$el` with a custom magic called `$root`. -->

<!-- [→ Read more about $el in V3](/magics/el)  
[→ Read more about $root in V3](/magics/root) -->

よりスムーズなアップグレード体験のために、`$el` のすべてのインスタンスを `$root` と呼ばれるカスタムマジックに置き換えることができます。

[→V3の \$el についてもっと読む](/magics/el)
[→V3の \$root についてもっと読む](/magics/root)

<a name="auto-init"></a>

### データオブジェクトで定義された `init()` 関数を自動的に評価

<!-- A common pattern in V2 was to manually call an `init()` (or similarly named method) on an `x-data` object. -->

<!-- In V3, Alpine will automatically call `init()` methods on data objects. -->


V2 の一般的なパターンは、`x-data`オブジェクトで `init()`（または同様の名前のメソッド）を手動で呼び出すことでした。

V3 では、Alpine はデータオブジェクトに対して自動的に `init()` メソッドを呼び出します。

```html
<!-- 🚫 Before -->
<div x-data="foo()" x-init="init()"></div>

<!-- ✅ After -->
<div x-data="foo()"></div>

<script>
    function foo() {
        return {
            init() {
                //
            }
        }
    }
</script>
```

[→ 初期化関数の自動評価についてもっと読む](/globals/alpine-data#init-functions)

<a name="need-to-call-alpine-start"></a>

### インポート後に Alpine.start() を呼び出す必要

<!-- If you were importing Alpine V2 from NPM, you will now need to manually call `Alpine.start()` for V3. This doesn't affect you if you use Alpine's build file or CDN from a `<template>` tag. -->

NPM から Alpine V2 をインポートしていた場合は、V3 に対して手動で `Alpine.start()` を呼び出す必要があります。 Alpine のビルドファイルまたは `<template>` タグからの CDN を使用する場合、これは影響しません。

<a name="need-to-call-alpine-start"> </a>

```js
// 🚫 Before
import 'alpinejs'

// ✅ After
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
```

[→ AlpineV3の初期化についてもっと読む](/essentials/installation#as-a-module)

<a name="removed-show-dot-transition"></a>

### `x-show.transition` は `x-transition` になりました

<!-- All of the conveniences provided by `x-show.transition...` helpers are still available, but now from a more unified API: `x-transition`: -->

`x-show.transition ...` ヘルパーによって提供されるすべての便利な機能は引き続き利用できますが、より統合された API から提供されるようになりました:  `x-transition`:

```html
<!-- 🚫 Before -->
<div x-show.transition="open"></div>
<!-- ✅ After -->
<div x-show="open" x-transition></div>

<!-- 🚫 Before -->
<div x-show.transition.duration.500ms="open"></div>
<!-- ✅ After -->
<div x-show="open" x-transition.duration.500ms></div>

<!-- 🚫 Before -->
<div x-show.transition.in.duration.500ms.out.duration.750ms="open"></div>
<!-- ✅ After -->
<div
    x-show="open"
    x-transition:enter.duration.500ms
    x-transition:leave.duration.750ms
></div>
```

[→ x-transition についてもっと読む](/directives/transition)

<a name="x-if-no-transitions"></a>

### `x-if` は `x-transition` をサポートしなくなりました

<!-- The ability to transition elements in and add before/after being removed from the DOM is no longer available in Alpine. -->

<!-- This was a feature very few people even knew existed let alone used. -->

<!-- Because the transition system is complex, it makes more sense from a maintenance perspective to only support transitioning elements with `x-show`. -->

DOM に要素を移行したり、DOM から削除する前/後に追加したりする機能は、Alpine では使用できなくなりました。

これは、使用されるどころか、存在することさえ知っている人はほとんどいない機能でした。

遷移システムは複雑であるため、メンテナンスの観点からは、`x-show` でトランジションの要素のみをサポートする方が理にかなっています。

<a name="x-if-no-transitions"> </a>

```html
<!-- 🚫 Before -->
<template x-if.transition="open">
    <div>...</div>
</template>

<!-- ✅ After -->
<div x-show="open" x-transition>...</div>
```

[→ x-if についてもっと読む](/directives/if)

<a name="x-data-scope"></a>

### `x-data`のカスケードスコープ

<!-- Scope defined in `x-data` is now available to all children unless overwritten by a nested `x-data` expression. -->

`x-data` で定義されたスコープは、ネストされた `x-data` 式で上書きされない限り、すべての子で使用できるようになりました。

<a name="x-data-scope"> </a>

```html
<!-- 🚫 Before -->
<div x-data="{ foo: 'bar' }">
    <div x-data="{}">
        <!-- foo is undefined -->
    </div>
</div>

<!-- ✅ After -->
<div x-data="{ foo: 'bar' }">
    <div x-data="{}">
        <!-- foo is 'bar' -->
    </div>
</div>
```

[→ `x-data` のスコープについて](/directives/data#scope)

<a name="x-init-no-callback"></a>

### `x-init`はコールバックリターンを受け入れなくなりました

<!-- Before V3, if `x-init` received a return value that is `typeof` "function", it would execute the callback after Alpine finished initializing all other directives in the tree. Now, you must manually call `$nextTick()` to achieve that behavior. `x-init` is no longer "return value aware". -->

V3より前では、`x-init` が` typeof` "関数" である戻り値を受け取った場合、Alpine がツリー内の他のすべてのディレクティブの初期化を完了した後にコールバックを実行していました。 ここで、その動作を実現するには、手動で `$nextTick()` を呼び出す必要があります。 `x-init` は「戻り値を認識」しなくなりました。

<a name="x-init-no-callback"> </a>

```html
<!-- 🚫 Before -->
<div x-data x-init="() => { ... }">...</div>

<!-- ✅ After -->
<div x-data x-init="$nextTick(() => { ... })">...</div>
```

[→ $nextTickについてもっと読む](/magics/next-tick)

<a name="no-false-return-from-event-handlers"></a>

### イベントハンドラーから `false` を返すことは、暗黙的に "preventDefault" ではなくなりました

<!-- Alpine V2 observes a return value of `false` as a desire to run `preventDefault` on the event. This conforms to the standard behavior of native, inline listeners: `<... oninput="someFunctionThatReturnsFalse()">`. Alpine V3 no longer supports this API. Most people don't know it exists and therefore is surprising behavior. -->

Alpine V2は、イベントで `preventDefault` を実行したいという要望として `false` の戻り値を観察します。 これは、ネイティブのインラインリスナーの標準動作 `<... oninput ="someFunctionThatReturnsFalse()">` に準拠しています。 Alpine V3 はこの API をサポートしなくなりました。 ほとんどの人はそれが存在することを知らないので、驚くべき行動です。

<a name="no-false-return-from-event-handlers"> </a>

```html
<!-- 🚫 Before -->
<div x-data="{ blockInput() { return false } }">
    <input type="text" @input="blockInput()">
</div>

<!-- ✅ After -->
<div x-data="{ blockInput(e) { e.preventDefault() }">
    <input type="text" @input="blockInput($event)">
</div>
```

[→ x-on についてもっと読む](/directives/on)

<a name="x-spread-now-x-bind"></a>

### `x-spread` は `x-bind` になりました

<!-- One of Alpine's stories for re-using functionality is abstracting Alpine directives into objects and applying them to elements with `x-spread`. This behavior is still the same, except now `x-bind` (with no specified attribute) is the API instead of `x-spread`. -->

機能を再利用するための Alpine のストーリーの1つは、Alpine ディレクティブをオブジェクトに抽象化し、それらを `x-spread` を使用して要素に適用することです。 この動作は同じですが、 `x-bind`（属性が指定されていない）が `x-spread` ではなく API になっている点が異なります。

<a name="x-spread-now-x-bind"> </a>

```html
<!-- 🚫 Before -->
<div x-data="dropdown()">
    <button x-spread="trigger">Toggle</button>

    <div x-spread="dialogue">...</div>
</div>

<!-- ✅ After -->
<div x-data="dropdown()">
    <button x-bind="trigger">Toggle</button>

    <div x-bind="dialogue">...</div>
</div>


<script>
    function dropdown() {
        return {
            open: false,

            trigger: {
                'x-on:click'() { this.open = ! this.open },
            },

            dialogue: {
                'x-show'() { return this.open },
                'x-bind:class'() { return 'foo bar' },
            },
        }
    }
</script>
```

[→ x-bind を使用したディレクティブのバインドについてもっと読む](/directives/bind#bind-directives)

<a name="use-global-events-now"></a>

### `Alpine.deferLoadingAlpine()` の代わりにグローバルライフサイクルイベントを使用する

<a name="use-global-events-now"> </a>

```html
<!-- 🚫 Before -->
<script>
    window.deferLoadingAlpine = startAlpine => {
        // Will be executed before initializing Alpine.

        startAlpine()

        // Will be executed after initializing Alpine.
    }
</script>

<!-- ✅ After -->
<script>
    document.addEventListener('alpine:init', () => {
        // Will be executed before initializing Alpine.
    })

    document.addEventListener('alpine:initialized', () => {
        // Will be executed after initializing Alpine.
    })
</script>
```

[→ Alpine ライフサイクルイベントについてもっと読む](/essentials/lifecycle#alpine-initialization)

<a name="x-ref-no-more-dynamic"></a>

### `x-ref` はバインディングをサポートしなくなりました

Alpine V2 では以下のコードのようにしていました。

```html
<div x-data="{options: [{value: 1}, {value: 2}, {value: 3}] }">
    <div x-ref="0">0</div>
    <template x-for="option in options">
        <div :x-ref="option.value" x-text="option.value"></div>
    </template>

    <button @click="console.log($refs[0], $refs[1], $refs[2], $refs[3]);">Display $refs</button>
</div>
```

<!-- after clicking button all `$refs` were displayed. However, in Alpine V3 it's possible to access only `$refs` for elements created statically, so only first ref will be returned as expected. -->

ボタンをクリックすると、すべての `$refs` が表示されました。 ただし、Alpine V3では、静的に作成された要素の `$refs` にのみアクセスできるため、期待どおりに最初の ref のみが返されます。

<a name="no-ie-11"></a>

### IE11はサポートされなくなりました

<!-- Alpine will no longer officially support Internet Explorer 11. If you need support for IE11, we recommend still using Alpine V2. -->

Alpine は InternetExplorer11 を正式にサポートしなくなります。IE11 のサポートが必要な場合は、Alpine V2 を引き続き使用することをお勧めします。

## 非推奨のAPI

<!-- The following 2 APIs will still work in V3, but are considered deprecated and are likely to be removed at some point in the future. -->

次の2つの API は V3 でも引き続き機能しますが、非推奨と見なされ、将来のある時点で削除される可能性があります。

<a name="away-replace-with-outside"></a>

### イベントリスナー修飾子`.away`は`.outside`に置き換える必要があります

ボタンをクリックすると、すべての`$refs`が表示されました。 ただし、Alpine V3では、静的に作成された要素の `$ refs`にのみアクセスできるため、期待どおりに最初のrefのみが返されます。

```html
<!-- 🚫 Before -->
<div x-show="open" @click.away="open = false">
    ...
</div>

<!-- ✅ After -->
<div x-show="open" @click.outside="open = false">
    ...
</div>
```

<a name="alpine-data-instead-of-global-functions"></a>

<!-- ### Prefer `Alpine.data()` to global Alpine function data providers -->

### グローバル Alpine 関数データプロバイダーよりも `Alpine.data()` を優先する

```html
<!-- 🚫 Before -->
<div x-data="dropdown()">
    ...
</div>

<script>
    function dropdown() {
        return {
            ...
        }
    }
</script>

<!-- ✅ After -->
<div x-data="dropdown">
    ...
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            ...
        }))
    })
</script>
```

<!-- > Note that you need to define `Alpine.data()` extensions BEFORE you call `Alpine.start()`. For more information, refer to the [Lifecycle Concerns](https://alpinejs.dev/advanced/extending#lifecycle-concerns) and [Installation as a Module](https://alpinejs.dev/essentials/installation#as-a-module) documentation pages. -->

> `Alpine.start()` を呼び出す前に、`Alpine.data()` 拡張子を定義する必要があることに注意してください。 詳細については、[ライフサイクルの懸念事項](https://alpinejs.dev/advanced/extending#lifecycle-concerns) および [モジュールとしてのインストール](https://alpinejs.dev/essentials/installation#as-a-module) を参照してください。



# インストール

<!-- There are 2 ways to include Alpine into your project: -->

Alpine をプロジェクトに含めるには2つの方法があります。

<!-- * Including it from a `<script>` tag -->
<!-- * Importing it as a module -->

* `<script>`タグを使用してインクルードする
* モジュールとしてインポートする

<!-- Either is perfectly valid. It all depends on the project's needs and the developer's taste. -->

どちらも完全に有効です。それはすべて、プロジェクトのニーズと開発者の好みに依存します。

<a name="from-a-script-tag"></a>

## スクリプトタグから

<!-- This is by far the simplest way to get started with Alpine. Include the following `<script>` tag in the head of your HTML page. -->

これは、アルパインを始める最も簡単な方法です。 HTML ページの先頭に次の `<script>` タグを含めます。

```html
<html>
  <head>
    ...

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  </head>
  ...
</html>
```

<!-- > Don't forget the "defer" attribute in the `<script>` tag. -->

> `<script>` タグの「defer」属性を忘れないでください。

<!-- Notice the `@3.x.x` in the provided CDN link. This will pull the latest version of Alpine version 3. For stability in production, it's recommended that you hardcode the latest version in the CDN link. -->

提供されている CDN リンクの `@3.x.x` に注意してください。これにより、Alpine バージョン 3 の最新バージョンがプルされます。本番環境での安定性のために、CDN リンクに最新バージョンをハードコーディングすることをお勧めします。

```html
<script defer src="https://unpkg.com/alpinejs@3.10.2/dist/cdn.min.js"></script>
```

<!-- That's it! Alpine is now available for use inside your page. -->

それでおしまい！ Alpine がページ内で使用できるようになりました。

<a name="as-a-module"></a>

## モジュールとして

<!-- If you prefer the more robust approach, you can install Alpine via NPM and import it into a bundle. -->

<!-- Run the following command to install it. -->

より堅牢なアプローチが必要な場合は、NPM を介して Alpine をインストールし、バンドルにインポートできます。

次のコマンドを実行してインストールします。

```shell
npm install alpinejs
```

<!-- Now import Alpine into your bundle and initialize it like so: -->

次に、Alpine をバンドルにインポートし、次のように初期化します。

```js
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
```

<!-- > The `window.Alpine = Alpine` bit is optional, but is nice to have for freedom and flexibility. Like when tinkering with Alpine from the devtools for example. -->

<!-- > If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the `Alpine` global object, and when you initialize Alpine by calling `Alpine.start()`. -->

> `window.Alpine = Alpine` ビットはオプションですが、自由と柔軟性のために持っていると便利です。たとえば、devtools から Alpine をいじくり回すときのように。

> Alpine をバンドルにインポートした場合は、`Alpine` グローバルオブジェクトをインポートするときと、`Alpine.start()` を呼び出して Alpine を初期化するときに、間に拡張コードを登録していることを確認する必要があります。

[→ Alpine の拡張についてもっと読む](/advanced/extending)）




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



# テンプレート

<!-- Alpine offers a handful of useful directives for manipulating the DOM on a web page. -->

<!-- Let's cover a few of the basic templating directives here, but be sure to look through the available directives in the sidebar for an exhaustive list. -->

Alpine は、Web ページ上の DOM を操作するための便利なディレクティブをいくつか提供しています。

ここでは、いくつかの基本的なテンプレートディレクティブについて説明しますが、完全なリストについては、サイドバーで使用可能なディレクティブを確認してください。

<a name="text-content"></a>

## テキストコンテンツ

Alpine を使用すると、`x-text` ディレクティブを使用して要素のテキストコンテンツを簡単に制御できます。

<!-- Alpine makes it easy to control the text content of an element with the `x-text` directive. -->

```html
<div x-data="{ title: 'Start Here' }">
    <h1 x-text="title"></h1>
</div>
```

<!-- START_VERBATIM -->
<div x-data="{ title: 'Start Here' }" class="demo">
    <strong x-text="title"></strong>
</div>
<!-- END_VERBATIM -->

<!-- Now, Alpine will set the text content of the `<h1>` with the value of `title` ("Start Here"). When `title` changes, so will the contents of `<h1>`. -->

<!-- Like all directives in Alpine, you can use any JavaScript expression you like. For example: -->

これで、Alpine は `<h1>` のテキストコンテンツを `title` ( "Start Here") の値で設定します。 `title` が変わると、`<h1>` の内容も変わります。

Alpine のすべてのディレクティブと同様に、任意の JavaScript 式を使用できます。例えば：

```html
<span x-text="1 + 2"></span>
```

<!-- START_VERBATIM -->
<div class="demo" x-data>
    <span x-text="1 + 2"></span>
</div>
<!-- END_VERBATIM -->

<!-- The `<span>` will now contain the sum of "1" and "2". -->

`<span>` には、「1」と「2」の合計が含まれます。

[→ x-text についてもっと読む](/directives/text)

<a name="toggling-elements"></a>

## 要素の切り替え

要素の切り替えは、Web ページやアプリケーションでよくあるニーズです。ドロップダウン、モーダル、ダイアログ、「もっと見る」などはすべて良い例です。

Alpine は、ページ上の要素を切り替えるための `x-show` および `x-if` ディレクティブを提供します。

<!-- Toggling elements is a common need in web pages and applications. Dropdowns, modals, dialogues, "show-more"s, etc... are all good examples. -->

<!-- Alpine offers the `x-show` and `x-if` directives for toggling elements on a page. -->

<a name="x-show"></a>

### `x-show`

<!-- Here's a simple toggle component using `x-show`. -->

これは、`x-show` を使用した単純なトグルコンポーネントです。

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Expand</button>

    <div x-show="open">
        Content...
    </div>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open" :aria-pressed="open">Expand</button>

    <div x-show="open">
        Content...
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now the entire `<div>` containing the contents will be shown and hidden based on the value of `open`. -->

<!-- Under the hood, Alpine adds the CSS property `display: none;` to the element when it should be hidden. -->

これで、コンテンツを含む  `<div>` 全体が、​​`open` の値に基づいて表示および非表示になります。

内部的には、Alpine は CSS プロパティ `display: none;` を非表示にする必要があるときに要素に追加します。

[→ x-show についてもっと読む](/directives/show)

<!-- This works well for most cases, but sometimes you may want to completely add and remove the element from the DOM entirely. This is what `x-if` is for. -->

これはほとんどの場合にうまく機能しますが、DOMから要素を完全に追加および削除したい場合もあります。これが `x-if` の目的です。

<a name="x-if"></a>

### `x-if`

これは以前と同じトグルですが、今回は `x-show` の代わりに `x-if` を使用しています。

<!-- Here is the same toggle from before, but this time using `x-if` instead of `x-show`. -->

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Expand</button>

    <template x-if="open">
        <div>
            Content...
        </div>
    </template>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open" :aria-pressed="open">Expand</button>

    <template x-if="open">
        <div>
            Content...
        </div>
    </template>
</div>
<!-- END_VERBATIM -->
```

<!-- Notice that `x-if` must be declared on a `<template>` tag. This is so that Alpine can leverage the existing browser behavior of the `<template>` element and use it as the source of the target `<div>` to be added and removed from the page. -->

<!-- When `open` is true, Alpine will append the `<div>` to the `<template>` tag, and remove it when `open` is false. -->

`x-if` は `<template>` タグで宣言する必要があることに注意してください。これは、Alpine が  `<template>` 要素の既存のブラウザの動作を活用し、ページに追加および削除するターゲット `<div>` のソースとして使用できるようにするためです。

`open` が true の場合、Alpine は `<div>` を `<template>` タグに追加し、`open` が false の場合は削除します。

[→ x-if についてもっと読む](/directives/if)

<a name="toggling-with-transitions"></a>

## トランジションの切り替え

Alpine を使用すると、 `x-transition` ディレクティブを使用して、「表示」状態と「非表示」状態の間をスムーズに移行できます。

> `x-transition` は `x-show` でのみ機能し、`x-if` では機能しません。

これも簡単なトグルの例ですが、今回はトランジションが適用されています。

<!-- Alpine makes it simple to smoothly transition between "shown" and "hidden" states using the `x-transition` directive. -->

<!-- > `x-transition` only works with `x-show`, not with `x-if`. -->

<!-- Here is, again, the simple toggle example, but this time with transitions applied: -->

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Expands</button>

    <div x-show="open" x-transition>
        Content...
    </div>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open">Expands</button>

    <div class="flex">
        <div x-show="open" x-transition style="will-change: transform;">
            Content...
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Let's zoom in on the portion of the template dealing with transitions: -->

トランジションを処理するテンプレートの部分を拡大してみましょう。

```html
<div x-show="open" x-transition>
```

<!-- `x-transition` by itself will apply sensible default transitions (fade and scale) to the toggle. -->

<!-- There are two ways to customize these transitions: -->

<!-- * Transition helpers -->
<!-- * Transition CSS classes. -->

<!-- Let's take a look at each of these approaches: -->

`x-transition` 自体は、適切なデフォルトの遷移（フェードとスケール）をトグルに適用します。

これらの遷移をカスタマイズするには、次の2つの方法があります。

* トランジション ヘルパー
* トランジション CSS クラス

これらの各アプローチを見てみましょう。

<a name="transition-helpers"></a>

### トランジション ヘルパー

トランジションの期間を長くしたいとします。次のように `.duration` 修飾子を使用して手動で指定できます。

<!-- Let's say you wanted to make the duration of the transition longer, you can manually specify that using the `.duration` modifier like so: -->

```html
<div x-show="open" x-transition.duration.500ms>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open">Expands</button>

    <div class="flex">
        <div 
            x-show="open" 
            x-transition.duration.500ms 
            style="will-change: transform;">
            Content...
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now the transition will last 500 milliseconds. -->

<!-- If you want to specify different values for in and out transitions, you can use `x-transition:enter` and `x-transition:leave`: -->

これで、トランジションは500ミリ秒として設定されます。

イントランジションとアウトトランジションに異なる値を指定する場合は、`x-transition:enter` と `x-transition:leave` を使用できます。

```html
<div
    x-show="open"
    x-transition:enter.duration.500ms
    x-transition:leave.duration.1000ms
>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open">Expands</button>

    <div class="flex">
        <div x-show="open" x-transition:enter.duration.500ms x-transition:leave.duration.1000ms style="will-change: transform;">
            Content...
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Additionally, you can add either `.opacity` or `.scale` to only transition that property. For example: -->

さらに、`.opacity` または `.scale` のいずれかを追加して、そのプロパティのみを遷移させることができます。例えば：

```html
<div x-show="open" x-transition.opacity>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open">Expands</button>

    <div class="flex">
        <div x-show="open" x-transition:enter.opacity.duration.500 x-transition:leave.opacity.duration.250>
            Content...
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

[→ トランジションヘルパーについてもっと読む](/directives/transition#the-transition-helper)

<a name="transition-classes"></a>

### トランジション クラス

アプリケーションの遷移をよりきめ細かく制御する必要がある場合は、次の構文を使用して、遷移の特定のフェーズで特定の CSS クラスを適用できます。この例では [Tailwind CSS](https://tailwindcss.com/) を使用します。

<!-- If you need more fine-grained control over the transitions in your application, you can apply specific CSS classes at specific phases of the transition using the following syntax (this example uses [Tailwind CSS](https://tailwindcss.com/)): -->

```html
<div
    x-show="open"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-90"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-90"
>...</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <button @click="open = ! open">Expands</button>

    <div class="flex">
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            style="will-change: transform"
        >
            Content...
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

[→ transition クラスについてもっと読む](/directives/transition#applying-css-classes)

<a name="binding-attributes"></a>

## バインディング属性

`x-bind` ディレクティブを使用して、`class`、`style`、`disabled` などの HTML 属性を Alpine の要素に追加できます。

動的にバインドされた `class` 属性の例を次に示します。

<!-- You can add HTML attributes like `class`, `style`, `disabled`, etc... to elements in Alpine using the `x-bind` directive. -->

<!-- Here is an example of a dynamically bound `class` attribute: -->

```html
<button
    x-data="{ red: false }"
    x-bind:class="red ? 'bg-red' : ''"
    @click="red = ! red"
>
    Toggle Red
</button>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <button
        x-data="{ red: false }"
        x-bind:style="red && 'background: red'"
        @click="red = ! red"
    >
        Toggle Red
    </button>
</div>
<!-- END_VERBATIM -->
```

<!-- As a shortcut, you can leave out the `x-bind` and use the shorthand `:` syntax directly: -->

ショートカットとして、 `x-bind` を省略し、省略形の `:` 構文を直接使用できます。

```html
<button ... :class="red ? 'bg-red' : ''">
```

<!-- Toggling classes on and off based on data inside Alpine is a common need. Here's an example of toggling a class using Alpine's `class` binding object syntax: (Note: this syntax is only available for `class` attributes) -->

Alpine 内のデータに基づいてクラスのオンとオフを切り替えることは、一般的なニーズです。これは、Alpine の `class` バインディングオブジェクト構文を使用してクラスを切り替える例です。(注: この構文は、`class` 属性でのみ使用できます）

```html
<div x-data="{ open: true }">
    <span :class="{ 'hidden': ! open }">...</span>
</div>
```

<!-- Now the `hidden` class will be added to the element if `open` is false, and removed if `open` is true. -->

これで、`open` が false の場合は `hidden` クラスが要素に追加され、`open` が true の場合は削除されます。

<a name="looping-elements"></a>

## ループ要素

Alpine では、`x-for` ディレクティブを使用して、JavaScript データに基づいてテンプレートの一部を反復処理できます。簡単な例を次に示します。

<!-- Alpine allows for iterating parts of your template based on JavaScript data using the `x-for` directive. Here is a simple example: -->

```html
<div x-data="{ statuses: ['open', 'closed', 'archived'] }">
    <template x-for="status in statuses">
        <div x-text="status"></div>
    </template>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ statuses: ['open', 'closed', 'archived'] }" class="demo">
    <template x-for="status in statuses">
        <div x-text="status"></div>
    </template>
</div>
<!-- END_VERBATIM -->
```

<!-- Similar to `x-if`, `x-for` must be applied to a `<template>` tag. Internally, Alpine will append the contents of `<template>` tag for every iteration in the loop. -->

<!-- As you can see the new `status` variable is available in the scope of the iterated templates. -->

`x-if` と同様に、`x-for` は `<template>` タグに適用する必要があります。内部的には、Alpine は、ループ内のすべての反復に対して `<template>` タグの内容を追加します。

ご覧のとおり、新しい `status` 変数は反復テンプレートのスコープで使用できます。

[→ x-for についてもっと読む](/directives/for)

<a name="inner-html"></a>

## Inner HTML

<!-- Alpine makes it easy to control the HTML content of an element with the `x-html` directive. -->

Alpine を使用すると、`x-html` ディレクティブを使用して要素の HTML コンテンツを簡単に制御できます。

```html
<div x-data="{ title: '<h1>Start Here</h1>' }">
    <div x-html="title"></div>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ title: '<h1>Start Here</h1>' }" class="demo">
    <div x-html="title"></div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now, Alpine will set the text content of the `<div>` with the element `<h1>Start Here</h1>`. When `title` changes, so will the contents of `<h1>`. -->

<!-- > ⚠️ Only use on trusted content and never on user-provided content. ⚠️ -->
<!-- > Dynamically rendering HTML from third parties can easily lead to XSS vulnerabilities. -->

これで、Alpine は `<div>` のテキストコンテンツを要素 `<h1> Start Here</h1>` で設定します。 `title` が変わると、`<h1>` の内容も変わります。

> ⚠️信頼できるコンテンツにのみ使用し、ユーザー提供のコンテンツには使用しないでください。 ⚠️
> サードパーティから HTML を動的にレンダリングすると、XSSの脆弱性が簡単に発生する可能性があります。

[→ x-html についてもっと読む](/directives/html)



# イベント

<!-- Alpine makes it simple to listen for browser events and react to them. -->

Alpine を使用すると、ブラウザのイベントを簡単にリッスンして対応できます。

<a name="listening-for-simple-events"></a>

## 簡単なイベントを聞く

`x-on` を使用すると、要素上または要素内でディスパッチされるブラウザイベントをリッスンできます。

ボタンのクリックをリッスンする基本的な例を次に示します。

<!-- By using `x-on`, you can listen for browser events that are dispatched on or within an element. -->

<!-- Here's a basic example of listening for a click on a button: -->

```html
<button x-on:click="console.log('clicked')">...</button>
```

<!-- As an alternative, you can use the event shorthand syntax if you prefer: `@`. Here's the same example as before, but using the shorthand syntax (which we'll be using from now on): -->

別の方法として、必要に応じてイベントの省略構文を使用できます：`@`。これは前と同じ例ですが、省略構文（これから使用します）を使用します。

```html
<button @click="...">...</button>
```

In addition to `click`, you can listen for any browser event by name. For example: `@mouseenter`, `@keyup`, etc... are all valid syntax.

「クリック」に加えて、名前で任意のブラウザイベントをリッスンできます。例：`@mouseenter`、`@keyup` などはすべて有効な構文です。

<a name="listening-for-specific-keys"></a>

## 特定のキーをリッスンする

<!-- Let's say you wanted to listen for the `enter` key to be pressed inside an `<input>` element. Alpine makes this easy by adding the `.enter` like so: -->

`<input>` 要素内で押される `enter` キーをリッスンしたいとします。 Alpine は、次のように `.enter` を追加することで、これを簡単にします。

```html
<input @keyup.enter="...">
```

<!-- You can even combine key modifiers to listen for key combinations like pressing `enter` while holding `shift`: -->

キー修飾子を組み合わせて、`shift` を押しながら `Enter` を押すなどのキーの組み合わせをリッスンすることもできます。

```html
<input @keyup.shift.enter="...">
```

<a name="preventing-default"></a>

## デフォルトの防止

ブラウザイベントに対応する場合、多くの場合、「デフォルトを防止する」（ブラウザイベントのデフォルトの動作を防止する）必要があります。

たとえば、フォームの送信をリッスンしたいが、ブラウザがフォームリクエストを送信できないようにする場合は、`.prevent` を使用できます。

<!-- When reacting to browser events, it is often necessary to "prevent default" (prevent the default behavior of the browser event). -->

<!-- For example, if you want to listen for a form submission but prevent the browser from submitting a form request, you can use `.prevent`: -->

```html
<form @submit.prevent="...">...</form>
```

<!-- You can also apply `.stop` to achieve the equivalent of `event.stopPropagation()`. -->

`.stop` を適用して、`event.stopPropagation()` と同等のものを実現することもできます。

<a name="accessing-the-event-object"></a>

## イベントオブジェクトへのアクセス

独自のコード内でネイティブブラウザイベントオブジェクトにアクセスしたい場合があります。これを簡単にするために、Alpine は自動的に `$event` マジック変数を挿入します。

<!-- Sometimes you may want to access the native browser event object inside your own code. To make this easy, Alpine automatically injects an `$event` magic variable: -->

```html
<button @click="$event.target.remove()">Remove Me</button>
```

<a name="dispatching-custom-events"></a>

## カスタムイベントのディスパッチ

ブラウザイベントをリッスンするだけでなく、それらをディスパッチすることもできます。これは、他の Alpine コンポーネントと通信したり、Alpine 自体の外部のツールでイベントをトリガーしたりする場合に非常に役立ちます。

Alpine は、このために `$dispatch` と呼ばれる魔法のヘルパーを公開しています。

<!-- In addition to listening for browser events, you can dispatch them as well. This is extremely useful for communicating with other Alpine components or triggering events in tools outside of Alpine itself. -->

<!-- Alpine exposes a magic helper called `$dispatch` for this: -->

```html
<div @foo="console.log('foo was dispatched')">
    <button @click="$dispatch('foo')"></button>
</div>
```

<!-- As you can see, when the button is clicked, Alpine will dispatch a browser event called "foo", and our `@foo` listener on the `<div>` will pick it up and react to it. -->

ご覧のとおり、ボタンがクリックされると、Alpine は「foo」というブラウザイベントをディスパッチし、`<div>` の `@foo` リスナーがそれを取得して反応します。

<a name="listening-for-events-on-window"></a>

## ウィンドウでイベントをリッスンする

ブラウザのイベントの性質上、トップレベルのウィンドウオブジェクトでイベントをリッスンすると便利な場合があります。

これにより、次の例のように、コンポーネント間で完全に通信できます。


<!-- Because of the nature of events in the browser, it is sometimes useful to listen to events on the top-level window object. -->

<!-- This allows you to communicate across components completely like the following example: -->


```html
<div x-data>
    <button @click="$dispatch('foo')"></button>
</div>

<div x-data @foo.window="console.log('foo was dispatched')">...</div>
```

<!-- In the above example, if we click the button in the first component, Alpine will dispatch the "foo" event. Because of the way events work in the browser, they "bubble" up through parent elements all the way to the top-level "window". -->

<!-- Now, because in our second component we are listening for "foo" on the window (with `.window`), when the button is clicked, this listener will pick it up and log the "foo was dispatched" message. -->

上記の例では、最初のコンポーネントのボタンをクリックすると、Alpine は「foo」イベントをディスパッチします。ブラウザでのイベントの動作方法により、イベントは親要素を介してトップレベルの「ウィンドウ」まで「バブル」します。

ここで、2番目のコンポーネントで（ `.window`を使用して）ウィンドウで「foo」をリッスンしているため、ボタンがクリックされると、このリスナーはそれを取得し、「fooがディスパッチされました」メッセージをログに記録します。

[→ x-on についてもっと読む](/directives/on)



# ライフサイクル

Alpine には、ライフサイクルのさまざまな部分に接続するためのさまざまな手法がいくつかあります。以下に精通するために最も役立つものを見ていきましょう。

<!-- Alpine has a handful of different techniques for hooking into different parts of its lifecycle. Let's go through the most useful ones to familiarize yourself with: -->

<a name="element-initialization"></a>

## 要素の初期化

Alpineのもう1つの非常に便利なライフサイクルフックは、`x-init` ディレクティブです。

`x-init` はページ上の任意の要素に追加でき、Alpineがその要素の初期化を開始すると、ページ内で呼び出す JavaScript を実行します。

<!-- Another extremely useful lifecycle hook in Alpine is the `x-init` directive. -->

<!-- `x-init` can be added to any element on a page and will execute any JavaScript you call inside it when Alpine begins initializing that element. -->

```html
<button x-init="console.log('Im initing')">
```

<!-- In addition to the directive, Alpine will automatically call any `init()` methods stored on a data object. For example: -->

ディレクティブに加えて、Alpineはデータオブジェクトに格納されているすべての `init()` メソッドを自動的に呼び出します。例えば：

```js
Alpine.data('dropdown', () => ({
    init() {
        // I get called before the element using this data initializes.
    }
}))
```

<a name="after-a-state-change"></a>

## 状態変化後

Alpine を使用すると、データ（状態）が変更されたときにコードを実行できます。このようなタスクには、`$watch` と `x-effect` の2つの異なる API が用意されています。

<!-- Alpine allows you to execute code when a piece of data (state) changes. It offers two different APIs for such a task: `$watch` and `x-effect`. -->

<a name="watch"></a>

### `$watch`

```html
<div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">
```

<!-- As you can see above, `$watch` allows you to hook into data changes using a dot-notation key. When that piece of data changes, Alpine will call the passed callback and pass it the new value. along with the old value before the change. -->

上記のように、 `$watch` を使用すると、ドット表記キーを使用してデータの変更にフックできます。そのデータが変更されると、Alpine は渡されたコールバックを呼び出し、新しい値を渡します。変更前の古い値と一緒に。

[→ $watch についてもっと読む](/magics/watch)

<a name="x-effect"></a>

### `x-effect`

<!-- `x-effect` uses the same mechanism under the hood as `$watch` but has very different usage. -->

<!-- Instead of specifying which data key you wish to watch, `x-effect` will call the provided code and intelligently look for any Alpine data used within it. Now when one of those pieces of data changes, the `x-effect` expression will be re-run. -->

<!-- Here's the same bit of code from the `$watch` example rewritten using `x-effect`: -->

`x-effect` は、内部で `$watch` と同じメカニズムを使用しますが、使用方法が大きく異なります。

監視するデータキーを指定する代わりに、 `x-effect` は提供されたコードを呼び出し、その中で使用されている Alpine データをインテリジェントに検索します。これらのデータの1つが変更されると、`x-effect` 式が再実行されます。

これは、`x-effect` を使用して書き直された `$watch` の例と同じコードです。

```html
<div x-data="{ open: false }" x-effect="console.log(open)">
```

<!-- Now, this expression will be called right away, and re-called every time `open` is updated. -->

<!-- The two main behavioral differences with this approach are: -->

<!-- 1. The provided code will be run right away AND when data changes (`$watch` is "lazy" -- won't run until the first data change) -->
<!-- 2. No knowledge of the previous value. (The callback provided to `$watch` receives both the new value AND the old one) -->

これで、この式はすぐに呼び出され、`open` が更新されるたびに再呼び出されます。

このアプローチとの 2つの主な動作の違いは次のとおりです。

1. 提供されたコードはすぐに実行され、データが変更されたときに実行されます（ `$watch` は"lazy" であり、最初のデータ変更まで実行されません）
2. 以前の値についての知識がありません。 （`$watch` に提供されたコールバックは、新しい値と古い値の両方を受け取ります）

[→ x-effect についてもっと読む](/directives/effect)

<a name="alpine-initialization"></a>

## 初期化について

<a name="alpine-initializing"></a>

### `alpine:init`

<!-- Ensuring a bit of code executes after Alpine is loaded, but BEFORE it initializes itself on the page is a necessary task. -->

<!-- This hook allows you to register custom data, directives, magics, etc. before Alpine does its thing on a page. -->

<!-- You can hook into this point in the lifecycle by listening for an event that Alpine dispatches called: `alpine:init` -->

Alpine がロードされた後に少しのコードが実行されることを確認しますが、ページ上でそれ自体を初期化する前に、必要なタスクです。

このフックを使用すると、Alpine がページ上で処理を実行する前に、カスタムデータ、ディレクティブ、マジックなどを登録できます。

Alpine がディスパッチするイベント `alpine:init` をリッスンすることで、ライフサイクルのこのポイントにフックできます。

```js
document.addEventListener('alpine:init', () => {
    Alpine.data(...)
})
```

<a name="alpine-initialized"></a>

### `alpine:initialized`

<!-- Alpine also offers a hook that you can use to execute code After it's done initializing called `alpine:initialized`: -->

Alpine には、初期化が完了した後に実行できる `alpine:initialized` と呼ばれるフックも用意されています。

```js
document.addEventListener('alpine:initialized', () => {
    //
})
```



# x-data

<!-- Everything in Alpine starts with the `x-data` directive. -->

<!-- `x-data` defines a chunk of HTML as an Alpine component and provides the reactive data for that component to reference. -->

Alpine のすべては、`x-data` ディレクティブから始まります。

`x-data` は、HTMLのチャンクを Alpine コンポーネントとして定義し、そのコンポーネントが参照するためのリアクティブデータを提供します。

考案されたドロップダウンコンポーネントの例を次に示します。

<!-- Here's an example of a contrived dropdown component: -->

```html
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

```html
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

```html
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

```html
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

```html
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

```html
<div x-data="{}">
```

<!-- However, if you wish, you can also eliminate the attribute value entirely if it looks better to you. -->

ただし、必要に応じて、見栄えがよい場合は属性値を完全に削除することもできます。

```html
<div x-data>
```

<a name="single-element-components"></a>

## 単一要素コンポーネント

<!-- Sometimes you may only have a single element inside your Alpine component, like the following: -->

次のように、Alpine コンポーネント内に要素が1つしかない場合があります。

```html
<div x-data="{ open: true }">
    <button @click="open = false" x-show="open">Hide Me</button>
</div>
```

<!-- In these cases, you can declare `x-data` directly on that single element: -->

このような場合、その単一の要素で `x-data` を直接宣言できます。

```html
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

```html
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



# x-show

<!-- `x-show` is one of the most useful and powerful directives in Alpine. It provides an expressive way to show and hide DOM elements. -->

<!-- Here's an example of a simple dropdown component using `x-show`. -->

`x-show` は、Alpine で最も便利で強力なディレクティブの1つです。DOM要素を表示および非表示にする表現力豊かな方法を提供します。

`x-show` を使用した単純なドロップダウンコンポーネントの例を次に示します。

```html
<div x-data="{ open: false }">
    <button x-on:click="open = ! open">Toggle Dropdown</button>

    <div x-show="open">
        Dropdown Contents...
    </div>
</div>
```

<!-- When the "Toggle Dropdown" button is clicked, the dropdown will show and hide accordingly. -->

<!-- > If the "default" state of an `x-show` on page load is "false", you may want to use `x-cloak` on the page to avoid "page flicker" (The effect that happens when the browser renders your content before Alpine is finished initializing and hiding it.) You can learn more about `x-cloak` in its documentation. -->

「`Toggle Dropdown`」ボタンをクリックすると、それに応じてドロップダウンが表示および非表示になります。

> ページ読み込み時の`x-show`のデフォルト状態が「`false`」の場合、「ページのちらつき」（ブラウザが Alpine が初期化と非表示を完了する前のコンテンツ）を回避するために、ページで「`x-cloak`」を使用することをお勧めします。 `x-cloak`の詳細については、ドキュメントをご覧ください

<a name="with-transitions"></a>

## トランジション

<!-- If you want to apply smooth transitions to the `x-show` behavior, you can use it in conjunction with `x-transition`. You can learn more about that directive [here](/directives/transition), but here's a quick example of the same component as above, just with transitions applied. -->

`x-show` の動作にスムーズな遷移を適用する場合は、`x-transition` と組み合わせて使用​​できます。このディレクティブの詳細については、[ここ](/directives/transition)　を参照してください。ただし、トランジションを適用した、上記と同じコンポーネントの簡単な例を次に示します。

```html
<div x-data="{ open: false }">
    <button x-on:click="open = ! open">Toggle Dropdown</button>

    <div x-show="open" x-transition>
        Dropdown Contents...
    </div>
</div>
```



# x-bind

<!-- `x-bind` allows you to set HTML attributes on elements based on the result of JavaScript expressions.

For example, here's a component where we will use `x-bind` to set the placeholder value of an input. -->

`x-bind` を使用すると、JavaScript 式の結果に基づいて要素にHTML属性を設定できます。

たとえば、これは、`x-bind`を使用して入力のプレースホルダー値を設定するコンポーネントです。

```html
<div x-data="{ placeholder: 'Type here...' }">
  <input type="text" x-bind:placeholder="placeholder">
</div>
```

<a name="shorthand-syntax"></a>

## 省略構文

<!-- If `x-bind:` is too verbose for your liking, you can use the shorthand: `:`. For example, here is the same input element as above, but refactored to use the shorthand syntax. -->

`x-bind：`が冗長すぎて好みに合わない場合は、省略形 `：` を使用できます。たとえば、これは上記と同じ入力要素ですが、短縮構文を使用するようにリファクタリングされています。

```html
<input type="text" :placeholder="placeholder">
```

<a name="binding-classes"></a>

## バインディングクラス

<!-- `x-bind` is most often useful for setting specific classes on an element based on your Alpine state.

Here's a simple example of a simple dropdown toggle, but instead of using `x-show`, we'll use a "hidden" class to toggle an element. -->

`x-bind` は、Alpineの状態に基づいて要素に特定のクラスを設定する場合に最もよく役立ちます。

これは単純なドロップダウントグルの簡単な例ですが、`x-show`を使用する代わりに、「hidden」クラスを使用して要素をトグルします。

```html
<div x-data="{ open: false }">
  <button x-on:click="open = ! open">Toggle Dropdown</button>

  <div :class="open ? '' : 'hidden'">
    Dropdown Contents...
  </div>
</div>
```

<!-- Now, when `open` is `false`, the "hidden" class will be added to the dropdown. -->

これで、`open`が `false` の場合、「非表示」クラスがドロップダウンに追加されます。

<a name="shorthand-conditionals"></a>

### 省略形の条件

<!-- In cases like these, if you prefer a less verbose syntax you can use JavaScript's short-circuit evaluation instead of standard conditionals: -->

このような場合、より冗長でない構文が必要な場合は、標準の条件の代わりにJavaScriptの短絡評価を使用できます。

```html
<div :class="show ? '' : 'hidden'">
<!-- Is equivalent to: -->
<div :class="show || 'hidden'">
```

<!-- The inverse is also available to you. Suppose instead of `open`, we use a variable with the opposite value: `closed`. -->

逆も利用できます。`open` の代わりに、反対の値を持つ変数 `closed` を使用するとします。

```html
<div :class="closed ? 'hidden' : ''">
<!-- Is equivalent to: -->
<div :class="closed && 'hidden'">
```

<a name="class-object-syntax"></a>

### クラスオブジェクト構文

<!-- Alpine offers an additional syntax for toggling classes if you prefer. By passing a JavaScript object where the classes are the keys and booleans are the values, Alpine will know which classes to apply and which to remove. For example: -->

Alpine は、必要に応じてクラスを切り替えるための追加の構文を提供します。クラスがキーでブール値が値である JavaScript オブジェクトを渡すことにより、Alpine は、適用するクラスと削除するクラスを認識します。以下のような例となります。

```html
<div :class="{ 'hidden': ! show }">
```

<!-- This technique offers a unique advantage to other methods. When using object-syntax, Alpine will NOT preserve original classes applied to an element's `class` attribute. -->

<!-- For example, if you wanted to apply the "hidden" class to an element before Alpine loads, AND use Alpine to toggle its existence you can only achieve that behavior using object-syntax: -->

この手法は、他の方法に固有の利点を提供します。 `object-syntax` を使用する場合、Alpine は要素の`class`属性に適用された元のクラスを保持しません。

たとえば、Alpine が読み込まれる前に「hidden」クラスを要素に適用し、Alpine を使用してその存在を切り替える場合、`object-syntax` を使用してのみその動作を実現できます。

```html
<div class="hidden" :class="{ 'hidden': ! show }">
```

<!-- In case that confused you, let's dig deeper into how Alpine handles `x-bind:class` differently than other attributes. -->

混乱した場合に備えて、Alpine が他の属性とは異なる方法で `x-bind:class`を処理する方法を詳しく見ていきましょう。

<a name="special-behavior"></a>

### 特別な振る舞い

<!-- `x-bind:class` behaves differently than other attributes under the hood. -->

<!-- Consider the following case. -->

`x-bind:class` は、内部で他の属性とは異なる動作をします。

次の場合を考えてみましょう。

```html
<div class="opacity-50" :class="hide && 'hidden'">
```

<!-- If "class" were any other attribute, the `:class` binding would overwrite any existing class attribute, causing `opacity-50` to be overwritten by either `hidden` or `''`. -->

<!-- However, Alpine treats `class` bindings differently. It's smart enough to preserve existing classes on an element. -->

<!-- For example, if `hide` is true, the above example will result in the following DOM element: -->

「class」が他の属性である場合、`:class` バインディングは既存のクラス属性を上書きし、`opacity-50` を `hidden` または `''` で上書きします。

ただし、Alpine は `class` バインディングを異なる方法で処理します。要素の既存のクラスを保持するのに役立ちます。

たとえば、`hide` が true の場合、上記の例は次のDOM要素になります。

```html
<div class="opacity-50 hidden">
```

If `hide` is false, the DOM element will look like:

`hide` が `false` の場合、DOM要素は次のようになります。

```html
<div class="opacity-50">
```

<!-- This behavior should be invisible and intuitive to most users, but it is worth mentioning explicitly for the inquiring developer or any special cases that might crop up. -->

この動作は、ほとんどのユーザーには見えず、直感的である必要がありますが、問い合わせを行う開発者や、発生する可能性のある特殊なケースについては、明示的に言及する価値があります。

<a name="binding-styles"></a>

## CSS スタイルを結合する

<!-- Similar to the special syntax for binding classes with JavaScript objects, Alpine also offers an object-based syntax for binding `style` attributes. -->

<!-- Just like the class objects, this syntax is entirely optional. Only use it if it affords you some advantage. -->

クラスを JavaScript オブジェクトにバインドするための特別な構文と同様に、Alpine は `style` 属性をバインドするためのオブジェクトベースの構文も提供します。

クラスオブジェクトと同様に、この構文は完全にオプションです。それがあなたにいくらかの利点を与える場合にのみそれを使用してください。

```html
<div :style="{ color: 'red', display: 'flex' }">

<!-- Will render: -->
<div style="color: red; display: flex;" ...>
```

<!-- Conditional inline styling is possible using expressions just like with x-bind:class. Short circuit operators can be used here as well by using a styles object as the second operand. -->

`x-bind:class` と同じように、式を使用して条件付きインラインスタイルを設定できます。ここでも、スタイルオブジェクトを第2引数として使用することにより、短絡演算子を使用できます。

```html
<div x-bind:style="true && { color: 'red' }">

<!-- Will render: -->
<div style="color: red;">
```

<!-- One advantage of this approach is being able to mix it in with existing styles on an element: -->

このアプローチの利点の1つは、要素の既存のスタイルと組み合わせることができることです。

```html
<div style="padding: 1rem;" :style="{ color: 'red', display: 'flex' }">

<!-- Will render: -->
<div style="padding: 1rem; color: red; display: flex;" ...>
```

<!-- And like most expressions in Alpine, you can always use the result of a JavaScript expression as the reference: -->

また、Alpine のほとんどの式と同様に、JavaScript 式の結果をいつでも参照として使用できます。

```html
<div x-data="{ styles: { color: 'red', display: 'flex' }}">
    <div :style="styles">
</div>

<!-- Will render: -->
<div ...>
    <div style="color: red; display: flex;" ...>
</div>
```

<a name="bind-directives"></a>

## Alpine ディレクティブを直接結合する

<!-- `x-bind` allows you to bind an object of different directives and attributes to an element. -->

<!-- The object keys can be anything you would normally write as an attribute name in Alpine. This includes Alpine directives and modifiers, but also plain HTML attributes. The object values are either plain strings, or in the case of dynamic Alpine directives, callbacks to be evaluated by Alpine. -->

`x-bind` を使用すると、さまざまなディレクティブと属性のオブジェクトを要素にバインドできます。

オブジェクトキーは、Alpine で属性名として通常書き込むものであれば何でもかまいません。これには、Alpine ディレクティブと修飾子だけでなく、プレーン HTML 属性も含まれます。オブジェクト値はプレーン文字列であるか、動的な Alpine ディレクティブの場合は、Alpine によって評価されるコールバックです。

```html
<div x-data="dropdown()">
    <button x-bind="trigger">Open Dropdown</button>

    <span x-bind="dialogue">Dropdown Contents</span>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,

            trigger: {
                ['x-ref']: 'trigger',
                ['@click']() {
                    this.open = true
                },
            },

            dialogue: {
                ['x-show']() {
                    return this.open
                },
                ['@click.outside']() {
                    this.open = false
                },
            },
        }))
    })
</script>
```

<!-- There are a couple of caveats to this usage of `x-bind`: -->

<!-- > When the directive being "bound" or "applied" is `x-for`, you should return a normal expression string from the callback. For example: `['x-for']() { return 'item in items' }` -->

この `x-bind` の使用法にはいくつかの注意点があります。

> 「バインド (bound)」または「適用 (applied)」されているディレクティブがの `x-for` 場合、コールバックから通常の式の文字列を返す必要があります。（ 例えば `['x-for']() { return 'item in items' }` ）


# x-on

<!-- `x-on` allows you to easily run code on dispatched DOM events. -->

<!-- Here's an example of simple button that shows an alert when clicked. -->

`x-on` は、ディスパッチ（割当）されている DOM イベント上で、自分で書いたコードを簡単に実行できます。

クリックするとアラートを表示するシンプルなボタンの例を次に示します。

```html
<button x-on:click="alert('Hello World!')">Say Hi</button>
```

<!-- > `x-on` can only listen for events with lower case names, as HTML attributes are case-insensitive. Writing `x-on:CLICK` will listen for an event named `click`. -->

 <!-- If you need to listen for a custom event with a camelCase name, you can use the [`.camel` helper](#camel) to work around this limitation.  -->
 
 <!-- Alternatively, you can use  [`x-bind`](/directives/bind#bind-directives) to attach an `x-on` directive to an element in javascript code (where case will be preserved). -->

> `x-on`を使用する際は、 HTML 属性で大文字と小文字が区別されないため、小文字のイベントのみをリッスンします。`x-on:CLICK` でしたら、`click` という名前のイベントをリッスンします。

> キャメルケース名のカスタムイベントをリッスンする必要がある場合は、`.camel` ヘルパーを使用してこの制限を回避できます。または、JavaScript コードの要素に `x-on` ディレクティブをアタッチするために `x-bind` を使用できます （大文字と小文字は区別されます）。

<a name="shorthand-syntax"></a>

## 省略構文

<!-- If `x-on:` is too verbose for your tastes, you can use the shorthand syntax: `@`. -->

<!-- Here's the same component as above, but using the shorthand syntax instead: -->


`x-on:` が冗長すぎて好みに合わない場合は、省略構文 `@` を使用できます。

上記と同じコンポーネントですが、代わりに省略構文を使用しています。

```html
<button @click="alert('Hello World!')">Say Hi</button>
```

<a name="the-event-object"></a>

## イベントオブジェクト

<!-- If you wish to access the native JavaScript event object from your expression, you can use Alpine's magic `$event` property. -->

式からネイティブ JavaScript イベントオブジェクトにアクセスする場合は、Alpineの魔法の `$event` プロパティを使用できます。

```html
<button @click="alert($event.target.getAttribute('message'))" message="Hello World">Say Hi</button>
```

<!-- In addition, Alpine also passes the event object to any methods referenced without trailing parenthesis. For example: -->

さらに、Alpineは、末尾の括弧なしで参照されるメソッドにイベントオブジェクトを渡します。例えば

```html
<button @click="handleClick">...</button>

<script>
    function handleClick(e) {
        // Now you can access the event object (e) directly
    }
</script>
```

<a name="keyboard-events"></a>

## キーボードイベント

<!-- Alpine makes it easy to listen for `keydown` and `keyup` events on specific keys. -->

<!-- Here's an example of listening for the `Enter` key inside an input element. -->

Alpine を使用すると、特定のキーの `keydown` および `keyup` イベントを簡単にリッスンできます。

これは、入力要素内で「Enter」キーをリッスンする例です。

```html
<input type="text" @keyup.enter="alert('Submitted!')">
```

<!-- You can also chain these key modifiers to achieve more complex listeners. -->

<!-- Here's a listener that runs when the `Shift` key is held and `Enter` is pressed, but not when `Enter` is pressed alone. -->

これらのキー修飾子をチェーンして、より複雑なリスナーを実現することもできます。

これは、`Shift` キーを押したまま、`Enter` キーを押したときに実行されるリスナーですが、単独で `Enter` キーを押したときは実行されません。

```html
<input type="text" @keyup.shift.enter="alert('Submitted!')">
```

<!-- You can directly use any valid key names exposed via [`KeyboardEvent.key`](https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/key/Key_Values) as modifiers by converting them to kebab-case. -->

[`KeyboardEvent.key`](https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/key/Key_Values) を介して公開された有効なキー名は、kebab-case に変換することで、修飾子として直接使用できます。

```html
<input type="text" @keyup.page-down="alert('Submitted!')">
```

<!-- For easy reference, here is a list of common keys you may want to listen for. -->

一般的にリッスンできるキーのリストです。

| Modifier                   | Keyboard Key                |
| -------------------------- | --------------------------- |
| `.shift`                    | Shift                       |
| `.enter`                    | Enter                       |
| `.space`                    | Space                       |
| `.ctrl`                     | Ctrl                        |
| `.cmd`                      | Cmd                         |
| `.meta`                     | Cmd on Mac, Ctrl on Windows |
| `.alt`                      | Alt                         |
| `.up` `.down` `.left` `.right` | Up/Down/Left/Right arrows   |
| `.escape`                   | Escape                      |
| `.tab`                      | Tab                         |
| `.caps-lock`                | Caps Lock                   |
| `.equal`                    | Equal, `=`                  |
| `.period`                   | Period, `.`                 |
| `.slash`                    | Foward Slash, `/`           |

<a name="custom-events"></a>

## カスタムイベント

<!-- Alpine event listeners are a wrapper for native DOM event listeners. Therefore, they can listen for ANY DOM event, including custom events. -->

<!-- Here's an example of a component that dispatches a custom DOM event and listens for it as well. -->

Alpine のイベントリスナーは、ネイティブDOMイベントリスナーのラッパーです。したがって、カスタムイベントを含むすべてのDOMイベントをリッスンできます。

これは、カスタムDOMイベントをディスパッチし、それもリッスンするコンポーネントの例です。

```html
<div x-data @foo="alert('Button Was Clicked!')">
	<button @click="$event.target.dispatchEvent(new CustomEvent('foo', { bubbles: true }))">...</button>
</div>
```

<!-- When the button is clicked, the `@foo` listener will be called. -->

<!-- Because the `.dispatchEvent` API is verbose, Alpine offers a `$dispatch` helper to simplify things. -->

<!-- Here's the same component re-written with the `$dispatch` magic property. -->

ボタンがクリックされると、`@foo` リスナーが呼び出されます。

`.dispatchEventAPI` は冗長であるため、Alpine は `$dispatch`ヘルパーで単純化して提供しています。

これは、`$dispatch` マジックプロパティで書き直された同じコンポーネントです。

```html
<div x-data @foo="alert('Button Was Clicked!')">
  <button @click="$dispatch('foo')">...</button>
</div>
```

[→ 「$dispatch」の詳細を読む](/magics/dispatch)

<a name="modifiers"></a>

## 修飾子

<!-- Alpine offers a number of directive modifiers to customize the behavior of your event listeners. -->

Alpine には、イベントリスナーの動作をカスタマイズするためのディレクティブ修飾子が複数用意されています。

<a name="prevent"></a>

### .prevent

<!-- `.prevent` is the equivalent of calling `.preventDefault()` inside a listener on the browser event object. -->

`.prevent` は、ブラウザのイベントオブジェクトのリスナー内で呼び出す `.preventDefault()` と同等です。

```html
<form @submit.prevent="console.log('submitted')" action="/foo">
    <button>Submit</button>
</form>
```

<!-- In the above example, with the `.prevent`, clicking the button will NOT submit the form to the `/foo` endpoint. Instead, Alpine's listener will handle it and "prevent" the event from being handled any further. -->

上記の例では、`.prevent` が付与されたボタンをクリックしてもフォームは `/foo` のエンドポイントに送信されません。代わりに、Alpine のリスナーがそれを処理し、イベントがそれ以上処理されないようにします。

<a name="stop"></a>

### .stop

<!-- Similar to `.prevent`, `.stop` is the equivalent of calling `.stopPropagation()` inside a listener on the browser event object. -->

`.prevent` と同様に、`.stop` は、ブラウザイベントオブジェクトのリスナー内で `.stopPropagation()`を呼び出すのと同じです。

```html
<div @click="console.log('I will not get logged')">
    <button @click.stop>Click Me</button>
</div>
```

<!-- In the above example, clicking the button WON'T log the message. This is because we are stopping the propagation of the event immediately and not allowing it to "bubble" up to the `<div>` with the `@click` listener on it. -->

<!-- 上記の例では、ボタンをクリックしてもメッセージはログに記録されません。これは、イベントの伝播をすぐに停止<div>し、@clickリスナーが乗っている状態でイベントが「バブル」することを許可していないためです。 -->

上記の例では、ボタンをクリックしてもメッセージはログに記録されません。これは、イベントの伝播をすぐに停止し、`@click` リスナーが設定された `<div>` までイベントを「bubble」させないためです。

<a name="outside"></a>

### .outside

<!-- `.outside` is a convenience helper for listening for a click outside of the element it is attached to. Here's a simple dropdown component example to demonstrate: -->

`.outside` は、アタッチされている要素の外側のクリックをリッスンするための便利なヘルパーです。次に、簡単なドロップダウンコンポーネントの例を示します。

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <div x-show="open" @click.outside="open = false">
        Contents...
    </div>
</div>
```

<!-- In the above example, after showing the dropdown contents by clicking the "Toggle" button, you can close the dropdown by clicking anywhere on the page outside the content. -->

上記の例では、「Toggle」ボタンをクリックしてドロップダウンのコンテンツを表示した後、コンテンツの外側のページの任意の場所をクリックしてドロップダウンを閉じることができます。

これは、`.outside` が登録されている要素から発生していないクリックをリッスンしているためです。

<!-- > It's worth noting that the `.outside` expression will only be evaluated when the element it's registered on is visible on the page. Otherwise, there would be nasty race conditions where clicking the "Toggle" button would also fire the `@click.outside` handler when it is not visible. -->

`.outside` 式は、それが登録されている要素がページに表示されている場合にのみ評価されることに注意してください。そうしないと、「Toggle」ボタンをクリックすると、表示されていないときに `@click.outside` ハンドラーも起動するという厄介な競合状態が発生します。

<a name="window"></a>

### .window

<!-- When the `.window` modifier is present, Alpine will register the event listener on the root `window` object on the page instead of the element itself. -->

`.window` 修飾子が存在する場合、Alpine は、要素自体ではなく、ページ上のルート`window` オブジェクトにイベントリスナーを登録します。

```html
<div @keyup.escape.window="...">...</div>
```

<!-- The above snippet will listen for the "escape" key to be pressed ANYWHERE on the page. -->

<!-- Adding `.window` to listeners is extremely useful for these sorts of cases where a small part of your markup is concerned with events that take place on the entire page. -->

上記のスニペットは、ページのどこでも押される「escape」キーをリッスンします。

リスナーに `.window` を追加すると、マークアップのごく一部がページ全体で発生するイベントに関係しているような場合に非常に役立ちます。

<a name="document"></a>

### .document

<!-- `.document` works similarly to `.window` only it registers listeners on the `document` global, instead of the `window` global. -->

`.document` は `.window` と同様に機能しますが、`window` グローバルではなく `document` グローバルにリスナーを登録します。

<a name="once"></a>

### .once

<!-- By adding `.once` to a listener, you are ensuring that the handler is only called ONCE. -->

リスナーに `.once` を追加することで、ハンドラーが1回だけ呼び出されるようになります。

```html
<button @click.once="console.log('I will only log once')">...</button>
```

<a name="debounce"></a>

### .debounce

<!-- Sometimes it is useful to "debounce" an event handler so that it only is called after a certain period of inactivity (250 milliseconds by default). -->

<!-- For example if you have a search field that fires network requests as the user types into it, adding a debounce will prevent the network requests from firing on every single keystroke. -->

イベントハンドラーを「デバウンス」して、特定の非アクティブ期間（デフォルトでは250ミリ秒）の後にのみ呼び出されるようにすると便利な場合があります。

たとえば、ユーザーが入力したときにネットワークリクエストを発生させる検索フィールドがある場合、デバウンスを追加すると、キーストロークごとにネットワークリクエストが発生するのを防ぐことができます。

```html
<input @input.debounce="fetchResults">
```

<!-- Now, instead of calling `fetchResults` after every keystroke, `fetchResults` will only be called after 250 milliseconds of no keystrokes. -->

<!-- If you wish to lengthen or shorten the debounce time, you can do so by trailing a duration after the `.debounce` modifier like so: -->

これで、すべてのキーストロークの後に `fetchResults` を呼び出す代わりに、`fetchResults` はキーストロークがない250ミリ秒後にのみ呼び出されます。

デバウンス時間を長くしたり短くしたりする場合は、次のように `.debounce` 修飾子の後に継続時間を追跡することでこれを行うことができます。

```html
<input @input.debounce.500ms="fetchResults">
```

<!-- Now, `fetchResults` will only be called after 500 milliseconds of inactivity. -->

現在、`fetchResults` は、500ミリ秒の非アクティブの後にのみ呼び出されます。

<a name="throttle"></a>

### .throttle

<!-- `.throttle` is similar to `.debounce` except it will release a handler call every 250 milliseconds instead of deferring it indefinitely. -->

<!-- This is useful for cases where there may be repeated and prolonged event firing and using `.debounce` won't work because you want to still handle the event every so often. -->

`.throttle` は `.debounce` に似ていますが、ハンドラー呼び出しを無期限に延期するのではなく、250ミリ秒ごとに解放する点が異なります。

これは、イベントの発生が繰り返されて長時間発生する可能性があり、イベントを頻繁に処理する必要があるため、`.debounce` の使用が機能しない場合に役立ちます。

例えば、

```html
<div @scroll.window.throttle="handleScroll">...</div>
```

<!-- The above example is a great use case of throttling. Without `.throttle`, the `handleScroll` method would be fired hundreds of times as the user scrolls down a page. This can really slow down a site. By adding `.throttle`, we are ensuring that `handleScroll` only gets called every 250 milliseconds. -->

<!-- > Fun Fact: This exact strategy is used on this very documentation site to update the currently highlighted section in the right sidebar. -->

<!-- Just like with `.debounce`, you can add a custom duration to your throttled event: -->

上記の例は、スロットルの優れたユースケースです。 `.throttle` がないと、ユーザーがページを下にスクロールするときに、`handleScroll` メソッドが何百回も起動されます。これにより、サイトの速度が大幅に低下する可能性があります。 `.throttle` を追加することで、`handleScroll` が250ミリ秒ごとにのみ呼び出されるようにしています。

> おもしろ情報：この正確な戦略は、まさにこのドキュメントサイトで使用され、右側のサイドバーで現在強調表示されているセクションを更新します。

`.debounce` と同様に、スロットルされたイベントにカスタム期間を追加できます。

```html
<div @scroll.window.throttle.750ms="handleScroll">...</div>
```

Now, `handleScroll` will only be called every 750 milliseconds.

ここでは、`handleScroll` は 750ミリ秒ごとに呼び出されます。

<a name="self"></a>

### .self

<!-- By adding `.self` to an event listener, you are ensuring that the event originated on the element it is declared on, and not from a child element. -->

イベントリスナーに `.self` を追加することで、イベントが子要素からではなく、宣言された要素から発生したことを確認できます。

```html
<button @click.self="handleClick">
    Click Me

    <img src="...">
</button>
```

<!-- In the above example, we have an `<img>` tag inside the `<button>` tag. Normally, any click originating within the `<button>` element (like on `<img>` for example), would be picked up by a `@click` listener on the button. -->

<!-- However, in this case, because we've added a `.self`, only clicking the button itself will call `handleClick`. Only clicks originating on the `<img>` element will not be handled. -->

上記の例では、`<button>` タグ内に `<img>` タグがあります。通常、`<button>` 要素内で発生したクリック（たとえば `<img>` など）は、ボタンの `@click` リスナーによって検出されます。

ただし、この場合 `.self` を追加したため、ボタン自体をクリックするだけで `handleClick` が呼び出されます。`<img>` 要素で発生したクリックのみが処理されません。

<a name="camel"></a>

### .camel

```html
<div @custom-event.camel="handleCustomEvent">
    ...
</div>
```

<!-- Sometimes you may want to listen for camelCased events such as `customEvent` in our example. Because camelCasing inside HTML attributes is not supported, adding the `.camel` modifier is necessary for Alpine to camelCase the event name internally. -->

<!-- By adding `.camel` in the above example, Alpine is now listening for `customEvent` instead of `custom-event`. -->

この例では、`customEvent` などのキャメルケースイベントをリッスンしたい場合があります。 HTML属性内のcamelCasingはサポートされていないため、Alpineがイベント名を内部でcamelCaseにするには、`.camel` 修飾子を追加する必要があります。

上記の例で `.camel` を追加することにより、Alpine は `custom-event` ではなく `customEvent` をリッスンするようになりました。

<a name="dot"></a>

### .dot

```html
<div @custom-event.dot="handleCustomEvent">
    ...
</div>
```

<!-- Similar to the `.camelCase` modifier there may be situations where you want to listen for events that have dots in their name (like `custom.event`). Since dots within the event name are reserved by Alpine you need to write them with dashes and add the `.dot` modifier. -->

<!-- In the code example above `custom-event.dot` will correspond to the event name `custom.event`. -->

`.camelCase` 修飾子と同様に、名前にドットが含まれるイベント（ `custom.event` など）をリッスンしたい場合があります。イベント名内のドットはAlpineによって予約されているため、ダッシュを使用してドットを記述し、`.dot` 修飾子を追加する必要があります。

上記のコード例では、`custom-event.dot` はイベント名 `custom.event` に対応しています。

<a name="passive"></a>

### .passive

<!-- Browsers optimize scrolling on pages to be fast and smooth even when JavaScript is being executed on the page. However, improperly implemented touch and wheel listeners can block this optimization and cause poor site performance. -->

<!-- If you are listening for touch events, it's important to add `.passive` to your listeners to not block scroll performance. -->

ブラウザは、JavaScript がページで実行されている場合でも、ページのスクロールを高速かつスムーズに最適化します。ただし、不適切に実装されたタッチおよびホイールリスナーは、この最適化をブロックし、サイトのパフォーマンスを低下させる可能性があります。

タッチイベントをリッスンしている場合は、スクロールのパフォーマンスを妨げないように、リスナーに `.passive` を追加することが重要です。

```html
<div @touchstart.passive="...">...</div>
```

[→ パッシブリスナーについてもっと読む](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#improving_scrolling_performance_with_passive_listeners)



# x-text

<!-- `x-text` sets the text content of an element to the result of a given expression. -->

<!-- Here's a basic example of using `x-text` to display a user's username. -->

`x-text`は、要素のテキストコンテンツを特定の式の結果に設定します。

`x-text`を使用してユーザーのユーザー名を表示する基本的な例を次に示します。

```html
<div x-data="{ username: 'calebporzio' }">
    Username: <strong x-text="username"></strong>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ username: 'calebporzio' }">
        Username: <strong x-text="username"></strong>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now the `<strong>` tag's inner text content will be set to "calebporzio". -->

これで、`<strong>` タグの内部テキストコンテンツが「calebporzio」に設定されます。


# x-html

<!-- `x-html` sets the "innerHTML" property of an element to the result of a given expression. -->

<!-- > ⚠️ Only use on trusted content and never on user-provided content. ⚠️ -->
<!-- > Dynamically rendering HTML from third parties can easily lead to XSS vulnerabilities. -->

<!-- Here's a basic example of using `x-html` to display a user's username. -->

`x-html` は、要素の「 innerHTML 」プロパティを指定された式の結果に設定します。

> ⚠️ 信頼できるコンテンツにのみ使用し、ユーザー提供のコンテンツには使用しないでください。⚠️

> サードパーティから HTML を動的にレンダリングすると、XSS の脆弱性が簡単に発生する可能性があります。

`x-html` を使用してユーザーのユーザー名を表示する基本的な例を次に示します。

```html
<div x-data="{ username: '<strong>calebporzio</strong>' }">
    Username: <span x-html="username"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ username: '<strong>calebporzio</strong>' }">
        Username: <span x-html="username"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now the `<span>` tag's inner HTML will be set to "<strong>calebporzio</strong>". -->

これで、`<span>`タグの内部HTMLが「<strong>calebporzio</strong>」に設定されます。



# x-model

<!-- `x-model` allows you to bind the value of an input element to Alpine data. -->

<!-- Here's a simple example of using `x-model` to bind the value of a text field to a piece of data in Alpine. -->

`x-model`を使用すると、入力要素の値を Alpineの データにバインドできます。

これは、`x-model` を使用してテキストフィールドの値をAlpine のデータにバインドする簡単な例です。

```html
<div x-data="{ message: '' }">
    <input type="text" x-model="message">

    <span x-text="message">
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <input type="text" x-model="message" placeholder="Type message...">

        <div class="pt-4" x-text="message"></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now as the user types into the text field, the `message` will be reflected in the `<span>` tag. -->

<!-- `x-model` is two-way bound, meaning it both "sets" and "gets". In addition to changing data, if the data itself changes, the element will reflect the change. -->

<!-- We can use the same example as above but this time, we'll add a button to change the value of the `message` property. -->

これで、ユーザーがテキストフィールドに入力すると、`message` プロパティの値が `<span>` タグに反映されます。

`x-model` は双方向にバインドされており、「sets (入力)」と「gets (取得)」の両方を意味します。 データの変更に加えて、データ自体が変更された場合、要素は変更を反映します。

上記と同じ例を使用できますが、今回は、`message` プロパティの値を変更するためのボタンを追加します。

```html
<div x-data="{ message: '' }">
    <input type="text" x-model="message">

    <button x-on:click="message = 'changed'">Change Message</button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <input type="text" x-model="message" placeholder="Type message...">

        <button x-on:click="message = 'changed'">Change Message</button>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now when the `<button>` is clicked, the input element's value will instantly be updated to "changed". -->

<!-- `x-model` works with the following input elements: -->

これで、 `<button>` をクリックすると、入力要素の値がすぐに「changed」に更新されます。

`x-model` は、次の入力要素で機能します。

* `<input type="text">`
* `<textarea>`
* `<input type="checkbox">`
* `<input type="radio">`
* `<select>`

<a name="text-inputs"></a>

## テキストの入力

```html
<input type="text" x-model="message">

<span x-text="message"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <input type="text" x-model="message" placeholder="Type message">

        <div class="pt-4" x-text="message"></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="textarea-inputs"></a>

## テキストエリアの入力

```html
<textarea x-model="message"></textarea>

<span x-text="message"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <textarea x-model="message" placeholder="Type message"></textarea>

        <div class="pt-4" x-text="message"></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="checkbox-inputs"></a>

## チェックボックスの入力

<a name="single-checkbox-with-boolean"></a>

### ブール値を含む単一のチェックボックス

```html
<input type="checkbox" id="checkbox" x-model="show">

<label for="checkbox" x-text="show"></label>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ open: '' }">
        <input type="checkbox" id="checkbox" x-model="open">

        <label for="checkbox" x-text="open"></label>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="multiple-checkboxes-bound-to-array"></a>

### 配列にバインドされた複数のチェックボックス

```html
<input type="checkbox" value="red" x-model="colors">
<input type="checkbox" value="orange" x-model="colors">
<input type="checkbox" value="yellow" x-model="colors">

Colors: <span x-text="colors"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ colors: [] }">
        <input type="checkbox" value="red" x-model="colors">
        <input type="checkbox" value="orange" x-model="colors">
        <input type="checkbox" value="yellow" x-model="colors">

        <div class="pt-4">Colors: <span x-text="colors"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="radio-inputs"></a>

## ラジオボタンの入力

```html
<input type="radio" value="yes" x-model="answer">
<input type="radio" value="no" x-model="answer">

Answer: <span x-text="answer"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ answer: '' }">
        <input type="radio" value="yes" x-model="answer">
        <input type="radio" value="no" x-model="answer">

        <div class="pt-4">Answer: <span x-text="answer"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="select-inputs"></a>

## 単一のインプット


<a name="single-select"></a>

### 単一のセレクトボックス

```html
<select x-model="color">
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>

Color: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color">
            <option>Red</option>
            <option>Orange</option>
            <option>Yellow</option>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="single-select-with-placeholder"></a>

### プレースホルダー付きの単一選択

```html
<select x-model="color">
    <option value="" disabled>Select A Color</option>
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>

Color: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color">
            <option value="" disabled>Select A Color</option>
            <option>Red</option>
            <option>Orange</option>
            <option>Yellow</option>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="multiple-select"></a>

### 複数選択のセレクトボックス

```html
<select x-model="color" multiple>
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>

Colors: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color" multiple>
            <option>Red</option>
            <option>Orange</option>
            <option>Yellow</option>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="dynamically-populated-select-options"></a>

### 動的に入力される選択オプション

```html
<select x-model="color">
    <template x-for="color in ['Red', 'Orange', 'Yellow']">
        <option x-text="color"></option>
    </template>
</select>

Color: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color">
            <template x-for="color in ['Red', 'Orange', 'Yellow']">
                <option x-text="color"></option>
            </template>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="modifiers"></a>

## 修飾子

<a name="lazy"></a>

### `.lazy`

<!-- On text inputs, by default, `x-model` updates the property on every keystroke. By adding the `.lazy` modifier, you can force an `x-model` input to only update the property when user focuses away from the input element. -->

<!-- This is handy for things like real-time form-validation where you might not want to show an input validation error until the user "tabs" away from a field. -->

テキスト入力では、デフォルトで、`x-model` はキーストロークごとにプロパティを更新します。 `.lazy` 修飾子を追加することにより、ユーザーが入力要素から離れてフォーカスした場合にのみ、`x-model` 入力がプロパティを更新するように強制できます。

これは、ユーザーがフィールドから「tabs」で移動するまで入力検証エラーを表示したくないリアルタイムのフォーム検証などに便利です。

```html
<input type="text" x-model.lazy="username">
<span x-show="username.length > 20">The username is too long.</span>
```

<a name="number"></a>

### `.number`

<!-- By default, any data stored in a property via `x-model` is stored as a string. To force Alpine to store the value as a JavaScript number, add the `.number` modifier. -->

デフォルトでは、`x-model` を介してプロパティに保存されているデータはすべて文字列として保存されます。 Alpine に値を JavaScript 番号として保存させるには、`.number` 修飾子を追加します。

```html
<input type="text" x-model.number="age">
<span x-text="typeof age"></span>
```

<a name="debounce"></a>

### `.debounce`

<!-- By adding `.debounce` to `x-model`, you can easily debounce the updating of bound input. -->

<!-- This is useful for things like real-time search inputs that fetch new data from the server every time the search property changes. -->

`.debounce` を `x-model` に追加することで、バインドされた入力の更新を簡単にデバウンスできます。

これは、検索プロパティが変更されるたびにサーバーから新しいデータをフェッチするリアルタイム検索入力などに役立ちます。

```html
<input type="text" x-model.debounce="search">
```

<!-- The default debounce time is 250 milliseconds, you can easily customize this by adding a time modifier like so. -->

デフォルトのデバウンス時間は250ミリ秒です。このように時間修飾子を追加することで、これを簡単にカスタマイズできます。

```html
<input type="text" x-model.debounce.500ms="search">
```

<a name="throttle"></a>

### `.throttle`

<!-- Similar to `.debounce` you can limit the property update triggered by `x-model` to only updating on a specified interval. -->

`.debounce` と同様に、`x-model` によってトリガーされるプロパティの更新を指定された間隔でのみ更新するように制限できます。

```html
<input type="text" x-model.throttle="search">
```

<!-- The default throttle interval is 250 milliseconds, you can easily customize this by adding a time modifier like so. -->

デフォルトのスロットル間隔は250ミリ秒です。次の例では、時間を付与した修飾子を追加することでカスタマイズもできます。

```html
<input type="text" x-model.throttle.500ms="search">
```

<a name="programmatic access"></a>

## プログラムによるアクセス

<!-- Alpine exposes under-the-hood utilities for getting and setting properties bound with `x-model`. This is useful for complex Alpine utilities that may want to override the default x-model behavior, or instances where you want to allow `x-model` on a non-input element. -->

<!-- You can access these utilities through a property called `_x_model` on the `x-model`ed element. `_x_model` has two methods to get and set the bound property: -->

<!-- * `el._x_model.get()` (returns the value of the bound property) -->
<!-- * `el._x_model.set()` (sets the value of the bound property) -->

Alpineは、`x-model` でバインドされたプロパティを取得および設定するための内部ユーティリティを公開しています。 これは、デフォルトの `x-model` の動作をオーバーライドしたい複雑な Alpine ユーティリティや、非入力要素で `x-model` を許可したい場合に便利です。

これらのユーティリティには、`x-model` ed要素の `_x_model` というプロパティを介してアクセスできます。 `_x_model` には、バインドされたプロパティを取得および設定するための2つのメソッドがあります。

* `el._x_model.get()`（バインドされたプロパティの値を返します）
* `el._x_model.set()`（バインドされたプロパティの値を設定します）

```html
<div x-data="{ username: 'calebporzio' }">
    <div x-ref="div" x-model="username"></div>

    <button @click="$refs.div._x_model.set('phantomatrix')">
        Change username to: 'phantomatrix'
    </button>

    <span x-text="$refs.div._x_model.get()"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ username: 'calebporzio' }">
        <div x-ref="div" x-model="username"></div>

        <button @click="$refs.div._x_model.set('phantomatrix')">
            Change username to: 'phantomatrix'
        </button>

        <span x-text="$refs.div._x_model.get()"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```



# x-modelable

<!-- `x-modelable` allows you to expose any Alpine property as the target of the `x-model` directive. -->

<!-- Here's a simple example of using `x-modelable` to expose a variable for binding with `x-model`. -->

`x-modelable` を使用すると、任意の Alpine プロパティを `x-model` ディレクティブのターゲットとして公開できます。

これは、`x-modelable` を使用して `x-model` とバインドするための変数を公開する簡単な例です。

```html
<div x-data="{ number: 5 }">
    <div x-data="{ count: 0 }" x-modelable="count" x-model="number">
        <button @click="count++">Increment</button>
    </div>

    Number: <span x-text="number"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ number: 5 }">
        <div x-data="{ count: 0 }" x-modelable="count" x-model="number">
            <button @click="count++">Increment</button>
        </div>

        Number: <span x-text="number"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- As you can see the outer scope property "number" is now bound to the inner scope property "count". -->

<!-- Typically this feature would be used in conjunction with a backend templating framework like Laravel Blade. It's useful for abstracting away Alpine components into backend templates and exposing state to the outside through `x-model` as if it were a native input. -->

ご覧のとおり、外部スコープのプロパティ「number」は内部スコープのプロパティ「count」にバインドされています。

通常、この機能はLaravelBladeのようなバックエンドテンプレートフレームワークと組み合わせて使用されます。 これは、Alpine コンポーネントをバックエンドテンプレートに抽象化し、ネイティブ入力であるかのように `x-model` を介して状態を外部に公開するのに役立ちます。



# x-for

<!-- Alpine's `x-for` directive allows you to create DOM elements by iterating through a list. Here's a simple example of using it to create a list of colors based on an array. -->

Alpine の `x-for` ディレクティブを使用すると、リストを反復処理してDOM要素を作成できます。これを使用して、配列に基づいて色のリストを作成する簡単な例を次に示します。

```html
<ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
    <template x-for="color in colors">
        <li x-text="color"></li>
    </template>
</ul>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
        <template x-for="color in colors">
            <li x-text="color"></li>
        </template>
    </ul>
</div>
<!-- END_VERBATIM -->
```

<!-- There are two rules worth noting about `x-for`: -->

<!-- * `x-for` MUST be declared on a `<template>` element -->
<!-- * That `<template>` element MUST have only one root element -->

`x-for` について注目する価値のある2つのルールがあります。

* `x-for`は `<template>` 要素で宣言する必要があります
* その `<template>` 要素は1つのルート要素のみを持たなければなりません

<a name="keys"></a>

## Keys

<!-- It is important to specify unique keys for each `x-for` iteration if you are going to be re-ordering items. Without dynamic keys, Alpine may have a hard time keeping track of what re-orders and will cause odd side-effects. -->

アイテムを並べ替える場合は、`x-for` の反復ごとに一意のキーを指定することが重要です。動的キーがないと、Alpine は何が並べ替えられるかを追跡するのに苦労し、奇妙な副作用を引き起こす可能性があります。

```html
<ul x-data="{ colors: [
    { id: 1, label: 'Red' },
    { id: 2, label: 'Orange' },
    { id: 3, label: 'Yellow' },
]}">
    <template x-for="color in colors" :key="color.id">
        <li x-text="color.label"></li>
    </template>
</ul>
```

<!-- Now if the colors are added, removed, re-ordered, or their "id"s change, Alpine will preserve or destroy the iterated `<li>`elements accordingly. -->

これで、色が追加、削除、並べ替えられた場合、またはそれらの「id」が変更された場合、Alpineはそれに応じて繰り返される `<li>` 要素を保持または破棄します。

<a name="accessing-indexes"></a>

## インデックスへのアクセス

<!-- If you need to access the index of each item in the iteration, you can do so using the `([item], [index]) in [items]` syntax like so: -->

反復で各アイテムのインデックスにアクセスする必要がある場合は、次のようにしてアクセスできます。例：「 `(color, index) in colors` 」

```html
<ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
    <template x-for="(color, index) in colors">
        <li>
            <span x-text="index + ': '"></span>
            <span x-text="color"></span>
        </li>
    </template>
</ul>
```

<!-- You can also access the index inside a dynamic `:key` expression. -->

動的な `:key` 式内のインデックスにアクセスすることもできます。

```html
<template x-for="(color, index) in colors" :key="index">
```

<a name="iterating-over-a-range"></a>

## 範囲を反復する

配列を反復処理するのではなく、単に `n` 回ループする必要がある場合、Alpine は短い構文を提供します。

```html
<ul>
    <template x-for="i in 10">
        <li x-text="i"></li>
    </template>
</ul>
```

<!-- `i` in this case can be named anything you like. -->

この場合の `i` には、好きな名前をつけることができます。


# x-transition

<!-- Alpine provides a robust transitions utility out of the box. With a few `x-transition` directives, you can create smooth transitions between when an element is shown or hidden. -->

<!-- There are two primary ways to handle transitions in Alpine: -->

Alpine は、すぐに使用できる堅牢なトランジションユーティリティを提供します。 いくつかの `x-transition` ディレクティブを使用すると、要素が「表示」または「非表示」になるときの間のスムーズな遷移を作成できます。

Alpine でトランジションを処理するには、主に2つの方法があります。

* [The Transition Helper](#the-transition-helper)
* [Applying CSS Classes](#applying-css-classes)

<a name="the-transition-helper"></a>

## トランジション ヘルパー

<!-- The simplest way to achieve a transition using Alpine is by adding `x-transition` to an element with `x-show` on it. For example: -->

Alpine を使用してトランジションを実現する最も簡単な方法は、`x-show` が含まれる要素に `x-transition` を追加することです。 例えば：

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <span x-show="open" x-transition>
        Hello 👋
    </span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle</button>

        <span x-show="open" x-transition>
            Hello 👋
        </span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- As you can see, by default, `x-transition` applies pleasant transition defaults to fade and scale the revealing element. -->

<!-- You can override these defaults with modifiers attached to `x-transition`. Let's take a look at those. -->

ご覧のとおり、デフォルトでは、`x-transition` は快適なトランジションのデフォルトを適用して、表示要素をフェードおよびスケーリングします。

これらのデフォルトは、`x-transition` に付加された修飾子でオーバーライドできます。 それらを見てみましょう。

<a name="customizing-duration"></a>

### 実行時間のカスタマイズ

<!-- Initially, the duration is set to be 150 milliseconds when entering, and 75 milliseconds when leaving. -->

<!-- You can configure the duration you want for a transition with the `.duration` modifier: -->

初期設定として、トランジションのアニメーション時間は「enter (開始)」に150ミリ秒、「leave (終了)」に75ミリ秒に設定されています。

`.duration` 修飾子を使用して、トランジションに必要な時間を構成できます。

```html
<div ... x-transition.duration.500ms>
```

<!-- The above `<div>` will transition for 500 milliseconds when entering, and 500 milliseconds when leaving. -->

上記の `<div>` は、「開始」と「終了」に、500ミリ秒の間隔を持ってトランジションが実行されます。

<!-- If you wish to customize the durations specifically for entering and leaving, you can do that like so: -->

もし、個々に「enter (入力時)」「leave (終了時)」の間隔を設定したい場合は、以下のように指定します。

```html
<div ...
    x-transition:enter.duration.500ms
    x-transition:leave.duration.400ms
>
```

<a name="customizing-delay"></a>

### 遅延のカスタマイズ

<!-- You can delay a transition using the `.delay` modifier like so: -->

以下のように `.delay` 修飾子を使用して、トランジションを遅延させることもできます。

```html
<div ... x-transition.delay.50ms>
```

<!-- The above example will delay the transition and in and out of the element by 50 milliseconds. -->

上記の例では、要素の「開始」と「終了」のトランジションを50ミリ秒 遅らせて実行されます。

<a name="customizing-opacity"></a>

### 不透明度のカスタマイズ

<!-- By default, Alpine's `x-transition` applies both a scale and opacity transition to achieve a "fade" effect. -->

<!-- If you wish to only apply the opacity transition (no scale), you can accomplish that like so: -->

デフォルトでは、Alpineの `x-transition` は、スケールと不透明度の両方の遷移を適用して、「フェード」効果を実現します。

不透明度の遷移（スケールなし）のみを適用する場合は、次のように実行できます。

```html
<div ... x-transition.opacity>
```

<a name="customizing-scale"></a>

### スケールのカスタマイズ

<!-- Similar to the `.opacity` modifier, you can configure `x-transition` to ONLY scale (and not transition opacity as well) like so: -->

`.opacity` モディファイヤと同様に、次のように、` x-transition` をスケーリングのみに設定できます（不透明度も遷移しません）。

```html
<div ... x-transition.scale>
```

<!-- The `.scale` modifier also offers the ability to configure its scale values AND its origin values: -->

`.scale` 修飾子は、そのスケール値とその原点値を構成する機能も提供します。

```html
<div ... x-transition.scale.80>
```

<!-- The above snippet will scale the element up and down by 80%. -->

<!-- Again, you may customize these values separately for enter and leaving transitions like so: -->

上記のスニペットは、要素を 80％ 拡大および縮小します。

繰り返しになりますが、次のように、トランジションの開始と終了のためにこれらの値を個別にカスタマイズできます。

```html
<div ...
    x-transition:enter.scale.80
    x-transition:leave.scale.90
>
```

<!-- To customize the origin of the scale transition, you can use the `.origin` modifier: -->

スケールトランジションの原点をカスタマイズするには、`.origin` 修飾子を使用できます。

```html
<div ... x-transition.scale.origin.top>
```

<!-- Now the scale will be applied using the top of the element as the origin, instead of the center by default. -->

<!-- Like you may have guessed, the possible values for this customization are: `top`, `bottom`, `left`, and `right`. -->

<!-- If you wish, you can also combine two origin values. For example, if you want the origin of the scale to be "top right", you can use: `.origin.top.right` as the modifier. -->

これで、デフォルトでは中心ではなく、要素の上部を原点としてスケールが適用されます。

ご想像のとおり、このカスタマイズに使用できる値は、 `top`、` bottom`、`left`、および `right` です。

必要に応じて、2つの原点の値を組み合わせることもできます。 たとえば、スケールの原点を「top right」にする場合は、修飾子として `.origin.top.right` を使用できます。


<a name="applying-css-classes"></a>

## CSSクラスの適用

<!-- For direct control over exactly what goes into your transitions, you can apply CSS classes at different stages of the transition. -->

<!-- > The following examples use [TailwindCSS](https://tailwindcss.com/docs/transition-property) utility classes. -->

トランジションに何が入るかを正確に制御するために、トランジションのさまざまな段階で CSS クラスを適用できます。

> 次の例では、[TailwindCSS]（https://tailwindcss.com/docs/transition-property）ユーティリティクラスを使用しています。

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
    >Hello 👋</div>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90"
        x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
    >Hello 👋</div>
</div>
</div>
<!-- END_VERBATIM -->
```

<!-- | Directive      | Description |
| ---            | --- |
| `:enter`       | Applied during the entire entering phase. |
| `:enter-start` | Added before element is inserted, removed one frame after element is inserted. |
| `:enter-end`   | Added one frame after element is inserted (at the same time `enter-start` is removed), removed when transition/animation finishes.
| `:leave`       | Applied during the entire leaving phase. |
| `:leave-start` | Added immediately when a leaving transition is triggered, removed after one frame. |
| `:leave-end`   | Added one frame after a leaving transition is triggered (at the same time `leave-start` is removed), removed when the transition/animation finishes. -->

| Directive (指令)| Description (説明)|
| --- | --- |
| `:enter` | 開始フェーズ全体で適用されます。 |
| `:enter-start` | 要素が挿入される前に追加され、要素が挿入されてから1フレーム後に削除されます。 |
| `:enter-end` | 要素が挿入された後に1フレーム追加され（同時に `enter-start`が削除されます）、トランジションのアニメーションが終了すると削除されます。
| `:leave` | 終了トランジションのフェーズ全体で適用されます。 |
| `:leave-start` | 終了トランジションがトリガーされるとすぐに追加され、1フレーム後に削除されます。 |
| `:leave-end` | 終了トランジションがトリガーされた後に、1フレーム追加され（同時に `leave-start`が削除されます）、トランジションのアニメーションが終了したときに削除されます。



# x-effect

<!-- `x-effect` is a useful directive for re-evaluating an expression when one of its dependencies change. You can think of it as a watcher where you don't have to specify what property to watch, it will watch all properties used within it. -->

<!-- If this definition is confusing for you, that's ok. It's better explained through an example: -->

`x-effect` は、依存関係の1つが変更されたときに式を再評価するための便利なディレクティブです。 監視するプロパティを指定する必要がなく、その中で使用されているすべてのプロパティを監視するウォッチャーと考えることができます。

この定義がわかりにくい場合は、問題ありません。 それは例を通してよりよく説明されます：

```html
<div x-data="{ label: 'Hello' }" x-effect="console.log(label)">
    <button @click="label += ' World!'">Change Message</button>
</div>
```

<!-- When this component is loaded, the `x-effect` expression will be run and "Hello" will be logged into the console. -->

<!-- Because Alpine knows about any property references contained within `x-effect`, when the button is clicked and `label` is changed, the effect will be re-triggered and "Hello World!" will be logged to the console. -->

このコンポーネントがロードされると、 `x-effect` 式が実行され、「Hello」がコンソールに記録されます。

Alpine は `x-effect` に含まれるプロパティ参照を認識しているため、ボタンがクリックされて `label` が変更されると、エフェクトが再度トリガーされて「HelloWorld！」になり、コンソールに表示されます。


# x-ignore

<!-- By default, Alpine will crawl and initialize the entire DOM tree of an element containing `x-init` or `x-data`. -->

<!-- If for some reason, you don't want Alpine to touch a specific section of your HTML, you can prevent it from doing so using `x-ignore`. -->

デフォルトでは、Alpineは `x-init` または `x-data` を含む要素のDOMツリー全体をクロールして初期化します。

何らかの理由で、Alpine が HTML の特定のセクションに触れないようにする場合は、`x-ignore` を使用してそれを防ぐことができます。

```html
<div x-data="{ label: 'From Alpine' }">
    <div x-ignore>
        <span x-text="label"></span>
    </div>
</div>
```

In the above example, the `<span>` tag will not contain "From Alpine" because we told Alpine to ignore the contents of the `div` completely.

上記の例では、`div` の内容を完全に無視するように Alpine に指示したため、`<span>` タグには"FromAlpine" は含まれません。



# x-ref

<!-- `x-ref` in combination with `$refs` is a useful utility for easily accessing DOM elements directly. It's most useful as a replacement for APIs like `getElementById` and `querySelector`. -->

`$refs` と組み合わせた `x-ref` は、DOM 要素に直接簡単にアクセスするための便利なユーティリティです。 これは、`getElementById` や `querySelector` などの API の代わりとして最も役立ちます。

```html
<button @click="$refs.text.remove()">Remove Text</button>

<span x-ref="text">Hello 👋</span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data>
        <button @click="$refs.text.remove()">Remove Text</button>

        <div class="pt-4" x-ref="text">Hello 👋</div>
    </div>
</div>
<!-- END_VERBATIM -->
```



# x-cloak

<!-- Sometimes, when you're using AlpineJS for a part of your template, there is a "blip" where you might see your uninitialized template after the page loads, but before Alpine loads. -->

<!-- `x-cloak` addresses this scenario by hiding the element it's attached to until Alpine is fully loaded on the page. -->

<!-- For `x-cloak` to work however, you must add the following CSS to the page. -->

テンプレートの一部に Alpine を使用している場合、ページが読み込まれた後、Alpine が読み込まれる前に、初期化されていないテンプレートが表示される「blip ( ブリップ )」が発生することがあります。

`x-cloak` は、Alpine がページに完全に読み込まれるまで `x-cloak` が記載されている要素を非表示にすることで、この現象に対処します。

ただし、 `x-cloak` を機能させるには、次のCSSをページに追加する必要があります。

```css
[x-cloak] { display: none !important; }
```

<!-- Now, the following example will hide the `<span>` tag until Alpine has set its text content to the `message` property. -->

以下の例では、Alpine が `message` プロパティへのテキストがセット完了するまで、`s-cloak` を指定した `<span>` タグが表示されません。

```html
<span x-cloak x-text="message"></span>
```

<!-- When Alpine loads on the page, it removes all `x-cloak` property from the element, which also removes the `display: none;` applied by CSS, therefore showing the element. -->

<!-- If you'd like to achieve this same behavior, but avoid having to include a global style, you can use the following cool, but admittedly odd trick: -->

Alpineがページに読み込まれると、要素からすべての `x-cloak`プロパティが削除されます。これにより、CSSによって適用された ` display:none;` も削除されるため、要素が表示されます。

これと同じ動作を実現したいが、グローバルスタイルを含める必要がない場合は、次のクールな、しかし確かに奇妙なトリックを使用できます。

```html
<template x-if="true">
    <span x-text="message"></span>
</template>
```

<!-- This will achieve the same goal as `x-cloak` by just leveraging the way `x-if` works. -->

<!-- Because `<template>` elements are "hidden" in browsers by default, you won't see the `<span>` until Alpine has had a chance to render the `x-if="true"` and show it. -->

<!-- Again, this solution is not for everyone, but it's worth mentioning for special cases. -->

これは、`x-if` の動作方法を利用するだけで、`x-cloak` と同じ動作を再現しています。

`<template>` 要素はデフォルトでブラウザに「hidden (非表示)」になっているため、Alpineが `x-if="true"` をレンダリングして表示する機会が得られるまで、`<span>` は表示されません。

繰り返しになりますが、このソリューションはすべての人に適しているわけではありませんが、特別な場合には言及する価値があります。


# x-teleport

<!-- The `x-teleport` directive allows you to transport part of your Alpine template to another part of the DOM on the page entirely. -->

<!-- This is useful for things like modals (especially nesting them), where it's helpful to break out of the z-index of the current Alpine component. -->

<!-- > Warning: if you are a [Livewire](https://laravel-livewire.com) user, this functionality does not currently work inside Livewire components. Support for this is on the roadmap. -->

`x-teleport` ディレクティブを使用すると、Alpine テンプレートの一部をページ上の DOM の別の部分に完全に転送できます。

これは、モーダル（特にそれらをネストする）のようなものに役立ちます。ここでは、現在のアルパインコンポーネントの z-index から抜け出すのに役立ちます。

> 警告：[Livewire](https://laravel-livewire.com) ユーザーの場合、この機能は現在 Livewire コンポーネント内では機能しません。 これに対するサポートはロードマップにあります。

<a name="x-teleport"></a>

## x-teleport

<!-- By attaching `x-teleport` to a `<template>` element, you are telling Alpine to "append" that element to the provided selector. -->

<!-- > The `x-teleport` selector can be any string you would normally pass into something like `document.querySelector`. It will find the first element that matches, be it a tag name (`body`), class name (`.my-class`), ID (`#my-id`), or any other valid CSS selector. -->

[→ Read more about `document.querySelector`](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector)

Here's a contrived modal example:

`x-teleport` を `<template>` 要素にアタッチすることにより、Alpine にその要素を提供されたセレクターに「追加」するように指示します。

> `x-teleport`セレクターは、通常 `document.querySelector` のようなものに渡す任意の文字列にすることができます。 タグ名 (`body`)、クラス名(`.my-class`)、ID (`#my-id`)、その他の有効な CSS セレクターなど、一致する最初の要素が検索されます。

[→`document.querySelector`についてもっと読む](https://developer.mozilla.org/en-US/docs/Web/API/Document/querySelector)

考案されたモーダルの例を次に示します。

```html
<body>
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle Modal</button>

        <template x-teleport="body">
            <div x-show="open">
                Modal contents...
            </div>
        </template>
    </div>

    <div>Some other content placed AFTER the modal markup.</div>

    ...

</body>
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-ref="root" id="modal2">
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle Modal</button>

        <template x-teleport="#modal2">
            <div x-show="open">
                Modal contents...
            </div>
        </template>

    </div>

    <div class="py-4">Some other content placed AFTER the modal markup.</div>
</div>
<!-- END_VERBATIM -->
```

<!-- Notice how when toggling the modal, the actual modal contents show up AFTER the "Some other content..." element? This is because when Alpine is initializing, it sees `x-teleport="body"` and appends and initializes that element to the provided element selector. -->

モーダルを切り替えると、実際のモーダルコンテンツが「 Some other content... 」要素の後にどのように表示されるかに注意してください。 これは、Alpineが初期化するときに、`x-teleport ="body"` を認識し、その要素を提供された要素セレクターに追加して初期化するためです。

<a name="forwarding-events"></a>

## イベントの転送

<!-- Alpine tries its best to make the experience of teleporting seamless. Anything you would normally do in a template, you should be able to do inside an `x-teleport` template. Teleported content can access the normal Alpine scope of the component as well as other features like `$refs`, `$root`, etc... -->

<!-- However, native DOM events have no concept of teleportation, so if, for example, you trigger a "click" event from inside a teleported element, that event will bubble up the DOM tree as it normally would. -->

<!-- To make this experience more seamless, you can "forward" events by simply registering event listeners on the `<template x-teleport...>` element itself like so: -->

Alpine はテレポートの体験をシームレスにするために最善を尽くしています。 テンプレートで通常行うことはすべて、`x-teleport` テンプレート内で実行できるはずです。 テレポートされたコンテンツは、コンポーネントの通常の Alpine スコープだけでなく、 `$refs`、`$root`などの他の機能にもアクセスできます。

ただし、ネイティブ DOM イベントにはテレポートの概念がないため、たとえば、テレポートされた要素の内部から「クリック」イベントをトリガーすると、そのイベントは通常どおり DOM ツリーをバブルアップします。

このエクスペリエンスをよりシームレスにするために、次のように `<templatex-teleport...>` 要素自体にイベントリスナーを登録するだけでイベントを「転送」できます。

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle Modal</button>

    <template x-teleport="body" @click="open = false">
        <div x-show="open">
            Modal contents...
            (click to close)
        </div>
    </template>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-ref="root" id="modal3">
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle Modal</button>

        <template x-teleport="#modal3" @click="open = false">
            <div x-show="open">
                Modal contents...
                <div>(click to close)</div>
            </div>
        </template>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Notice how we are now able to listen for events dispatched from within the teleported element from outside the `<template>` element itself? -->

<!-- Alpine does this by looking for event listeners registered on `<template x-teleport...>` and stops those events from propagating past the live, teleported, DOM element. Then, it creates a copy of that event and re-dispatches it from `<template x-teleport...>`. -->

テレポートされた要素の内部から `<template>` 要素自体の外部からディスパッチされたイベントをどのようにリッスンできるかに注目してください。

Alpineは、`<template x-teleport ...>` に登録されているイベントリスナーを探すことでこれを行い、それらのイベントがライブのテレポートされたDOM要素を超えて伝播するのを防ぎます。 次に、そのイベントのコピーを作成し、 `<templatex-teleport...>` から再ディスパッチします。

<a name="nesting"></a>

## Nesting

<!-- Teleporting is especially helpful if you are trying to nest one modal within another. Alpine makes it simple to do so: -->

テレポートは、あるモーダルを別のモーダル内にネストしようとしている場合に特に役立ちます。

```html
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle Modal</button>

    <template x-teleport="body">
        <div x-show="open">
            Modal contents...
            
            <div x-data="{ open: false }">
                <button @click="open = ! open">Toggle Nested Modal</button>

                <template x-teleport="body">
                    <div x-show="open">
                        Nested modal contents...
                    </div>
                </template>
            </div>
        </div>
    </template>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-ref="root" id="modal4">
    <div x-data="{ open: false }">
        <button @click="open = ! open">Toggle Modal</button>

        <template x-teleport="#modal4">
            <div x-show="open">
                <div class="py-4">Modal contents...</div>
                
                <div x-data="{ open: false }">
                    <button @click="open = ! open">Toggle Nested Modal</button>

                    <template x-teleport="#modal4">
                        <div class="pt-4" x-show="open">
                            Nested modal contents...
                        </div>
                    </template>
                </div>
            </div>
        </template>
    </div>

    <template x-teleport-target="modals3"></template>
</div>
<!-- END_VERBATIM -->
```

<!-- After toggling "on" both modals, they are authored as children, but will be rendered as sibling elements on the page, not within one another. -->

両方のモーダルを「オン」に切り替えた後、それらは子として作成されますが、ページ上で兄弟要素としてレンダリングされ、相互にレンダリングされません。




# x-if

<!-- `x-if` is used for toggling elements on the page, similarly to `x-show`, however it completely adds and removes the element it's applied to rather than just changing its CSS display property to "none". -->

<!-- Because of this difference in behavior, `x-if` should not be applied directly to the element, but instead to a `<template>` tag that encloses the element. This way, Alpine can keep a record of the element once it's removed from the page. -->

`x-if` は、`x-show` と同様に、ページ上の要素を切り替えるために使用されますが、CSS 表示プロパティを「none」に変更するだけでなく、適用される要素を完全に追加および削除します。

この動作の違いのため、`x-if` は要素に直接適用するのではなく、要素を囲む `<template>` タグに適用する必要があります。 このようにして、Alpine は、ページから削除された要素の記録を保持できます。

```html
<template x-if="open">
    <div>Contents...</div>
</template>
```

<!-- > Unlike `x-show`, `x-if`, does NOT support transitioning toggles with `x-transition`. -->

<!-- > Remember: `<template>` tags can only contain one root level element. -->

> `x-show`とは異なり、`x-if` は `x-transition` によるトグルの遷移をサポートしていません。

> 注意： `<template>` タグには、ルートレベルの要素を1つだけ含めることができます。


# x-id

<!-- `x-id` allows you to declare a new "scope" for any new IDs generated using `$id()`. It accepts an array of strings (ID names) and adds a suffix to each `$id('...')` generated within it that is unique to other IDs on the page. -->

<!-- `x-id` is meant to be used in conjunction with the `$id(...)` magic. -->

<!-- [Visit the $id documentation](/magics/id) for a better understanding of this feature. -->

<!-- Here's a brief example of this directive in use: -->

`x-id` を使用すると、`$id()` を使用して生成された新しい ID の新しい「スコープ」を宣言できます。 文字列（ID名）の配列を受け入れ、その中で生成された各 `$ id('...')`に、ページ上の他の ID に固有の接尾辞を追加します。

`x-id` は、`$id(...)`マジックと組み合わせて使用することを目的としています。

この機能の理解を深めるには、[$id のドキュメントにアクセスしてください](/magics/id)。

使用中のこのディレクティブの簡単な例を次に示します。

```html
<div x-id="['text-input']">
    <label :for="$id('text-input')">Username</label>
    <!-- for="text-input-1" -->

    <input type="text" :id="$id('text-input')">
    <!-- id="text-input-1" -->
</div>

<div x-id="['text-input']">
    <label :for="$id('text-input')">Username</label>
    <!-- for="text-input-2" -->

    <input type="text" :id="$id('text-input')">
    <!-- id="text-input-2" -->
</div>
```





# $el

<!-- `$el` is a magic property that can be used to retrieve the current DOM node. -->

`$el` は、現在の DOM ノードを取得するために使用できる魔法のプロパティです。

```html
<button @click="$el.innerHTML = 'Hello World!'">Replace me with "Hello World!"</button>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data>
        <button @click="$el.textContent = 'Hello World!'">Replace me with "Hello World!"</button>
    </div>
</div>
<!-- END_VERBATIM -->
```


# $refs

`$ refs` は、コンポーネント内で `x-ref` でマークされた DOM 要素を取得するために使用できる魔法のプロパティです。 これは、DOM要素を手動で操作する必要がある場合に役立ちます。 これは、`document.querySelector` の代わりに、より簡潔でスコープが設定されたものとしてよく使用されます。

<!-- `$refs` is a magic property that can be used to retrieve DOM elements marked with `x-ref` inside the component. This is useful when you need to manually manipulate DOM elements. It's often used as a more succinct, scoped, alternative to `document.querySelector`. -->

```html
<button @click="$refs.text.remove()">Remove Text</button>

<span x-ref="text">Hello 👋</span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data>
        <button @click="$refs.text.remove()">Remove Text</button>

        <div class="pt-4" x-ref="text">Hello 👋</div>
    </div>
</div>
<!-- END_VERBATIM -->
```

これで、`<button>` を押すと、`<span>` が削除されます。

<!-- Now, when the `<button>` is pressed, the `<span>` will be removed. -->



# $store

`$store` を使用すると、[`Alpine.store(...)`](/globals/alpine-store) を使用して登録されたグローバル Alpine ストアに簡単にアクセスできます。例えば

<!-- You can use `$store` to conveniently access global Alpine stores registered using [`Alpine.store(...)`](/globals/alpine-store). For example: -->

```html
<button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>

...

<div x-data :class="$store.darkMode.on && 'bg-black'">
    ...
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', {
            on: false,

            toggle() {
                this.on = ! this.on
            }
        })
    })
</script>
```

<!-- Given that we've registered the `darkMode` store and set `on` to "false", when the `<button>` is pressed, `on` will be "true" and the background color of the page will change to black. -->

「darkMode」ストアを登録し、「on」を「false」に設定した場合、`<button>` を押すと、「on」が「true」になり、ページの背景色が黒に変わります。 。


<a name="single-value-stores"></a>

## 単一値ストア

ストアにオブジェクト全体が必要ない場合は、あらゆる種類のデータをストアとして設定して使用できます。

上記の例を次に示しますが、ブール値としてより単純に使用しています。

<!-- If you don't need an entire object for a store, you can set and use any kind of data as a store. -->

<!-- Here's the example from above but using it more simply as a boolean value: -->

```html
<button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button>

...

<div x-data :class="$store.darkMode && 'bg-black'">
    ...
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', false)
    })
</script>
```

[→ Alpine ストアについてもっと読む](/globals/alpine-store)



# $watch

<!-- You can "watch" a component property using the `$watch` magic method. For example: -->

`$watch` マジックメソッドを使用して、コンポーネントプロパティを「watch (監視)」できます。例えば

```html
<div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">
    <button @click="open = ! open">Toggle Open</button>
</div>
```

<!-- In the above example, when the button is pressed and `open` is changed, the provided callback will fire and `console.log` the new value: -->

<!-- You can watch deeply nested properties using "dot" notation -->

上記の例では、ボタンが押されて `open` が変更されると、提供されたコールバックが起動し、`console.log` に新しい値が表示されます。

「ドット」表記を使用して、深くネストされたプロパティを監視できます

```html
<div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo.bar', value => console.log(value))">
    <button @click="foo.bar = 'bob'">Toggle Open</button>
</div>
```

<!-- When the `<button>` is pressed, `foo.bar` will be set to "bob", and "bob" will be logged to the console. -->

`<button>` を押すと、`foo.bar` が `bob` に設定され、`bob` がコンソールに記録されます。

<a name="getting-the-old-value"></a>

### 古い値を取得する

`$watch` は、監視されているプロパティの以前の値を追跡します。次のように、コールバックへのオプションの2番目の引数を使用してアクセスできます。

<!-- `$watch` keeps track of the previous value of the property being watched, You can access it using the optional second argument to the callback like so: -->

```html
<div x-data="{ open: false }" x-init="$watch('open', (value, oldValue) => console.log(value, oldValue))">
    <button @click="open = ! open">Toggle Open</button>
</div>
```

<a name="deep-watching"></a>

### ディープウォッチング

`$watch` は任意のレベルの変更を自動的に監視しますが、変更が検出されると、ウォッチャーは変更されたサブプロパティの値ではなく、監視されたプロパティの値を返すことに注意してください。

<!-- `$watch` will automatically watches from changes at any level but you should keep in mind that, when a change is detected, the watcher will return the value of the observed property, not the value of the subproperty that has changed. -->

```html
<div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo', (value, oldValue) => console.log(value, oldValue))">
    <button @click="foo.bar = 'bob'">Update</button>
</div>
```

<!-- When the `<button>` is pressed, `foo.bar` will be set to "bob", and "{bar: 'bob'} {bar: 'baz'}" will be logged to the console (new and old value). -->

<!-- > ⚠️ Changing a property of a "watched" object as a side effect of the `$watch` callback will generate an infinite loop and eventually error.  -->

`<button>` を押すと、`foo.bar` が `bob` に設定され、"{bar: 'bob'} {bar: 'baz'}" がコンソールに記録されます（新旧の値）。

> ⚠️`$watch` コールバックの副作用として`watched` オブジェクトのプロパティを変更すると、無限ループが発生し、最終的にエラーが発生します。

```html
<!-- 🚫 Infinite loop -->
<div x-data="{ foo: { bar: 'baz', bob: 'lob' }}" x-init="$watch('foo', value => foo.bob = foo.bar)">
    <button @click="foo.bar = 'bob'">Update</button>
</div>
```



# $dispatch

<!-- `$dispatch` is a helpful shortcut for dispatching browser events. -->

`$dispatch` は、ブラウザイベントをディスパッチするための便利なショートカットです。

```html
<div @notify="alert('Hello World!')">
    <button @click="$dispatch('notify')">
        Notify
    </button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data @notify="alert('Hello World!')">
        <button @click="$dispatch('notify')">
            Notify
        </button>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- You can also pass data along with the dispatched event if you wish. This data will be accessible as the `.detail` property of the event: -->

必要に応じて、ディスパッチされたイベントと一緒にデータを渡すこともできます。 このデータには、イベントの `.detail` プロパティとしてアクセスできます。

```html
<div @notify="alert($event.detail.message)">
    <button @click="$dispatch('notify', { message: 'Hello World!' })">
        Notify
    </button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data @notify="alert($event.detail.message)">
        <button @click="$dispatch('notify', { message: 'Hello World!' })">Notify</button>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Under the hood, `$dispatch` is a wrapper for the more verbose API: `element.dispatchEvent(new CustomEvent(...))` -->

内部的には、`$dispatch` はより詳細な API のラッパーです：`element.dispatchEvent(new CustomEvent(...))`

<!-- **Note on event propagation** -->

**イベントの伝播に関する注意**

<!-- Notice that, because of [event bubbling](https://en.wikipedia.org/wiki/Event_bubbling), when you need to capture events dispatched from nodes that are under the same nesting hierarchy, you'll need to use the [`.window`](https://github.com/alpinejs/alpine#x-on) modifier: -->

[イベントバブリング](https://en.wikipedia.org/wiki/Event_bubbling) のため、同じネスト階層の下にあるノードからディスパッチされたイベントをキャプチャする必要がある場合は、[`.window`](https://github.com/alpinejs/alpine#x-on) 修飾子：

**例 :**

```html
<!-- 🚫 Won't work -->
<div x-data>
    <span @notify="..."></span>
    <button @click="$dispatch('notify')">Notify</button>
</div>

<!-- ✅ Will work (because of .window) -->
<div x-data>
    <span @notify.window="..."></span>
    <button @click="$dispatch('notify')">Notify</button>
</div>
```

<!-- > The first example won't work because when `custom-event` is dispatched, it'll propagate to its common ancestor, the `div`, not its sibling, the `<span>`. The second example will work because the sibling is listening for `notify` at the `window` level, which the custom event will eventually bubble up to. -->

> 最初の例は機能しません。これは、 `custom-event` がディスパッチされると、その兄弟である `<span>` ではなく共通の祖先である `div` に伝播するためです。 2番目の例は、兄弟が `window` レベルで `notify` をリッスンしているために機能します。これは、カスタムイベントが最終的にバブルアップします。

<a name="dispatching-to-components"></a>

## 他のコンポーネントへのディスパッチ

<!-- You can also take advantage of the previous technique to make your components talk to each other: -->

前の手法を利用して、コンポーネントを相互に通信させることもできます。

**例 :**

```html
<div
    x-data="{ title: 'Hello' }"
    @set-title.window="title = $event.detail"
>
    <h1 x-text="title"></h1>
</div>

<div x-data>
    <button @click="$dispatch('set-title', 'Hello World!')">Click me</button>
</div>
<!-- When clicked, the content of the h1 will set to "Hello World!". -->
```

<a name="dispatching-to-x-model"></a>

## x-model へのディスパッチ

<!-- You can also use `$dispatch()` to trigger data updates for `x-model` data bindings. For example: -->

`$dispatch()` を使用して、`x-model` データバインディングのデータ更新をトリガーすることもできます。例えば：

```html
<div x-data="{ title: 'Hello' }">
    <span x-model="title">
        <button @click="$dispatch('input', 'Hello World!')">Click me</button>
        <!-- After the button is pressed, `x-model` will catch the bubbling "input" event, and update title. -->
    </span>
</div>
```

<!-- This opens up the door for making custom input components whose value can be set via `x-model`. -->

これにより、`x-model` を介して値を設定できるカスタム入力コンポーネントを作成することができます。


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

<!-- In the above example, rather than logging "Hello" to the console, "Hello World!" will be logged because `$nextTick` was used to wait until Alpine was finished updating the DOM. -->

上記の例では 「Hello」をコンソールに記録するのではなく 「HelloWorld！」 Alpine がDOM の更新を完了するまで待機するために`$nextTick` が使用されたため、ログに記録されます。

<a name="promises"></a>

## Promises

`$nextTick` はpromiseを返し、`$nextTick` を使用して DOM の更新が保留されるまで非同期関数を一時停止できるようにします。このように使用する場合、`$nextTick` も引数を渡す必要はありません。

<!-- `$nextTick` returns a promise, allowing the use of `$nextTick` to pause an async function until after pending dom updates. When used like this, `$nextTick` also does not require an argument to be passed. -->

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



# $root

`$root`は、任意の Alpine コンポーネントのルート要素を取得するために使用できる魔法のプロパティです。 言い換えると `x-data` を含む DOM ツリーの最も近い要素です。

<!-- `$root` is a magic property that can be used to retrieve the root element of any Alpine component. In other words the closest element up the DOM tree that contains `x-data`. -->

```html
<div x-data data-message="Hello World!">
    <button @click="alert($root.dataset.message)">Say Hi</button>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data data-message="Hello World!" class="demo">
    <button @click="alert($root.dataset.message)">Say Hi</button>
</div>
<!-- END_VERBATIM -->
```


# $data

<!-- `$data` is a magic property that gives you access to the current Alpine data scope (generally provided by `x-data`). -->

<!-- Most of the time, you can just access Alpine data within expressions directly. for example `x-data="{ message: 'Hello Caleb!' }"` will allow you to do things like `x-text="message"`. -->

<!-- However, sometimes it is helpful to have an actual object that encapsulates all scope that you can pass around to other functions: -->

`$data` は、現在の Alpine データスコープ（通常は ` x-data` によって提供されます）へのアクセスを提供する魔法のプロパティです。

ほとんどの場合、式内の Alpine のデータに直接アクセスできます。 たとえば、`x-data ="{message: 'Hello Caleb！'}"` を使用すると、`x-text="message"` のようなことができます。

ただし、他の関数に渡すことができるすべてのスコープをカプセル化する実際のオブジェクトがあると便利な場合があります。

```html
<div x-data="{ greeting: 'Hello' }">
    <div x-data="{ name: 'Caleb' }">
        <button @click="sayHello($data)">Say Hello</button>
    </div>
</div>

<script>
    function sayHello({ greeting, name }) {
        alert(greeting + ' ' + name + '!')
    }
</script>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ greeting: 'Hello' }" class="demo">
    <div x-data="{ name: 'Caleb' }">
        <button @click="sayHello($data)">Say Hello</button>
    </div>
</div>

<script>
    function sayHello({ greeting, name }) {
        alert(greeting + ' ' + name + '!')
    }
</script>
<!-- END_VERBATIM -->
```

<!-- Now when the button is pressed, the browser will alert `Hello Caleb!` because it was passed a data object that contained all the Alpine scope of the expression that called it (`@click="..."`). -->

<!-- Most applications won't need this magic property, but it can be very helpful for deeper, more complicated Alpine utilities. -->

これで、ボタンが押されると、ブラウザは `Hello Caleb！` を警告します。これは、ボタンを呼び出した式（ `@click = "..."`）のすべての Alpine スコープを含むデータオブジェクトが渡されたためです。

ほとんどのアプリケーションはこの魔法の特性を必要としませんが、より深く、より複雑な Alpine ユーティリティには非常に役立ちます。



# $id

`$id` は、要素の ID を生成し、同じページ上の同じ名前の他の ID と競合しないようにするために使用できる魔法のプロパティです。

<!-- `$id` is a magic property that can be used to generate an element's ID and ensure that it won't conflict with other IDs of the same name on the same page. -->

このユーティリティは、ページ上で複数回発生する可能性のある再利用可能なコンポーネント（おそらくバックエンドテンプレート内）を構築し、ID 属性を利用する場合に非常に役立ちます。

<!-- This utility is extremely helpful when building re-usable components (presumably in a back-end template) that might occur multiple times on a page, and make use of ID attributes. -->

入力コンポーネント、モーダル、リストボックスなどはすべて、このユーティリティの恩恵を受けます。

<!-- Things like input components, modals, listboxes, etc. will all benefit from this utility. -->

<a name="basic-usage"></a>

## 基本的な使用法

ページに2つの入力要素があり、それらに相互に一意の ID を持たせたい場合は、次のように実行できます。

<!-- Suppose you have two input elements on a page, and you want them to have a unique ID from each other, you can do the following: -->

```html
<input type="text" :id="$id('text-input')">
<!-- id="text-input-1" -->

<input type="text" :id="$id('text-input')">
<!-- id="text-input-2" -->
```

<!-- As you can see, `$id` takes in a string and spits out an appended suffix that is unique on the page. -->

ご覧のとおり、`$id` は文字列を受け取り、ページ上で一意の追加されたサフィックスを吐き出します。

<a name="groups-with-x-id"></a>

## x-id によるグループ化

ここで、同じ2つの入力要素が必要であるが、今回はそれぞれに `<label>` 要素が必要であるとします。

これには問題があります。同じIDを2回参照できるようにする必要があります。 1つは `<label>` の `for` 属性用で、もう1つは入力の `id` 用です。

<!-- Now let's say you want to have those same two input elements, but this time you want `<label>` elements for each of them. -->

<!-- This presents a problem, you now need to be able to reference the same ID twice. One for the `<label>`'s `for` attribute, and the other for the `id` on the input. -->

<!-- Here is a way that you might think to accomplish this and is totally valid: -->

これを達成するためにあなたが考えるかもしれない方法はここにあり、完全に有効です

```html
<div x-data="{ id: $id('text-input') }">
    <label :for="id"> <!-- "text-input-1" -->
    <input type="text" :id="id"> <!-- "text-input-1" -->
</div>

<div x-data="{ id: $id('text-input') }">
    <label :for="id"> <!-- "text-input-2" -->
    <input type="text" :id="id"> <!-- "text-input-2" -->
</div>
```

<!-- This approach is fine, however, having to name and store the ID in your component scope feels cumbersome. -->

<!-- To accomplish this same task in a more flexible way, you can use Alpine's `x-id` directive to declare an "id scope" for a set of IDs: -->

このアプローチは問題ありませんが、ID に名前を付けてコンポーネントスコープに格納するのは面倒です。

これと同じタスクをより柔軟な方法で実行するために、Alpine の `x-id` ディレクティブを使用して、一連の ID の「 id スコープ 」を宣言できます。

```html
<div x-id="['text-input']">
    <label :for="$id('text-input')"> <!-- "text-input-1" -->
    <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->
</div>

<div x-id="['text-input']">
    <label :for="$id('text-input')"> <!-- "text-input-2" -->
    <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->
</div>
```

As you can see, `x-id` accepts an array of ID names. Now any usages of `$id()` within that scope, will all use the same ID. Think of them as "id groups".

ご覧のとおり、`x-id` は ID 名の配列を受け入れます。これで、そのスコープ内での `$id()` の使用は、すべて同じ ID を使用します。それらを「 id グループ」と考えてください。

<a name="nesting"></a>

## ネスト

直感的に理解できたかもしれませんが、次のように、これらの `x-id` グループを自由にネストできます。

<!-- As you might have intuited, you can freely nest these `x-id` groups, like so: -->

```html
<div x-id="['text-input']">
    <label :for="$id('text-input')"> <!-- "text-input-1" -->
    <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->

    <div x-id="['text-input']">
        <label :for="$id('text-input')"> <!-- "text-input-2" -->
        <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->
    </div>
</div>
```

<a name="keyed-ids"></a>

## キー付きID（ループ用）

ループ内で ID を識別するために、ID の末尾に追加のサフィックスを指定すると便利な場合があります。

このため、`$id()` は、生成された ID の最後にサフィックスとして追加されるオプションの2番目のパラメーターを受け入れます。

この必要性の一般的な例は、`aria-activedescendant` 属性を使用して、リスト内のどの要素が「アクティブ」であるかを支援技術に伝えるリストボックスコンポーネントのようなものです。

<!-- Sometimes, it is helpful to specify an additional suffix on the end of an ID for the purpose of identifying it within a loop. -->

<!-- For this, `$id()` accepts an optional second parameter that will be added as a suffix on the end of the generated ID. -->

<!-- A common example of this need is something like a listbox component that uses t
he `aria-activedescendant` attribute to tell 
assistive technologies which element is "active" in the list: -->

```html
<ul
    x-id="['list-item']"
    :aria-activedescendant="$id('list-item', activeItem.id)"
>
    <template x-for="item in items" :key="item.id">
        <li :id="$id('list-item', item.id)">...</li>
    </template>
</ul>
```

<!-- This is an incomplete example of a listbox, but it should still be helpful to demonstrate a scenario where you might need each ID in a group to still be unique to the page, but also be keyed within a loop so that you can reference individual IDs within that group. -->

これはリストボックスの不完全な例ですが、グループ内の各 ID がページに固有であるだけでなく、個々の ID を参照できるようにループ内でキー設定される必要があるシナリオを示すのに役立つはずです。そのグループ内。



# Alpine.data

<!-- `Alpine.data(...)` provides a way to re-use `x-data` contexts within your application. -->

<!-- Here's a contrived `dropdown` component for example: -->

`Alpine.data(...)` は、アプリケーション内で `x-data` コンテキストを再利用する方法を提供します。

たとえば、考案された「ドロップダウン」コンポーネントを次に示します。

```html
<div x-data="dropdown">
    <button @click="toggle">...</button>

    <div x-show="open">...</div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,

            toggle() {
                this.open = ! this.open
            }
        }))
    })
</script>
```

<!-- As you can see we've extracted the properties and methods we would usually define directly inside `x-data` into a separate Alpine component object. -->

ご覧のとおり、通常は `x-data` 内で直接定義するプロパティとメソッドを別の Alpine コンポーネントオブジェクトに抽出しました。

<a name="registering-from-a-bundle"></a>

## バンドルからの登録

Alpine コードのビルドステップを使用することを選択した場合は、次の方法でコンポーネントを登録する必要があります。

<!-- If you've chosen to use a build step for your Alpine code, you should register your components in the following way: -->

```js
import Alpine from `alpinejs`
import dropdown from './dropdown.js'

Alpine.data('dropdown', dropdown)

Alpine.start()
```

<!-- This assumes you have a file called `dropdown.js` with the following contents: -->

これは、次の内容の `dropdown.js` というファイルがあることを前提としています。

```js
export default () => ({
    open: false,

    toggle() {
        this.open = ! this.open
    }
})
```

<a name="initial-parameters"></a>

## 初期パラメータ

`Alpine.data` プロバイダーを名前でわかりやすく参照する（`x-data = "dropdown"`など）だけでなく、関数として参照することもできます（`x-data = "dropdown()"`）。それらを関数として直接呼び出すことにより、次のように初期データオブジェクトを作成するときに使用される追加のパラメーターを渡すことができます。

<!-- In addition to referencing `Alpine.data` providers by their name plainly (like `x-data="dropdown"`), you can also reference them as functions (`x-data="dropdown()"`). By calling them as functions directly, you can pass in additional parameters to be used when creating the initial data object like so: -->

```html
<div x-data="dropdown(true)">
```
```js
Alpine.data('dropdown', (initialOpenState = false) => ({
    open: initialOpenState
}))
```

<!-- Now, you can re-use the `dropdown` object, but provide it with different parameters as you need to. -->

これで、`dropdown` オブジェクトを再利用できますが、必要に応じてさまざまなパラメータを指定できます。

<a name="init-functions"></a>

## 初期化関数

コンポーネントに `init()` メソッドが含まれている場合、Alpine はコンポーネントをレンダリングする前に自動的にそれを実行します。例えば：

<!-- If your component contains an `init()` method, Alpine will automatically execute it before it renders the component. For example: -->

```js
Alpine.data('dropdown', () => ({
    init() {
        // This code will be executed before Alpine
        // initializes the rest of the component.
    }
}))
```

<a name="using-magic-properties"></a>

## マジックプロパティを使用する

コンポーネントオブジェクトからマジックメソッドまたはプロパティにアクセスする場合は、`this` コンテキストを使用してアクセスできます。

<!-- If you want to access magic methods or properties from a component object, you can do so using the `this` context: -->

```js
Alpine.data('dropdown', () => ({
    open: false,

    init() {
        this.$watch('open', () => {...})
    }
}))
```

<a name="encapsulating-directives-with-x-bind"></a>

## `x-bind`を使用したディレクティブのカプセル化

コンポーネントのデータオブジェクト以外のものを再利用したい場合は、`x-bind` を使用して Alpine テンプレートディレクティブ全体をカプセル化できます。

以下は、`x-bind`を使用して前のドロップダウンコンポーネントのテンプレートの詳細を抽出する例です。

<!-- If you wish to re-use more than just the data object of a component, you can encapsulate entire Alpine template directives using `x-bind`. -->

<!-- The following is an example of extracting the templating details of our previous dropdown component using `x-bind`: -->

```html
<div x-data="dropdown">
    <button x-bind="trigger"></button>

    <div x-bind="dialogue"></div>
</div>
```

```js
Alpine.data('dropdown', () => ({
    open: false,

    trigger: {
        ['@click']() {
            this.open = ! this.open
        },
    },

    dialogue: {
        ['x-show']() {
            return this.open
        },
    },
}))
```



# Alpine.store

<!-- Alpine offers global state management through the `Alpine.store()` API. -->

Alpine は、`Alpine.store()` API を介してグローバルな状態管理を提供します。

<a name="registering-a-store"></a>

## ストアの登録

`alpine:init` リスナー内に Alpine ストアを定義するか（`<script>` タグを介して Alpine を含める場合）、手動で `Alpine.start()` を呼び出す前に定義することができます（ Alpine をビルドにインポートする場合）

<!-- You can either define an Alpine store inside of an `alpine:init` listener (in the case of including Alpine via a `<script>` tag), OR you can define it before manually calling `Alpine.start()` (in the case of importing Alpine into a build): -->

**<script>タグから**
```html
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', {
            on: false,

            toggle() {
                this.on = ! this.on
            }
        })
    })
</script>
```

**バンドルから**
```js
import Alpine from 'alpinejs'

Alpine.store('darkMode', {
    on: false,

    toggle() {
        this.on = ! this.on
    }
})

Alpine.start()
```

<a name="accessing stores"></a>

## 店舗へのアクセス

`$store` マジックプロパティを使用して、Alpine 式内の任意のストアからデータにアクセスできます。

<!-- You can access data from any store within Alpine expressions using the `$store` magic property: -->

```html
<div x-data :class="$store.darkMode.on && 'bg-black'">...</div>
```

<!-- You can also modify properties within the store and everything that depends on those properties will automatically react. For example: -->

ストア内のプロパティを変更することもでき、それらのプロパティに依存するすべてのものが自動的に反応します。例えば

```html
<button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>
```

<!-- Additionally, you can access a store externally using `Alpine.store()` by omitting the second parameter like so: -->

さらに、次のように2番目のパラメータを省略することで、`Alpine.store()` を使用して外部からストアにアクセスできます。

```html
<script>
    Alpine.store('darkMode').toggle()
</script>
```

<a name="initializing-stores"></a>

## ストアの初期化

Alpine ストアで `init()` メソッドを指定すると、ストアが登録された直後に実行されます。これは、適切な開始値を使用してストア内の状態を初期化する場合に役立ちます。

<!-- If you provide `init()` method in an Alpine store, it will be executed right after the store is registered. This is useful for initializing any state inside the store with sensible starting values. -->

```html
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', {
            init() {
                this.on = window.matchMedia('(prefers-color-scheme: dark)').matches
            },

            on: false,

            toggle() {
                this.on = ! this.on
            }
        })
    })
</script>
```

<!-- Notice the newly added `init()` method in the example above. With this addition, the `on` store variable will be set to the browser's color scheme preference before Alpine renders anything on the page. -->

上記の例で新しく追加された `init()` メソッドに注目してください。この追加により、Alpine がページ上に何かをレンダリングする前に、`on` ストア変数がブラウザの配色設定に設定されます。

<a name="single-value-stores"></a>

## 単一値ストア

ストアにオブジェクト全体が必要ない場合は、あらゆる種類のデータをストアとして設定して使用できます。

上記の例を次に示しますが、ブール値としてより単純に使用しています。

<!-- If you don't need an entire object for a store, you can set and use any kind of data as a store. -->

<!-- Here's the example from above but using it more simply as a boolean value: -->

```html
<button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button>

...

<div x-data :class="$store.darkMode && 'bg-black'">
    ...
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', false)
    })
</script>
```



# Alpine.bind

<!-- `Alpine.bind(...)` provides a way to re-use [`x-bind`](/directives/bind#bind-directives) objects within your application. -->

<!-- Here's a simple example. Rather than binding attributes manually with Alpine: -->

`Alpine.bind(...)`は、アプリケーション内で [`x-bind`](/directives/bind#bind-directives)  オブジェクトを再利用する方法を提供します。

これが簡単な例です。 Alpine で属性を手動でバインドするのではなく：

```html
<button type="button" @click="doSomething()" :disabled="shouldDisable"></button>
```

<!-- You can bundle these attributes up into a reusable object and use `x-bind` to bind to that: -->

これらの属性を再利用可能なオブジェクトにバンドルし、`x-bind` を使用してそれにバインドできます。

```html
<button x-bind="SomeButton"></button>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.bind('SomeButton', () => ({
            type: 'button',

            '@click'() {
                this.doSomething()
            },

            ':disabled'() {
                return this.shouldDisable
            },
        }))
    })
</script>
```



# マスクプラグイン (Mask Plugin)

<!-- Alpine's Mask plugin allows you to automatically format a text input field as a user types. -->

<!-- This is useful for many different types of inputs: phone numbers, credit cards, dollar amounts, account numbers, dates, etc. -->

Alpine の Mask プラグインを使用すると、ユーザーの入力に応じてテキスト入力フィールドを自動的にフォーマットできます。

これは、電話番号、クレジットカード、金額、口座番号、日付など、さまざまな種類の入力に役立ちます。

<a name="installation"></a>

## インストール

```html
<div x-data="{ expanded: false }">
    <div class=" relative">
        <div 
            x-show="!expanded" 
            class="absolute inset-0 flex justify-start items-end bg-gradient-to-t from-white to-[#ffffff66]"></div>
        <div 
            x-show="expanded" 
            x-collapse.min.80px 
            class="markdown">
```

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

### CDN 経由

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

次のように、バンドル内で使用するために NPM から Mask をインストールできます。

<!-- You can install Mask from NPM for use inside your bundle like so: -->

```shell
npm install @alpinejs/mask
```

<!-- Then initialize it from your bundle: -->

次に、バンドルから初期化します。

```js
import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'

Alpine.plugin(mask)

...
```

<!-- ```html
        </div>
    </div>
    <button :aria-expanded="expanded" @click="expanded = ! expanded" class="text-cyan-600 font-medium underline">
    <span x-text="expanded ? 'Hide' : 'Show more'">Show</span> <span x-text="expanded ? '↑' : '↓'">↓</span>
    </button>
</div>
 ``` -->

<a name="x-mask"></a>

## x-mask

<!-- The primary API for using this plugin is the `x-mask` directive. -->

<!-- Let's start by looking at the following simple example of a date field: -->

このプラグインを使用するための主要な API は、`x-mask` ディレクティブです。

日付フィールドの次の簡単な例を見てみましょう。

```html
<input x-mask="99/99/9999" placeholder="MM/DD/YYYY">
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <input x-data x-mask="99/99/9999" placeholder="MM/DD/YYYY">
</div>
<!-- END_VERBATIM -->
```

<!-- Notice how the text you type into the input field must adhere to the format provided by `x-mask`. In addition to enforcing numeric characters, the forward slashes `/` are also automatically added if a user doesn't type them first. -->

<!-- The following wildcard characters are supported in masks: -->

入力フィールドに入力するテキストが、`x-mask` によって提供される形式に準拠している必要があることに注意してください。数字を強制することに加えて、ユーザーが最初に数字を入力しない場合、スラッシュ `/` も自動的に追加されます。

次のワイルドカード文字がマスクでサポートされています。

| ワイルドカード                   | 説明                 |
| -------------------------- | --------------------------- |
| `*` | 任意の文字 |
| `a` | 英字のみ (a-z、A-Z) |
| `9` | 数字のみ (0〜9) |

<a name="mask-functions"></a>

## ダイナミックマスク

単純なマスクリテラル（つまり `(999) 999-9999`）では不十分な場合があります。このような場合、`x-mask:dynamic` を使用すると、ユーザー入力に基づいてその場でマスクを動的に生成できます。

これは、番号が「34」または「37」のどちらで始まるかに基づいてマスクを変更する必要があるクレジットカード入力の例です（つまり、Amexカードであるため、形式が異なります）。

<!-- Sometimes simple mask literals (i.e. `(999) 999-9999`) are not sufficient. In these cases, `x-mask:dynamic` allows you to dynamically generate masks on the fly based on user input. -->

<!-- Here's an example of a credit card input that needs to change it's mask based on if the number starts with the numbers "34" or "37" (which means it's an Amex card and therefore has a different format). -->

```html
<input x-mask:dynamic="
    $input.startsWith('34') || $input.startsWith('37')
        ? '9999 999999 99999' : '9999 9999 9999 9999'">
```

<!-- As you can see in the above example, every time a user types in the input, that value is passed to the expression as `$input`. Based on the `$input`, a different mask is utilized in the field. -->

<!-- Try it for yourself by typing a number that starts with "34" and one that doesn't. -->

上記の例でわかるように、ユーザーが入力を入力するたびに、その値は `$input` として式に渡されます。 `$input` に基づいて、フィールドで異なるマスクが使用されます。

「34」で始まる数字とそうでない数字を入力して、自分で試してみてください。

```html
<!-- START_VERBATIM -->
<div class="demo">
    <input x-data x-mask:dynamic="
        $input.startsWith('34') || $input.startsWith('37')
            ? '9999 999999 99999' : '9999 9999 9999 9999'
    ">
</div>
<!-- END_VERBATIM -->
```

<!-- `x-mask:dynamic` also accepts a function as a result of the expression and will automatically pass it the `$input` as the the first paramter. For example: -->

`x-mask:dynamic` は式の結果として関数も受け入れ、最初のパラメーターとして `$input` を自動的に渡します。例えば：

```html
<input x-mask:dynamic="creditCardMask">

<script>
function creditCardMask(input) {
    return input.startsWith('34') || input.startsWith('37')
        ? '9999 999999 99999'
        : '9999 9999 9999 9999'
}
</script>
```

<a name="money-inputs"></a>

## 金額の入力 (Money Inputs)

お金の入力用に独自の動的マスク式を作成するのはかなり複雑なため、Alpineは事前に作成されたものを提供し、`$money()` として利用できるようにします。

これが完全に機能するお金の入力マスクです：

<!-- Because writing your own dynamic mask expression for money inputs is fairly complex, Alpine offers a prebuilt one and makes it available as `$money()`. -->

<!-- Here is a fully functioning money input mask: -->

```html
<input x-mask:dynamic="$money($input)">
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-data>
    <input type="text" x-mask:dynamic="$money($input)" placeholder="0.00">
</div>
<!-- END_VERBATIM -->
```

<!-- If you wish to swap the periods for commas and vice versa (as is required in certain currencies), you can do so using the second optional parameter: -->

ピリオドをコンマに、またはその逆に交換する場合（特定の通貨で必要な場合）、2番目のオプションのパラメーターを使用して行うことができます。

```html
<input x-mask:dynamic="$money($input, ',')">
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-data>
    <input type="text" x-mask:dynamic="$money($input, ',')"  placeholder="0,00">
</div>
<!-- END_VERBATIM -->
```


# Intersect プラグイン

Alpine の Intersect プラグインは、[Intersection Observer](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) の便利なラッパーであり、要素がビューポートに入ったときに簡単に反応できます。

これは、画像やその他のコンテンツの遅延読み込み、アニメーションのトリガー、無限スクロール、コンテンツの「views」のログ記録などに役立ちます。

<!-- Alpine's Intersect plugin is a convenience wrapper for [Intersection Observer](https://developer.mozilla.org/en-US/docs/Web/API/Intersection_Observer_API) that allows you to easily react when an element enters the viewport. -->

<!-- This is useful for: lazy loading images and other content, triggering animations, infinite scrolling, logging "views" of content, etc. -->

<a name="installation"></a>

## インストール

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

### CDN 経由

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

次のように、バンドル内で使用するために NPM から Intersect をインストールできます。

<!-- You can install Intersect from NPM for use inside your bundle like so: -->

```shell
npm install @alpinejs/intersect
```

Then initialize it from your bundle:

```js
import Alpine from 'alpinejs'
import intersect from '@alpinejs/intersect'

Alpine.plugin(intersect)

...
```

<a name="x-intersect"></a>

## x-intersect

<!-- The primary API for using this plugin is `x-intersect`. You can add `x-intersect` to any element within an Alpine component, and when that component enters the viewport (is scrolled into view), the provided expression will execute. -->

<!-- For example, in the following snippet, `shown` will remain `false` until the element is scrolled into view. At that point, the expression will execute and `shown` will become `true`: -->

このプラグインを使用するための主要な API は `x-intersect` です。 Alpine コンポーネント内の任意の要素に `x-intersect` を追加でき、そのコンポーネントがビューポートに入ると（ビューにスクロールされると）指定された式が実行されます。

たとえば、次のスニペットでは、要素がスクロールされて表示されるまで、`shown` は `false` のままになります。その時点で、式が実行され、`shown` は `true` になります。

```html
<div x-data="{ shown: false }" x-intersect="shown = true">
    <div x-show="shown" x-transition>
        I'm in the viewport!
    </div>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo" style="height: 60px; overflow-y: scroll;" x-data x-ref="root">
    <a href="#" @click.prevent="$refs.root.scrollTo({ top: $refs.root.scrollHeight, behavior: 'smooth' })">Scroll Down 👇</a>
    <div style="height: 50vh"></div>
    <div x-data="{ shown: false }" x-intersect="shown = true" id="yoyo">
        <div x-show="shown" x-transition.duration.1000ms>
            I'm in the viewport!
        </div>
        <div x-show="! shown">&nbsp;</div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="x-intersect-enter"></a>

### x-intersect:enter

<!-- The `:enter` suffix is an alias of `x-intersect`, and works the same way: -->

`:enter` サフィックスは `x-intersect` のエイリアスであり、同じように機能します。

```html
<div x-intersect:enter="shown = true">...</div>
```

<!-- You may choose to use this for clarity when also using the `:leave` suffix. -->

`:leave` サフィックスも使用する場合は、わかりやすくするためにこれを使用することを選択できます。

<a name="x-intersect-leave"></a>

### x-intersect:leave

<!-- Appending `:leave` runs your expression when the element leaves the viewport: -->

`:leave`を追加すると、要素がビューポートを離れるときに式が実行されます。

```html
<div x-intersect:leave="shown = true">...</div>
```

<a name="modifiers"></a>

## Modifiers

<a name="once"></a>

### .once

<!-- Sometimes it's useful to evaluate an expression only the first time an element enters the viewport and not subsequent times. For example when triggering "enter" animations. In these cases, you can add the `.once` modifier to `x-intersect` to achieve this. -->

要素がビューポートに初めて入るときだけ式を評価し、それ以降は評価しないと便利な場合があります。たとえば、「Enter」アニメーションをトリガーする場合です。このような場合、これを実現するために、`.once` 修飾子を `x-intersect` に追加できます。

```html
<div x-intersect.once="shown = true">...</div>
```

<a name="half"></a>

### .half

<!-- Evaluates the expression once the intersection threshold exceeds `0.5`. -->

<!-- Useful for elements where it's important to show at least part of the element. -->

交差しきい値が `0.5` を超えると、式を評価します。

要素の少なくとも一部を表示することが重要な要素に役立ちます。

```html
<div x-intersect.half="shown = true">...</div> // when `0.5` of the element is in the viewport
```

<a name="full"></a>

### .full

<!-- Evaluates the expression once the intersection threshold exceeds `0.99`. -->

<!-- Useful for elements where it's important to show the whole element. -->

交差しきい値が`0.99`を超えると、式を評価します。

要素全体を表示することが重要な要素に役立ちます。

```html
<div x-intersect.full="shown = true">...</div> // when `0.99` of the element is in the viewport
```

<a name="threshold"></a>

### .threshold

<!-- Allows you to control the `threshold` property of the underlying `IntersectionObserver`: -->

<!-- This value should be in the range of "0-100". A value of "0" means: trigger an "intersection" if ANY part of the element enters the viewport (the default behavior). While a value of "100" means: don't trigger an "intersection" unless the entire element has entered the viewport. -->

<!-- Any value in between is a percentage of those two extremes. -->

<!-- For example if you want to trigger an intersection after half of the element has entered the page, you can use `.threshold.50`: -->

基になる `IntersectionObserver` の `threshold` プロパティを制御できます。

この値は「0〜100」の範囲である必要があります。 「0」の値は、要素のいずれかの部分がビューポートに入った場合に「交差」をトリガーすることを意味します（デフォルトの動作）。 「100」の値は次のことを意味します。要素全体がビューポートに入っていない限り、「交差」をトリガーしないでください。

中間の値は、これら2つの極値のパーセンテージです。

たとえば、要素の半分がページに入った後に交差をトリガーする場合は、`.threshold.50` を使用できます。

```html
<div x-intersect.threshold.50="shown = true">...</div> // when 50% of the element is in the viewport
```

<!-- If you wanted to trigger only when 5% of the element has entered the viewport, you could use: `.threshold.05`, and so on and so forth. -->

要素の 5％ がビューポートに入ったときにのみトリガーする場合は、`.threshold.05` などを使用できます。

<a name="margin"></a>

### .margin

<!-- Allows you to control the `rootMargin` property of the underlying `IntersectionObserver`.
This effectively tweaks the size of the viewport boundary. Positive values
expand the boundary beyond the viewport, and negative values shrink it inward. The values
work like CSS margin: one value for all sides, two values for top/bottom, left/right, or
four values for top, right, bottom, left. You can use `px` and `%` values, or use a bare number to
get a pixel value. -->

基になる `IntersectionObserver` の `rootMargin` プロパティを制御できます。
これにより、ビューポート境界のサイズが効果的に調整されます。 正の値
ビューポートを超えて境界を拡張し、負の値で境界を内側に縮小します。 その価値
CSSマージンのように機能します。すべての側面に1つの値、上/下、左/右、または
上、右、下、左の4つの値。 `px` と `％` の値を使用するか、裸の数値を使用して
ピクセル値を取得します。

```html
<div x-intersect.margin.200px="loaded = true">...</div> // Load when the element is within 200px of the viewport
```

```html
<div x-intersect:leave.margin.10%.25px.25.25px="loaded = false">...</div> // Unload when the element gets within 10% of the top of the viewport, or within 25px of the other three edges
```

```html
<div x-intersect.margin.-100px="visible = true">...</div> // Mark as visible when element is more than 100 pixels into the viewport.
```



# Persistプラグイン

<!-- Alpine's Persist plugin allows you to persist Alpine state across page loads. -->

<!-- This is useful for persisting search filters, active tabs, and other features where users will be frustrated if their configuration is reset after refreshing or leaving and revisiting a page. -->

Alpine の Persist プラグインを使用すると、ページの読み込み全体で Alpine の状態を永続化できます。

これは、検索フィルター、アクティブなタブ、およびページを更新したり、ページを離れて再訪した後に構成がリセットされた場合にユーザーがイライラするその他の機能を永続化する場合に役立ちます。

<a name="installation"></a>

## インストール

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

このプラグインは、`<script>` タグから取り込むか、NPM 経由でインストールすることで使用できます。

### CDN 経由

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

このプラグインの CDN ビルドを  `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

<!-- You can install Persist from NPM for use inside your bundle like so: -->

次のように、バンドル内で使用するために NPM から Persist をインストールできます。

```shell
npm install @alpinejs/persist
```

<!-- Then initialize it from your bundle: -->

それから、バンドルから初期化をします。

```js
import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

Alpine.plugin(persist)

...
```

<a name="magic-persist"></a>

## $persist

<!-- The primary API for using this plugin is the magic `$persist` method. -->

<!-- You can wrap any value inside `x-data` with `$persist` like below to persist its value across page loads: -->

このプラグインを使用するための主要な API は、魔法の `$persist` メソッドです。

以下のように `x-data` 内の任意の値を `$persist` でラップして、ページの読み込み間でその値を永続化できます。

```html
<div x-data="{ count: $persist(0) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ count: $persist(0) }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- In the above example, because we wrapped `0` in `$persist()`, Alpine will now intercept changes made to `count` and persist them across page loads. -->

<!-- You can try this for yourself by incrementing the "count" in the above example, then refreshing this page and observing that the "count" maintains its state and isn't reset to "0". -->

上記の例では、`0` を `$persist()` でラップしたため、Alpineは `count` に加えられた変更をインターセプトし、ページの読み込み全体でそれらを永続化します。

上記の例で「count」をインクリメントしてから、このページを更新し、「カウント」がその状態を維持し、「0」にリセットされないことを確認することで、これを自分で試すことができます。

<a name="how-it-works"></a>

## どのように機能しますか？

<!-- If a value is wrapped in `$persist`, on initialization Alpine will register its own watcher for that value. Now everytime that value changes for any reason, Alpine will store the new value in [localStorage](https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage). -->

<!-- Now when a page is reloaded, Alpine will check localStorage (using the name of the property as the key) for a value. If it finds one, it will set the property value from localStorage immediately. -->

<!-- You can observe this behavior by opening your browser devtool's localStorage viewer: -->

<!-- <a href="https://developer.chrome.com/docs/devtools/storage/localstorage/"><img src="/img/persist_devtools.png" alt="Chrome devtools showing the localStorage view with count set to 0"></a> -->

<!-- You'll observe that by simply visiting this page, Alpine already set the value of "count" in localStorage. You'll also notice it prefixes the property name "count" with "_x_" as a way of namespacing these values so Alpine doesn't conflict with other tools using localStorage. -->

<!-- Now change the "count" in the following example and observe the changes made by Alpine to localStorage: -->

値が `$persist` でラップされている場合、初期化時に Alpine はその値に対して独自のウォッチャーを登録します。これで、何らかの理由でその値が変更されるたびに、Alpineは新しい値を [localStorage](https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage) に保存します。

これで、ページがリロードされると、Alpine は localStorageを（プロパティの名前をキーとして使用して）値をチェックします。見つかった場合は、localStorage からプロパティ値をすぐに設定します。

この動作は、ブラウザの devtool の localStorage ビューアを開くことで確認できます。

<a href="https://developer.chrome.com/docs/devtools/storage/localstorage/"><img src="/img/persist_devtools.png" alt="Chrome devtools showing the localStorage view with count set to 0"></a>

このページにアクセスするだけで、Alpine は localStorage に「 count 」の値をすでに設定していることがわかります。また、これらの値の名前空間を設定する方法として、プロパティ名「 count 」の前に「 `_x_` 」を付けて、alpine が localStorage を使用する他のツールと競合しないようにします。

次に、次の例の「count」を変更し、Alpine によってlocalStorage に加えられた変更を確認します。

```html
<div x-data="{ count: $persist(0) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ count: $persist(0) }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

> `$persist` works with primitive values as well as with arrays and objects.
<!-- However, it is worth noting that localStorage must be cleared when the type of the variable changes.<br> -->
<!-- > Given the previous example, if we change count to a value of `$persist({ value: 0 })`, then localStorage must be cleared or the variable 'count' renamed. -->

> `$persist` は、配列やオブジェクトだけでなく、プリミティブ値でも機能します。
ただし、変数のタイプが変更された場合は、localStorage をクリアする必要があることに注意してください。

> 前の例で、count を `$persist({value: 0})` の値に変更する場合は、localStorage をクリアするか、変数'count' の名前を変更する必要があります。

<a name="custom-key"></a>

## カスタムキーの設定

<!-- By default, Alpine uses the property key that `$persist(...)` is being assigned to ("count" in the above examples). -->

<!-- Consider the scenario where you have multiple Alpine components across pages or even on the same page that all use "count" as the property key. -->

<!-- Alpine will have no way of differentiating between these components. -->

<!-- In these cases, you can set your own custom key for any persisted value using the `.as` modifier like so: -->


デフォルトでは、Alpine は `$persist(...)` が割り当てられているプロパティキー（上記の例では "count"）を使用します。

ページ間または同じページに複数の Alpine コンポーネントがあり、すべてがプロパティキーとして「 count 」を使用しているシナリオを考えてみます。

Alpine には、これらのコンポーネントを区別する方法がありません。

このような場合、次のように `.as` 修飾子を使用して、永続化された値に独自のカスタムキーを設定できます。


```html
<div x-data="{ count: $persist(0).as('other-count') }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<!-- Now Alpine will store and retrieve the above "count" value using the key "other-count". -->

<!-- Here's a view of Chrome Devtools to see for yourself: -->

これで、Alpine は、キー「 `other-count` 」を使用して上記の「 count 」値を保存および取得します。

自分で確認できる ChromeDevtools のビューは次のとおりです。

<img src="/img/persist_custom_key_devtools.png" alt="Chrome devtools showing the localStorage view with count set to 0">

<a name="custom-storage"></a>

## カスタムストレージの使用

<!-- By default, data is saved to localStorage, it does not have an expiration time and it's kept even when the page is closed. -->

<!-- Consider the scenario where you want to clear the data once the user close the tab. In this case you can persist data to sessionStorage using the `.using` modifier like so: -->

デフォルトでは、データは localStorage に保存され、有効期限はなく、ページが閉じられても保持されます。

ユーザーがタブを閉じたらデータをクリアするシナリオを考えてみましょう。 この場合、次のように `.using` 修飾子を使用してデータを sessionStorage に永続化できます。


```html
<div x-data="{ count: $persist(0).using(sessionStorage) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<!-- You can also define your custom storage object exposing a getItem function and a setItem function. For example, you can decide to use a session cookie as storage doing so: -->

getItem 関数と setItem 関数を公開するカスタムストレージオブジェクトを定義することもできます。 たとえば、セッション Cookie をストレージとして使用することを決定できます。

```html
<script>
    window.cookieStorage = {
        getItem(key) {
            let cookies = document.cookie.split(";");
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].split("=");
                if (key == cookie[0].trim()) {
                    return decodeURIComponent(cookie[1]);
                }
            }
            return null;
        },
        setItem(key, value) {
            document.cookie = key+' = '+encodeURIComponent(value)
        }
    }
</script>

<div x-data="{ count: $persist(0).using(cookieStorage) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<a name="using-persist-with-alpine-data"></a>

## Alpine.data で $persist を使用する

<!-- If you want to use `$persist` with `Alpine.data`, you need to use a standard function instead of an arrow function so Alpine can bind a custom `this` context when it initially evaluates the component scope. -->

`$persist` を `Alpine.data` と一緒に使用する場合は、アロー関数の代わりに標準関数を使用する必要があります。これにより、Alpine は、コンポーネントスコープを最初に評価するときにカスタムの `this` コンテキストをバインドできます。

```js
Alpine.data('dropdown', function () {
    return {
        open: this.$persist(false)
    }
})
```

<a name="using-alpine-persist-global"></a>

## グローバルな Alpine.$persist の使用

<!-- `Alpine.$persist` is exposed globally so it can be used outside of `x-data` contexts. This is useful to persist data from other sources such as `Alpine.store`. -->

`Alpine.$persist` はグローバルに公開されるため、`x-data` コンテキストの外部で使用できます。 これは、`Alpine.store` などの他のソースからのデータを永続化するのに役立ちます。

```js
Alpine.store('darkMode', {
    on: Alpine.$persist(true).as('darkMode_on')
});
```


<!-- > Notice: This Plugin was previously called "Trap". Trap's functionality has been absorbed into this plugin along with additional functionality. You can swap Trap for Focus without any breaking changes. -->

>注意：このプラグインは以前は「Trap (トラップ)」と呼ばれていました。 Trap の機能は、追加機能とともにこのプラグインに吸収されています。重大な変更を加えることなく、Trap を Focus に交換できます。

# Focus プラグイン

Alpine の Focus プラグインを使用すると、ページのフォーカスを管理できます。

> このプラグインは、内部的にオープンソースツール[Tabbable](https://github.com/focus-trap/tabbable) を多用しています。この問題に非常に必要な解決策を提供してくれたそのチームに大いに感謝します。

<!-- Alpine's Focus plugin allows you to manage focus on a page. -->

<!-- > This plugin internally makes heavy use of the open source tool: [Tabbable](https://github.com/focus-trap/tabbable). Big thanks to that team for providing a much needed solution to this problem. -->

<a name="installation"></a>

## インストール

このプラグインは、 `<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

You can use this plugin by either including it from a `<script>` tag or installing it via NPM:

### CDN 経由

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

次のように、バンドル内で使用するために NPM から Focus をインストールできます。

<!-- You can install Focus from NPM for use inside your bundle like so: -->

```shell
npm install @alpinejs/focus
```

<!-- Then initialize it from your bundle: -->

次に、バンドルから初期化します。

```js
import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'

Alpine.plugin(focus)

...
```

<a name="x-trap"></a>

## x-trap

<!-- Focus offers a dedicated API for trapping focus within an element: the `x-trap` directive. -->

<!-- `x-trap` accepts a JS expression. If the result of that expression is true, then the focus will be trapped inside that element until the expression becomes false, then at that point, focus will be returned to where it was previously. -->

Focus は、要素内にフォーカスをトラップするための専用API、`x-trap` ディレクティブを提供します。

`x-trap` は JS 式を受け入れます。その式の結果がtrueの場合、式が false になるまでフォーカスはその要素内にトラップされ、その時点でフォーカスは以前の場所に戻ります。

<!-- For example: -->

```html
<div x-data="{ open: false }">
    <button @click="open = true">Open Dialog</button>

    <span x-show="open" x-trap="open">
        <p>...</p>

        <input type="text" placeholder="Some input...">

        <input type="text" placeholder="Some other input...">

        <button @click="open = false">Close Dialog</button>
    </span>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <div :class="open && 'opacity-50'">
        <button x-on:click="open = true">Open Dialog</button>
    </div>

    <div x-show="open" x-trap="open" class="mt-4 space-y-4 p-4 border bg-yellow-100" @keyup.escape.window="open = false">
        <strong>
            <div>Focus is now "trapped" inside this dialog, meaning you can only click/focus elements within this yellow dialog. If you press tab repeatedly, the focus will stay within this dialog.</div>
        </strong>

        <div>
            <input type="text" placeholder="Some input...">
        </div>

        <div>
            <input type="text" placeholder="Some other input...">
        </div>

        <div>
            <button @click="open = false">Close Dialog</button>
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="nesting"></a>

### ネストダイアログ

あるダイアログを別のダイアログの中にネストしたい場合があります。 `x-trap` はこれを簡単にし、自動的に処理します。

`x-trap` は、新しく「trapped (トラップされた)」要素を追跡し、最後にアクティブにフォーカスされた要素を格納します。要素が「untrapped (アントラップ)」されると、フォーカスは元の場所に戻ります。

このメカニズムは再帰的であるため、すでにトラップされている要素内にフォーカスを無限にトラップしてから、各要素を連続して「アントラップ」することができます。

<!-- Sometimes you may want to nest one dialog inside another. `x-trap` makes this trivial and handles it automatically. -->

<!-- `x-trap` keeps track of newly "trapped" elements and stores the last actively focused element. Once the element is "untrapped" then the focus will be returned to where it was originally. -->

<!-- This mechanism is recursive, so you can trap focus within an already trapped element infinite times, then "untrap" each element successively. -->

<!-- Here is nesting in action: -->

```html
<div x-data="{ open: false }">
    <button @click="open = true">Open Dialog</button>

    <span x-show="open" x-trap="open">

        ...

        <div x-data="{ open: false }">
            <button @click="open = true">Open Nested Dialog</button>

            <span x-show="open" x-trap="open">

                ...

                <button @click="open = false">Close Nested Dialog</button>
            </span>
        </div>

        <button @click="open = false">Close Dialog</button>
    </span>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ open: false }" class="demo">
    <div :class="open && 'opacity-50'">
        <button x-on:click="open = true">Open Dialog</button>
    </div>

    <div x-show="open" x-trap="open" class="mt-4 space-y-4 p-4 border bg-yellow-100" @keyup.escape.window="open = false">
        <div>
            <input type="text" placeholder="Some input...">
        </div>

        <div>
            <input type="text" placeholder="Some other input...">
        </div>

        <div x-data="{ open: false }">
            <div :class="open && 'opacity-50'">
                <button x-on:click="open = true">Open Nested Dialog</button>
            </div>

            <div x-show="open" x-trap="open" class="mt-4 space-y-4 p-4 border border-gray-500 bg-yellow-200" @keyup.escape.window="open = false">
                <strong>
                    <div>Focus is now "trapped" inside this nested dialog. You cannot focus anything inside the outer dialog while this is open. If you close this dialog, focus will be returned to the last known active element.</div>
                </strong>

                <div>
                    <input type="text" placeholder="Some input...">
                </div>

                <div>
                    <input type="text" placeholder="Some other input...">
                </div>

                <div>
                    <button @click="open = false">Close Nested Dialog</button>
                </div>
            </div>
        </div>

        <div>
            <button @click="open = false">Close Dialog</button>
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="modifiers"></a>

### 修飾子

<a name="inert"></a>

#### .inert

ダイアログ / モーダルなどを作成するときは、フォーカスをトラップするときに、ページ上の他のすべての要素をスクリーンリーダーから非表示にすることをお勧めします。

`.inert` を `x-trap` に追加することにより、フォーカスがトラップされると、ページ上の他のすべての要素が `aria-hidden ="true"` 属性を受け取り、フォーカストラップが無効になると、それらの属性も削除されます。

<!-- When building things like dialogs/modals, it's recommended to hide all the other elements on the page from screen readers when trapping focus. -->

<!-- By adding `.inert` to `x-trap`, when focus is trapped, all other elements on the page will receive `aria-hidden="true"` attributes, and when focus trapping is disabled, those attributes will also be removed. -->

```html
<!-- When `open` is `false`: -->
<body x-data="{ open: false }">
    <div x-trap.inert="open" ...>
        ...
    </div>

    <div>
        ...
    </div>
</body>

<!-- When `open` is `true`: -->
<body x-data="{ open: true }">
    <div x-trap.inert="open" ...>
        ...
    </div>

    <div aria-hidden="true">
        ...
    </div>
</body>
```

<a name="noscroll"></a>

#### .noscroll

Alpine を使用して ダイアログ / モーダルを作成する場合、ダイアログが開いているときに周囲のコンテンツのスクロールを無効にすることをお勧めします。

`x-trap` を使用すると、`.noscroll` 修飾子を使用してこれを自動的に行うことができます。

`.noscroll` を追加することにより、Alpine はページからスクロールバーを削除し、ダイアログが開いている間、ユーザーがページを下にスクロールするのをブロックします。

<!-- When building dialogs/modals with Alpine, it's recommended that you disable scrolling for the surrounding content when the dialog is open. -->

<!-- `x-trap` allows you to do this automatically with the `.noscroll` modifiers. -->

<!-- By adding `.noscroll`, Alpine will remove the scrollbar from the page and block users from scrolling down the page while a dialog is open. -->

<!-- For example: -->

```html
<div x-data="{ open: false }">
    <button>Open Dialog</button>

    <div x-show="open" x-trap.noscroll="open">
        Dialog Contents

        <button @click="open = false">Close Dialog</button>
    </div>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ open: false }">
        <button @click="open = true">Open Dialog</button>

        <div x-show="open" x-trap.noscroll="open" class="border mt-4 p-4">
            <div class="mb-4 text-bold">Dialog Contents</div>

            <p class="mb-4 text-gray-600 text-sm">Notice how you can no longer scroll on this page while this dialog is open.</p>

            <button class="mt-4" @click="open = false">Close Dialog</button>
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="noreturn"></a>

#### .noreturn

以前の場所にフォーカスを戻したくない場合があります。入力のフォーカス時にトリガーされるドロップダウンについて考えてみます。閉じるときにフォーカスを入力に戻すと、ドロップダウンが再び開きます。

`x-trap` を使用すると、`.noreturn` 修飾子を使用してこの動作を無効にできます。

`.noreturn` を追加することにより、Alpine は x-trap 評価のフォーカスを false に戻しません。

<!-- Sometimes you may not want focus to be returned to where it was previously. Consider a dropdown that's triggered upon focusing an input, returning focus to the input on close will just trigger the dropdown to open again. -->

<!-- `x-trap` allows you to disable this behavior with the `.noreturn` modifier. -->

<!-- By adding `.noreturn`, Alpine will not return focus upon x-trap evaluating to false. -->

<!-- For example: -->

```html
<div x-data="{ open: false }" x-trap.noreturn="open">
    <input type="search" placeholder="search for something" />

    <div x-show="open">
        Search results

        <button @click="open = false">Close</button>
    </div>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div
        x-data="{ open: false }"
        x-trap.noreturn="open"
        @click.outside="open = false"
        @keyup.escape.prevent.stop="open = false"
    >
        <input type="search" placeholder="search for something"
            @focus="open = true"
            @keyup.escape.prevent="$el.blur()"
        />

        <div x-show="open">
            <div class="mb-4 text-bold">Search results</div>

            <p class="mb-4 text-gray-600 text-sm">Notice when closing this dropdown, focus is not returned to the input.</p>

            <button class="mt-4" @click="open = false">Close Dialog</button>
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="focus-magic"></a>

## $focus

このプラグインは、ページ内のフォーカスを管理するための多くの小さなユーティリティを提供します。これらのユーティリティは、`$focus` マジックを介して公開されます。

<!-- This plugin offers many smaller utilities for managing focus within a page. These utilities are exposed via the `$focus` magic. -->

|プロパティ|説明|
| --- | --- |
| `focus(el)` |渡された要素に焦点を合わせます(内部で煩わしさを処理する：nextTickを使用するなど)|
| `focusable(el)` |天気を検出するか、要素がフォーカス可能かどうかを検出します|
| `focusables()` |現在の要素内のすべての「フォーカス可能な」要素を取得する|
| `focused()` |ページ上で現在フォーカスされている要素を取得する|
| `lastFocused()` |ページの最後にフォーカスされた要素を取得する|
| `within(el)` | `$ focus`マジックをスコープする要素を指定します(デフォルトでは現在の要素)|
| `first()` |最初のフォーカス可能な要素にフォーカスする|
| `last()` |最後のフォーカス可能な要素にフォーカスする|
| `next()` |次のフォーカス可能な要素にフォーカスする|
| `previous()` |前のフォーカス可能な要素にフォーカスする|
| `noscroll()` |フォーカスされようとしている要素へのスクロールを防止します|
| `wrap()` | 「次の」または「前の」を取得するときは、「ラップアラウンド」を使用します(たとえば、最後の要素の「次の」要素を取得する場合は最初の要素を返します)|
| `getFirst()` |最初のフォーカス可能な要素を取得する|
| `getLast()` |最後のフォーカス可能な要素を取得する|
| `getNext()` |次のフォーカス可能な要素を取得する|
| `getPrevious()` |前のフォーカス可能な要素を取得する|

<!-- | Property | Description |
| ---       | --- |
| `focus(el)`   | Focus the passed element (handling annoyances internally: using nextTick, etc.) |
| `focusable(el)`   | Detect weather or not an element is focusable |
| `focusables()`   | Get all "focusable" elements within the current element |
| `focused()`   | Get the currently focused element on the page |
| `lastFocused()`   | Get the last focused element on the page |
| `within(el)`   | Specify an element to scope the `$focus` magic to (the current element by default) |
| `first()`   | Focus the first focusable element |
| `last()`   | Focus the last focusable element |
| `next()`   | Focus the next focusable element |
| `previous()`   | Focus the previous focusable element |
| `noscroll()`   | Prevent scrolling to the element about to be focused |
| `wrap()`   | When retrieving "next" or "previous" use "wrap around" (ex. returning the first element if getting the "next" element of the last element) |
| `getFirst()`   | Retrieve the first focusable element |
| `getLast()`   | Retrieve the last focusable element |
| `getNext()`   | Retrieve the next focusable element |
| `getPrevious()`   | Retrieve the previous focusable element | -->

<!-- Let's walk through a few examples of these utilities in use. The example below allows the user to control focus within the group of buttons using the arrow keys. You can test this by clicking on a button, then using the arrow keys to move focus around: -->

使用中のこれらのユーティリティのいくつかの例を見ていきましょう。以下の例では、ユーザーは矢印キーを使用してボタンのグループ内でフォーカスを制御できます。これをテストするには、ボタンをクリックしてから、矢印キーを使用してフォーカスを移動します。

```html
<div
    @keydown.right="$focus.next()"
    @keydown.left="$focus.previous()"
>
    <button>First</button>
    <button>Second</button>
    <button>Third</button>
</div>
```

<!-- START_VERBATIM -->
<div class="demo">
<div
    x-data
    @keydown.right="$focus.next()"
    @keydown.left="$focus.previous()"
>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">First</button>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">Second</button>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">Third</button>
</div>
(Click a button, then use the arrow keys to move left and right)
</div>
<!-- END_VERBATIM -->

<!-- Notice how if the last button is focused, pressing "right arrow" won't do anything. Let's add the `.wrap()` method so that focus "wraps around": -->

最後のボタンがフォーカスされている場合、「right arrow (右矢印)」を押しても何も起こらないことに注意してください。フォーカスが「wraps around (ラップアラウンド)」するように、 `.wrap()` メソッドを追加しましょう。

```html
<div
    @keydown.right="$focus.wrap().next()"
    @keydown.left="$focus.wrap().previous()"
>
    <button>First</button>
    <button>Second</button>
    <button>Third</button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
<div
    x-data
    @keydown.right="$focus.wrap().next()"
    @keydown.left="$focus.wrap().previous()"
>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">First</button>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">Second</button>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">Third</button>
</div>
(Click a button, then use the arrow keys to move left and right)
</div>
<!-- END_VERBATIM -->
```

<!-- Now, let's add two buttons, one to focus the first element in the button group, and another focus the last element: -->

次に、2つのボタンを追加しましょう。1つはボタングループの最初の要素にフォーカスし、もう1つは最後の要素にフォーカスします。

```html
<button @click="$focus.within($refs.buttons).first()">Focus "First"</button>
<button @click="$focus.within($refs.buttons).last()">Focus "Last"</button>

<div
    x-ref="buttons"
    @keydown.right="$focus.wrap().next()"
    @keydown.left="$focus.wrap().previous()"
>
    <button>First</button>
    <button>Second</button>
    <button>Third</button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-data>
<button @click="$focus.within($refs.buttons).first()">Focus "First"</button>
<button @click="$focus.within($refs.buttons).last()">Focus "Last"</button>

<hr class="mt-2 mb-2"/>

<div
    x-ref="buttons"
    @keydown.right="$focus.wrap().next()"
    @keydown.left="$focus.wrap().previous()"
>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">First</button>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">Second</button>
    <button class="focus:outline-none focus:ring-2 focus:ring-cyan-400">Third</button>
</div>
</div>
<!-- END_VERBATIM -->
```

<!-- Notice that we needed to add a `.within()` method for each button so that `$focus` knows to scope itself to a different element (the `div` wrapping the buttons). -->

各ボタンに `.within()` メソッドを追加して、`$focus` がそれ自体を別の要素（ボタンをラップする `div`）にスコープすることを認識できるようにする必要があることに注意してください。



# Collapse プラグイン

<!-- Alpine's Collapse plugin allows you to expand and collapse elements using smooth animations. -->

<!-- Because this behavior and implementation differs from Alpine's standard transition system, this functionality was made into a dedicated plugin. -->

Alpine の Collapse プラグインを使用すると、スムーズなアニメーションを使用して要素を展開および折りたたむことができます。

この動作と実装は Alpine の標準の トランジションシステムとは異なるため、この機能は専用のプラグインになりました。


<a name="installation"></a>

## インストール

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

### CDN 経由

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

次のように、バンドル内で使用するために NPM から Collapse をインストールできます。

<!-- You can install Collapse from NPM for use inside your bundle like so: -->

```shell
npm install @alpinejs/collapse
```

<!-- Then initialize it from your bundle: -->

次に、バンドルから初期化します。

```js
import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)

...
```

<a name="x-collapse"></a>

## x-collapse

<!-- The primary API for using this plugin is the `x-collapse` directive. -->

<!-- `x-collapse` can only exist on an element that already has an `x-show` directive. When added to an `x-show` element, `x-collapse` will smoothly "collapse" and "expand" the element when it's visibility is toggled by animating its height property. -->

このプラグインを使用するための主要な API は、`x-collapse` ディレクティブです。

`x-collapse` は、すでに `x-show` ディレクティブを持つ要素にのみ存在できます。 `x-show` 要素に追加すると、` x-collapse` は、高さプロパティをアニメーション化することで要素の表示が切り替えられたときに、要素をスムーズに「折りたたむ」および「拡張する」ことができます。

<!-- For example: -->

例えば

```html
<div x-data="{ expanded: false }">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <p x-show="expanded" x-collapse>
        ...
    </p>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ expanded: false }" class="demo">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse>
        <div class="pt-4">
            Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="modifiers"></a>

## Modifiers (修飾子)

<a name="dot-duration"></a>

### .duration (間隔)

<!-- You can customize the duration of the collapse/expand transition by appending the `.duration` modifier like so: -->

次のように `.duration` 修飾子を追加することで、折りたたみ/展開遷移の期間をカスタマイズできます。

```html
<div x-data="{ expanded: false }">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <p x-show="expanded" x-collapse.duration.1000ms>
        ...
    </p>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ expanded: false }" class="demo">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse.duration.1000ms>
        <div class="pt-4">
            Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="dot-min"></a>

### .min

<!-- By default, `x-collapse`'s "collapsed" state sets the height of the element to `0px` and also sets `display: none;`. -->

<!-- Sometimes, it's helpful to "cut-off" an element rather than fully hide it. By using the `.min` modifier, you can set a minimum height for `x-collapse`'s "collapsed" state. For example: -->

デフォルトでは、`x-collapse` の "collapsed" 状態は、要素の高さを `0px` に設定し、 `display: none;` も設定します。

要素を完全に非表示にするのではなく、要素を「切り取る」と便利な場合があります。 `.min` 修飾子を使用すると、`x-collapse` の「collapsed (折りたたみ)」状態の最小の高さを設定できます。
例えば

```html
<div x-data="{ expanded: false }">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <p x-show="expanded" x-collapse.min.50px>
        ...
    </p>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ expanded: false }" class="demo">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse.min.50px>
        <div class="pt-4">
            Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```



# モーフ (変形) プラグイン

<!-- Alpine's Morph plugin allows you to "morph" an element on the page into the provided HTML template, all while preserving any browser or Alpine state within the "morphed" element. -->

<!-- This is useful for updating HTML from a server request without loosing Alpine's on-page state. A utility like this is at the core of full-stack frameworks like [Laravel Livewire](https://laravel-livewire.com/) and [Phoenix LiveView](https://dockyard.com/blog/2018/12/12/phoenix-liveview-interactive-real-time-apps-no-need-to-write-javascript). -->

<!-- The best way to understand its purpose is with the following interactive visualization. Give it a try! -->

Alpine の モーフプラグインを使用すると、ページ上の要素を提供された HTML テンプレートに「モーフィング」すると同時に、「モーフィング」要素内のブラウザまたは Alpine の状態を保持できます。

これは、Alpine のページ上の状態を失うことなく、サーバー要求からHTMLを更新する場合に役立ちます。 このようなユーティリティは、[Laravel Livewire](https://laravel-livewire.com/) や [Phoenix LiveView](https://dockyard.com/blog/2018/12/12/phoenix-liveview-interactive-real-time-apps-no-need-to-write-javascript) などのフルスタックフレームワークの中核にあります。

その目的を理解する最良の方法は、次のインタラクティブな視覚化を使用することです。 まずは試してみましょう。

```html
<!-- START_VERBATIM -->
<div x-data="{ slide: 1 }" class="border rounded">
    <div>
        <img :src="'/img/morphs/morph'+slide+'.png'">
    </div>

    <div class="flex w-full justify-between" style="padding-bottom: 1rem">
        <div class="w-1/2 px-4">
            <button @click="slide = (slide === 1) ? 13 : slide - 1" class="w-full bg-cyan-400 rounded-full text-center py-3 font-bold text-white">Previous</button>
        </div>
        <div class="w-1/2 px-4">
            <button @click="slide = (slide % 13) + 1" class="w-full bg-cyan-400 rounded-full text-center py-3 font-bold text-white">Next</button>
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="installation"></a>

## インストール

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

### CDN 経由

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/morph@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

<!-- You can install Morph from NPM for use inside your bundle like so: -->

次のように、バンドル内で使用するために NPM から Morph をインストールできます。

```shell
npm install @alpinejs/morph
```

<!-- Then initialize it from your bundle: -->

そのあと、バンドルから初期化をします。

```js
import Alpine from 'alpinejs'
import morph from '@alpinejs/morph'

window.Alpine = Alpine
Alpine.plugin(morph)

...
```

<a name="alpine-morph"></a>

## Alpine.morph()

<!-- The `Alpine.morph(el, newHtml)` allows you to imperatively morph a dom node based on passed in HTML. It accepts the following parameters: -->

<!-- | Parameter | Description |
| ---       | --- |
| `el`      | A DOM element on the page. |
| `newHtml` | A string of HTML to use as the template to morph the dom element into. |
| `options` (optional) | An options object used mainly for [injecting lifecycle hooks](#lifecycle-hooks). | -->

<!-- Here's an example of using `Alpine.morph()` to update an Alpine component with new HTML: (In real apps, this new HTML would likely be coming from the server) -->

`Alpine.morph(el, newHtml)` を使用すると、渡されたHTML に基づいて DOM ノードを強制的にモーフィングできます。 次のパラメータを受け入れます。

| パラメータ| 説明|
| --- | --- |
| `el` | ページ上のDOM要素。 |
| `newHtml` | DOM 要素をモーフィングするためのテンプレートとして使用する HTML の文字列。 |
| `options`<br>(オプション) | 主に[ライフサイクルフックの挿入](#lifecycle-hooks) に使用されるオプションオブジェクト。 |

`Alpine.morph()` を使用して Alpine コンポーネントを新しい HTML で更新する例を次に示します。(実際のアプリでは、この新しい HTML はサーバーから取得される可能性があります）

```html
<div x-data="{ message: 'Change me, then press the button!' }">
    <input type="text" x-model="message">
    <span x-text="message"></span>
</div>

<button>Run Morph</button>

<script>
    document.querySelector('button').addEventListener('click', () => {
        let el = document.querySelector('div')

        Alpine.morph(el, `
            <div x-data="{ message: 'Change me, then press the button!' }">
                <h2>See how new elements have been added</h2>

                <input type="text" x-model="message">
                <span x-text="message"></span>

                <h2>but the state of this component hasn't changed? Magical.</h2>
            </div>
        `)
    })
</script>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: 'Change me, then press the button!' }" id="morph-demo-1" class="space-y-2">
        <input type="text" x-model="message" class="w-full">
        <span x-text="message"></span>
    </div>

    <button id="morph-button-1" class="mt-4">Run Morph</button>
</div>

<script>
    document.querySelector('#morph-button-1').addEventListener('click', () => {
        let el = document.querySelector('#morph-demo-1')

        Alpine.morph(el, `
            <div x-data="{ message: 'Change me, then press the button!' }" id="morph-demo-1" class="space-y-2">
                <h4>See how new elements have been added</h4>
                <input type="text" x-model="message" class="w-full">
                <span x-text="message"></span>
                <h4>but the state of this component hasn't changed? Magical.</h4>
            </div>
        `)
    })
</script>
<!-- END_VERBATIM -->
```

<a name="lifecycle-hooks"></a>

### ライフサイクルフック

<!-- The "Morph" plugin works by comparing two DOM trees, the live element, and the passed in HTML. -->

<!-- Morph walks both trees simultaneously and compares each node and its children. If it finds differences, it "patches" (changes) the current DOM tree to match the passed in HTML's tree. -->

<!-- While the default algorithm is very capable, there are cases where you may want to hook into its lifecycle and observe or change its behavior as it's happening. -->

<!-- Before we jump into the available Lifecycle hooks themselves, let's first list out all the potential parameters they receive and explain what each one is: -->

「Morph」プラグインは、2つの DOM ツリー、ライブ要素、および渡された HTML を比較することによって機能します。

モーフは両方のツリーを同時に解析して、各ノードとその子を比較します。違いが見つかった場合は、現在の DOM ツリーを「パッチ」（変更）して、渡された HTML のツリーと一致させます。

デフォルトのアルゴリズムは非常に機能的ですが、ライフサイクルに接続して、発生中の動作を観察または変更したい場合があります。

利用可能なライフサイクルフック自体に飛び込む前に、まず、それらが受け取る可能性のあるすべてのパラメーターをリストアップし、それぞれが何であるかを説明しましょう。

<!-- | Parameter | Description |
| ---       | --- |
| `el` | This is always the actual, current, DOM element on the page that will be "patched" (changed by Morph). |
| `toEl` | This is a "template element". It's a temporary element representing what the live `el` will be patched to. It will never actually live on the page and should only be used for reference purposes. |
| `childrenOnly()` | This is a function that can be called inside the hook to tell Morph to skip the current element and only "patch" its children. |
| `skip()` | A function that when called within the hook will "skip" comparing/patching itself and the children of the current element. |

Here are the available lifecycle hooks (passed in as the third parameter to `Alpine.morph(..., options)`): -->

|パラメータ|説明|
| --- | --- |
| `el` |これは常に、「パッチが適用される」（モーフによって変更される）ページ上の実際の現在の DOM 要素です。 |
| `toEl` |これは「テンプレート要素」です。これは、ライブの `el` にパッチが適用される対象を表す一時的な要素です。実際にページに表示されることはなく、参照目的でのみ使用する必要があります。 |
| `childrenOnly()` |これは、フック内で呼び出して、現在の要素をスキップし、その子のみを「パッチ」するように Morph に指示できる関数です。 |
| `skip()` |フック内で呼び出されたときに、それ自体と現在の要素の子を比較/パッチする関数を「スキップ」します。 |

使用可能なライフサイクルフックは次のとおりです（  `Alpine.morph(..., options)` に3番目のパラメーターとして渡されます）。

<!-- | Option | Description |
| ---       | --- |
| `updating(el, toEl, childrenOnly, skip)` | Called before patching the `el` with the comparison `toEl`.  |
| `updated(el, toEl)` | Called after Morph has patched `el`. |
| `removing(el, skip)` | Called before Morph removes an element from the live DOM. |
| `removed(el)` | Called after Morph has removed an element from the live DOM. |
| `adding(el, skip)` | Called before adding a new element. |
| `added(el)` | Called after adding a new element to the live DOM tree. |
| `key(el)` | A re-usable function to determine how Morph "keys" elements in the tree before comparing/patching. [More on that here](#keys) |
| `lookahead` | A boolean value telling Morph to enable an extra feature in its algorithm that "looks ahead" to make sure a DOM element that's about to be removed should instead just be "moved" to a later sibling. |

Here is code of all these lifecycle hooks for a more concrete reference: -->

|オプション|説明|
| --- | --- |
| `updating（el、toEl、childrenOnly、skip）` |比較`toEl`で`el`にパッチを当てる前に呼び出されます。 |
| `updated（el、toEl）` | Morphが`el`にパッチを適用した後に呼び出されます。 |
| `removing（el、skip）` | MorphがライブDOMから要素を削除する前に呼び出されます。 |
| `removed（el）` | MorphがライブDOMから要素を削除した後に呼び出されます。 |
| `adding（el、skip）` |新しい要素を追加する前に呼び出されます。 |
| `added（el）` |ライブDOMツリーに新しい要素を追加した後に呼び出されます。 |
| `key（el）` |比較/パッチ適用の前に、モーフがツリー内の要素をどのように「キー」するかを決定するための再利用可能な関数。 [詳細はこちら]（＃keys）|
| `先読み`|削除されようとしているDOM要素が代わりに後の兄弟に「移動」されることを確認するために、アルゴリズムの追加機能を有効にするようにMorphに指示するブール値。 |

より具体的なリファレンスとして、これらすべてのライフサイクルフックのコードを次に示します。

```js
Alpine.morph(el, newHtml, {
    updating(el, toEl, childrenOnly, skip) {
        //
    },

    updated(el, toEl) {
        //
    },

    removing(el, skip) {
        //
    },

    removed(el) {
        //
    },

    adding(el, skip) {
        //
    },

    added(el) {
        //
    },

    key(el) {
        // By default Alpine uses the `key=""` HTML attribute.
        return el.id
    },

    lookahead: true, // Default: false
})
```

<a name="keys"></a>

### キー (Keys)

<!-- Dom-diffing utilities like Morph try their best to accurately "morph" the original DOM into the new HTML. However, there are cases where it's impossible to determine if an element should be just changed, or replaced completely. -->

<!-- Because of this limitation, Morph has a "key" system that allows developers to "force" preserving certain elements rather than replacing them. -->

<!-- The most common use-case for them is a list of siblings within a loop. Below is an example of why keys are necessary sometimes: -->

Morph のような DOM 差分ユーティリティは、元の DOM を新しい HTML に正確に「モーフィング」するために最善を尽くします。 ただし、要素を変更するだけなのか、完全に置き換えるのかを判断できない場合があります。

この制限のため、Morph には、開発者が特定の要素を置き換えるのではなく、保存することを「強制」できる「キー」システムがあります。

それらの最も一般的なユースケースは、ループ内の兄弟のリストです。 以下は、キーが時々必要になる理由の例です。

```html
<!-- "Live" Dom on the page: -->
<ul>
    <li>Mark</li>
    <li>Tom</li>
    <li>Travis</li>
</ul>

<!-- New HTML to "morph to": -->
<ul>
    <li>Travis</li>
    <li>Mark</li>
    <li>Tom</li>
</ul>
```

<!-- Given the above situation, Morph has no way to know that the "Travis" node has been moved in the DOM tree. It just thinks that "Mark" has been changed to "Travis" and "Travis" changed to "Tom". -->

<!-- This is not what we actually want, we want Morph to preserve the original elements and instead of changing them, MOVE them within the `<ul>`. -->

<!-- By adding keys to each node, we can accomplish this like so: -->

上記の状況を考えると、Morph は「Travis」ノードが DOM ツリーで移動されたことを知る方法がありません。 「Mark」が「Travis」に、「Travis」が「Tom」に変わったと思っているだけです。

これは私たちが実際に望んでいることではありません。Morphに元の要素を保持させ、それらを変更する代わりに、`<ul>` 内で移動させます。

各ノードにキーを追加することで、次のように実現できます。

```html
<!-- "Live" Dom on the page: -->
<ul>
    <li key="1">Mark</li>
    <li key="2">Tom</li>
    <li key="3">Travis</li>
</ul>

<!-- New HTML to "morph to": -->
<ul>
    <li key="3">Travis</li>
    <li key="1">Mark</li>
    <li key="2">Tom</li>
</ul>
```

<!-- Now that there are "keys" on the `<li>`s, Morph will match them in both trees and move them accordingly. -->

<!-- You can configure what Morph considers a "key" with the `key:` configuration option. [More on that here](#lifecycle-hooks) -->

`<li>` に「key」があるので、モーフは両方のツリーでそれらを一致させ、それに応じて移動します。

`key:` 構成オプションを使用して、Morph が「キー」と見なすものを構成できます。 [詳細はこちら](#lifecycle-hooks)


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


# 拡張

Alpine には、さまざまな方法で拡張できる非常にオープンなコードベースがあります。 実際、Alpine 自体で利用可能なすべてのディレクティブと魔法は、これらの正確な API を使用しています。 理論的には、Alpine のすべての機能を自分で再構築できます。

<!-- Alpine has a very open codebase that allows for extension in a number of ways. In fact, every available directive and magic in Alpine itself uses these exact APIs. In theory you could rebuild all of Alpine's functionality using them yourself. -->

<a name="lifecycle-concerns"></a>

## ライフサイクルの懸念

個々の API について詳しく説明する前に、まず、コードベースのどこでこれらの API を使用する必要があるかについて説明しましょう。

これらの API は、Alpine がページを初期化する方法に影響を与えるため、Alpine がダウンロードされてページで利用可能になった後、ただしページ自体を初期化する前に登録する必要があります。

Alpine をバンドルにインポートするか、`<script>` タグを介して直接含めるかによって、2つの異なる手法があります。 それらの両方を見てみましょう

<!-- Before we dive into each individual API, let's first talk about where in your codebase you should consume these APIs. -->

<!-- Because these APIs have an impact on how Alpine initializes the page, they must be registered AFTER Alpine is downloaded and available on the page, but BEFORE it has initialized the page itself. -->

<!-- There are two different techniques depending on if you are importing Alpine into a bundle, or including it directly via a `<script>` tag. Let's look at them both: -->

<a name="via-script-tag"></a>

### script タグ経由

スクリプトタグを介して Alpine を含める場合は、`alpine:init` イベントリスナー内にカスタム拡張コードを登録する必要があります。

<!-- If you are including Alpine via a script tag, you will need to register any custom extension code inside an `alpine:init` event listener. -->

<!-- Here's an example: -->

```html
<html>
    <script src="/js/alpine.js" defer></script>

    <div x-data x-foo></div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('foo', ...)
        })
    </script>
</html>
```

<!-- If you want to extract your extension code into an external file, you will need to make sure that file's `<script>` tag is located BEFORE Alpine's like so: -->

拡張コードを外部ファイルに抽出する場合は、ファイルの `<script>` タグが Alpine のようになる前に配置されていることを確認する必要があります。

```html
<html>
    <script src="/js/foo.js" defer></script>
    <script src="/js/alpine.js" defer></script>

    <div x-data x-foo></div>
</html>
```

<a name="via-npm"></a>

### NPM モジュール経由

Alpineをバンドルにインポートした場合は、`Alpine` グローバルオブジェクトをインポートするとき、および `Alpine.start()` を呼び出して Alpine を初期化するときに、拡張コードを BETWEEN に登録していることを確認する必要があります。

<!-- If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the `Alpine` global object, and when you initialize Alpine by calling `Alpine.start()`. For example: -->

```js
import Alpine from 'alpinejs'

Alpine.directive('foo', ...)

window.Alpine = Alpine
window.Alpine.start()
```

<!-- Now that we know where to use these extension APIs, let's look more closely at how to use each one: -->

これらの拡張 API の使用場所がわかったので、それぞれの使用方法を詳しく見ていきましょう。

<a name="custom-directives"></a>

## カスタムディレクティブ

<!-- Alpine allows you to register your own custom directives using the `Alpine.directive()` API. -->

Alpine では、`Alpine.directive()` APIを使用して独自のカスタムディレクティブを登録できます。

<a name="method-signature"></a>

### メソッドシグネチャ

```js
Alpine.directive(
    '[name]',
    (
        el,
        { value, modifiers, expression },
        { Alpine, effect, cleanup }
    ) => {})
```

&nbsp; | &nbsp;
--- | 
name | The name of the magic. The name "foo" for example would be consumed as `$foo`
el | The DOM element the magic was triggered from
Alpine | The Alpine global object -->


&nbsp; | &nbsp;
--- | ---
name | マジックの名前。たとえば、「foo」という名前は「$foo」として使用されます。
el |マジックが引き起こされた DOM 要素
Alpine | Alpine グローバルオブジェクト

<a name="magic-properties"></a>

### マジックプロパティ

<!-- Here's a basic example of a "$now" magic helper to easily get the current time from anywhere in Alpine: -->

これは、Alpine のどこからでも現在の時刻を簡単に取得できる「$now」マジックヘルパーの基本的な例です。

```js
Alpine.magic('now', () => {
    return (new Date).toLocaleTimeString()
})
```
```html
<span x-text="$now"></span>
```

<!-- Now the `<span>` tag will contain the current time, resembling something like "12:00:00 PM". -->

<!-- As you can see `$now` behaves like a static property, but under the hood is actually a getter that evaluates every time the property is accessed. -->

<!-- Because of this, you can implement magic "functions" by returning a function from the getter. -->

これで、`<span>` タグに現在の時刻が含まれ、「12:00:00PM」のようになります。

ご覧のとおり、`$now` は静的プロパティのように動作しますが、実際には、プロパティにアクセスするたびに評価するゲッターが内部にあります。

このため、ゲッターから関数を返すことで、魔法の「関数」を実装できます。

<a name="magic-functions"></a>

### Magic Functions

<!-- For example, if we wanted to create a `$clipboard()` magic function that accepts a string to copy to clipboard, we could implement it like so: -->

たとえば、クリップボードにコピーする文字列を受け入れる `$clipboard()` マジック関数を作成したい場合は、次のように実装できます。

```js
Alpine.magic('clipboard', () => {
    return subject => navigator.clipboard.writeText(subject)
})
```
```html
<button @click="$clipboard('hello world')">Copy "Hello World"</button>
```

<!-- Now that accessing `$clipboard` returns a function itself, we can immediately call it and pass it an argument like we see in the template with `$clipboard('hello world')`. -->

<!-- You can use the more brief syntax (a double arrow function) for returning a function from a function if you'd prefer: -->

`$clipboard` にアクセスすると関数自体が返されるので、すぐにそれを呼び出して、`$clipboard('hello world')` のテンプレートにあるような引数を渡すことができます。

必要に応じて、関数から関数を返すためのより簡単な構文（二重矢印関数）を使用できます。

```js
Alpine.magic('clipboard', () => subject => {
    navigator.clipboard.writeText(subject)
})
```

<a name="writing-and-sharing-plugins"></a>

## プラグインの作成と共有

これで、独自のカスタムディレクティブとマジックをアプリケーションに登録することがいかにフレンドリーでシンプルであるかがわかるはずですが、NPM パッケージなどを介してその機能を他のユーザーと共有するのはどうでしょうか。

Alpine の公式「プラグインブループリント」パッケージをすぐに使い始めることができます。リポジトリのクローンを作成し、`npm install && npm run build` を実行して、プラグインを作成するのと同じくらい簡単です。

デモンストレーションの目的で、ディレクティブ（`x-foo`）とマジック（`$foo`）の両方を含む `Foo` と呼ばれる 見せかけの Alpine プラグインを最初から作成しましょう。

Alpine と一緒に単純な `<script>` タグとして使用するためにこのプラグインの作成を開始し、次にバンドルにインポートするためのモジュールにレベルアップします。

<!-- By now you should see how friendly and simple it is to register your own custom directives and magics in your application, but what about sharing that functionality with others via an NPM package or something? -->

<!-- You can get started quickly with Alpine's official "plugin-blueprint" package. It's as simple as cloning the repository and running `npm install && npm run build` to get a plugin authored. -->

<!-- For demonstration purposes, let's create a pretend Alpine plugin from scratch called `Foo` that includes both a directive (`x-foo`) and a magic (`$foo`). -->

<!-- We'll start producing this plugin for consumption as a simple `<script>` tag alongside Alpine, then we'll level it up to a module for importing into a bundle: -->

<a name="script-include"></a>

### スクリプトインクルード

<!-- Let's start in reverse by looking at how our plugin will be included into a project: -->

プラグインがプロジェクトにどのように含まれるかを見て、逆に始めましょう。

```html
<html>
    <script src="/js/foo.js" defer></script>
    <script src="/js/alpine.js" defer></script>

    <div x-data x-init="$foo()">
        <span x-foo="'hello world'">
    </div>
</html>
```

<!-- Notice how our script is included BEFORE Alpine itself. This is important, otherwise, Alpine would have already been initialized by the time our plugin got loaded. -->

<!-- Now let's look inside of `/js/foo.js`'s contents: -->

Alpine 自体の前にスクリプトがどのように含まれているかに注意してください。これは重要です。そうでない場合、プラグインがロードされるまでに Alpine はすでに初期化されているはずです。

それでは、`/js/foo.js` の内容の内部を見てみましょう。

```js
document.addEventListener('alpine:init', () => {
    window.Alpine.directive('foo', ...)

    window.Alpine.magic('foo', ...)
})
```

<!-- That's it! Authoring a plugin for inclusion via a script tag is extremely simple with Alpine. -->

それでおしまい！スクリプトタグを介してプラグインを含めるためのオーサリングは、Alpine を使用すると非常に簡単です。

<a name="bundle-module"></a>

### バンドルモジュール

ここで、誰かが NPM を介してインストールし、バンドルに含めることができるプラグインを作成したいとします。

最後の例のように、このプラグインを使用するとどのように見えるかから始めて、これを逆に説明します。

<!-- Now let's say you wanted to author a plugin that someone could install via NPM and include into their bundle. -->

<!-- Like the last example, we'll walk through this in reverse, starting with what it will look like to consume this plugin: -->

```js
import Alpine from 'alpinejs'

import foo from 'foo'
Alpine.plugin(foo)

window.Alpine = Alpine
window.Alpine.start()
```

<!-- You'll notice a new API here: `Alpine.plugin()`. This is a convenience method Alpine exposes to prevent consumers of your plugin from having to register multiple different directives and magics themselves. -->

<!-- Now let's look at the source of the plugin and what gets exported from `foo`: -->

ここに新しい API があります `Alpine.plugin()` これは、プラグインのコンシューマーが複数の異なるディレクティブやマジックを自分で登録する必要がないようにするために Alpine が公開する便利な方法です。

次に、プラグインのソースと、`foo` からエクスポートされるものを見てみましょう。

```js
export default function (Alpine) {
    Alpine.directive('foo', ...)
    Alpine.magic('foo', ...)
}
```

<!-- You'll see that `Alpine.plugin` is incredibly simple. It accepts a callback and immediately invokes it while providing the `Alpine` global as a parameter for use inside of it. -->

<!-- Then you can go about extending Alpine as you please. -->

`Alpine.plugin` は非常にシンプルであることがわかります。コールバックを受け入れ、すぐに呼び出します。その間、内部で使用するパラメータとして `Alpine` グローバルを提供します。

その後、好きなようにアルパインを拡張することができます。



# Async (非同期)

<!-- Alpine is built to support asynchronous functions in most places it supports standard ones. -->

<!-- For example, let's say you have a simple function called `getLabel()` that you use as the input to an `x-text` directive: -->

Alpine は、標準の関数をサポートするほとんどの場所で非同期関数をサポートするように構築されています。

たとえば、`x-text` ディレクティブへの入力として使用する `getLabel()` という単純な関数があるとします。

```js
function getLabel() {
    return 'Hello World!'
}
```

```html
<span x-text="getLabel()"></span>
```

<!-- Because `getLabel` is synchronous, everything works as expected. -->

<!-- Now let's pretend that `getLabel` makes a network request to retrieve the label and can't return one instantaneously (asynchronous). By making `getLabel` an async function, you can call it from Alpine using JavaScript's `await` syntax. -->

`getLabel` は同期しているため、すべてが期待どおりに機能します。

ここで、 `getLabel` がラベルを取得するためのネットワーク要求を行い、ラベルを瞬時に返すことができない（非同期）と仮定しましょう。`getLabel` を非同期関数にすることで、JavaScript の `await` 構文を使用して Alpine から呼び出すことができます。

```js
async function getLabel() {
    let response = await fetch('/api/label')

    return await response.text()
}
```

```html
<span x-text="await getLabel()"></span>
```

<!-- Additionally, if you prefer calling methods in Alpine without the trailing parenthesis, you can leave them out and Alpine will detect that the provided function is async and handle it accordingly. For example: -->

さらに、末尾に括弧を付けずに Alpine でメソッドを呼び出す場合は、メソッドを省略できます。Alpine 、提供された関数が非同期であることを検出し、それに応じて処理します。 例えば：

```html
<span x-text="getLabel"></span>
```



# CSP（コンテンツセキュリティポリシー）

<!-- In order for Alpine to be able to execute plain strings from HTML attributes as JavaScript expressions, for example `x-on:click="console.log()"`, it needs to rely on utilities that violate the "unsafe-eval" content security policy. -->

<!-- > Under the hood, Alpine doesn't actually use eval() itself because it's slow and problematic. Instead it uses Function declarations, which are much better, but still violate "unsafe-eval". -->

<!-- In order to accommodate environments where this CSP is necessary, Alpine offers an alternate build that doesn't violate "unsafe-eval", but has a more restrictive syntax. -->

<!-- CSP（コンテンツセキュリティポリシー） -->

Alpine が HTML 属性から JavaScript 式としてプレーン文字列（ たとえば、`x-on:click = "console.log()"` ）を実行できるようにするには、「unsafe-eval」に違反するユーティリティに依存する必要があります。 コンテンツセキュリティポリシー。

> 内部的には、Alpine は遅くて問題があるため、実際には eval() 自体を使用しません。 代わりに、関数宣言を使用します。これははるかに優れていますが、それでも「unsafe-eval」に違反します。

この CSP が必要な環境に対応するために、Alpine は、「unsafe-eval」に違反しないが、構文がより制限された代替ビルドを提供しています。

<a name="installation"></a>

## インストール

<!-- Like all Alpine extensions, you can include this either via `<script>` tag or module import: -->

すべての Alpine 拡張機能と同様に、これは `<script>` タグまたはモジュールインポートのいずれかを介して含めることができます。

<a name="script-tag"></a>

### Script タグ

```html
<html>
    <script src="alpinejs/alpinejs-csp/cdn.js" defer></script>
</html>
```

<a name="module-import"></a>

### モジュールのインポート

```js
import Alpine from '@alpinejs/csp'

window.Alpine = Alpine
window.Alpine.start()
```

<a name="restrictions"></a>

## 制限

<!-- Since Alpine can no longer interpret strings as plain JavaScript, it has to parse and construct JavaScript functions from them manually. -->

<!-- Due to this limitation, you must use `Alpine.data` to register your `x-data` objects, and must reference properties and methods from it by key only. -->

<!-- For example, an inline component like this will not work. -->

<!-- 制限 -->

Alpine は文字列をプレーンな JavaScript として解釈できなくなったため、文字列から JavaScript 関数を手動で解析および構築する必要があります。

この制限により、 `Alpine.data` を使用して `x-data` オブジェクトを登録し、そこからプロパティとメソッドをキーのみで参照する必要があります。

たとえば、このようなインラインコンポーネントは機能しません。

```html
<!-- Bad -->
<div x-data="{ count: 1 }">
    <button @click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<!-- However, breaking out the expressions into external APIs, the following is valid with the CSP build: -->

ただし、式を外部 API に分割すると、CSP ビルドでは次のことが有効になります。

```html
<!-- Good -->
<div x-data="counter">
    <button @click="increment">Increment</button>

    <span x-text="count"></span>
</div>
```
```js
Alpine.data('counter', () => ({
    count: 1,

    increment() { this.count++ }
}))
```

