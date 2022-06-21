---
order: 12
title: teleport
description: Send Alpine templates to other parts of the DOM
graph_image: https://alpinejs.dev/social_teleport.jpg
---

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

