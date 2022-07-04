---
order: 3
title: Templating
---

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
