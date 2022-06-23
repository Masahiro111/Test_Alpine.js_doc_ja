---
order: 2
title: Upgrade From V2
---

# Upgrade from V2

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

## 重大な変更

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

### `$el` は常に現在の要素になりました

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

[→V3の `$el` についてもっと読む](/magics/el)
[→V3の `$root` についてもっと読む](/magics/root)

<a name="auto-init"></a>

### Automatically evaluate `init()` functions defined on data object

A common pattern in V2 was to manually call an `init()` (or similarly named method) on an `x-data` object.

In V3, Alpine will automatically call `init()` methods on data objects.

データオブジェクトで定義された`init（）`関数を自動的に評価します

V2の一般的なパターンは、 `x-data`オブジェクトで`init（） `（または同様の名前のメソッド）を手動で呼び出すことでした。

V3では、Alpineはデータオブジェクトに対して自動的に `init（）`メソッドを呼び出します。

```alpine
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

[→ Read more about auto-evaluating init functions](/globals/alpine-data#init-functions)

<a name="need-to-call-alpine-start"></a>

### Need to call Alpine.start() after import

If you were importing Alpine V2 from NPM, you will now need to manually call `Alpine.start()` for V3. This doesn't affect you if you use Alpine's build file or CDN from a `<template>` tag.

[→初期化関数の自動評価についてもっと読む]（/ globals / alpine-data＃init-functions）

<a name="need-to-call-alpine-start"> </a>

###インポート後にAlpine.start（）を呼び出す必要があります

NPMからAlpineV2をインポートしていた場合は、V3に対して手動で `Alpine.start（）`を呼び出す必要があります。 Alpineのビルドファイルまたは`<template>`タグからのCDNを使用する場合、これは影響しません。

```js
// 🚫 Before
import 'alpinejs'

// ✅ After
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()
```

[→ Read more about initializing Alpine V3](/essentials/installation#as-a-module)

[→AlpineV3の初期化についてもっと読む]（/ Essentials / installation＃as-a-module）

<a name="removed-show-dot-transition"></a>

### `x-show.transition` is now `x-transition`

All of the conveniences provided by `x-show.transition...` helpers are still available, but now from a more unified API: `x-transition`:

###`x-show.transition`は`x-transition`になりました

`x-show.transition ...`ヘルパーによって提供されるすべての便利な機能は引き続き利用できますが、より統合されたAPIから提供されるようになりました： `x-transition`：

```alpine
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

[→ Read more about x-transition](/directives/transition)

<a name="x-if-no-transitions"></a>

### `x-if` no longer supports `x-transition`

The ability to transition elements in and add before/after being removed from the DOM is no longer available in Alpine.

This was a feature very few people even knew existed let alone used.

Because the transition system is complex, it makes more sense from a maintenance perspective to only support transitioning elements with `x-show`.

[→x-transitionについてもっと読む]（/directives/transition）

<a name="x-if-no-transitions"> </a>

###`x-if`は`x-transition`をサポートしなくなりました

DOMに要素を移行したり、DOMから削除する前/後に追加したりする機能は、Alpineでは使用できなくなりました。

これは、使用されるどころか、存在することさえ知っている人はほとんどいない機能でした。

遷移システムは複雑であるため、メンテナンスの観点からは、`x-show`で遷移要素のみをサポートする方が理にかなっています。

```alpine
<!-- 🚫 Before -->
<template x-if.transition="open">
    <div>...</div>
</template>

<!-- ✅ After -->
<div x-show="open" x-transition>...</div>
```

[→ Read more about x-if](/directives/if)

<a name="x-data-scope"></a>

### `x-data` cascading scope

Scope defined in `x-data` is now available to all children unless overwritten by a nested `x-data` expression.

[→x-ifについてもっと読む]（/directives/if）

<a name="x-data-scope"> </a>

###`x-data`カスケードスコープ

`x-data`で定義されたスコープは、ネストされた` x-data`式で上書きされない限り、すべての子で使用できるようになりました。

```alpine
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

[→ Read more about x-data scoping](/directives/data#scope)

<a name="x-init-no-callback"></a>

### `x-init` no longer accepts a callback return

Before V3, if `x-init` received a return value that is `typeof` "function", it would execute the callback after Alpine finished initializing all other directives in the tree. Now, you must manually call `$nextTick()` to achieve that behavior. `x-init` is no longer "return value aware".

<a name="x-init-no-callback"> </a>

###`x-init`はコールバックリターンを受け入れなくなりました

V3より前では、`x-init`が`typeof` "function"である戻り値を受け取った場合、Alpineがツリー内の他のすべてのディレクティブの初期化を完了した後にコールバックを実行していました。 ここで、その動作を実現するには、手動で `$ nextTick（）`を呼び出す必要があります。 `x-init`は「戻り値を認識」しなくなりました。

```alpine
<!-- 🚫 Before -->
<div x-data x-init="() => { ... }">...</div>

<!-- ✅ After -->
<div x-data x-init="$nextTick(() => { ... })">...</div>
```

[→ Read more about $nextTick](/magics/next-tick)

<a name="no-false-return-from-event-handlers"></a>

### Returning `false` from event handlers no longer implicitly "preventDefault"s

Alpine V2 observes a return value of `false` as a desire to run `preventDefault` on the event. This conforms to the standard behavior of native, inline listeners: `<... oninput="someFunctionThatReturnsFalse()">`. Alpine V3 no longer supports this API. Most people don't know it exists and therefore is surprising behavior.

[→$nextTickについてもっと読む]（/ magics / next-tick）

<a name="no-false-return-from-event-handlers"> </a>

###イベントハンドラーから`false`を返すことは、暗黙的に"preventDefault"ではなくなりました

Alpine V2は、イベントで`preventDefault`を実行したいという要望として`false`の戻り値を観察します。 これは、ネイティブのインラインリスナーの標準動作 `<... oninput =" someFunctionThatReturnsFalse（）">`に準拠しています。 AlpineV3はこのAPIをサポートしなくなりました。 ほとんどの人はそれが存在することを知らないので、驚くべき行動です。

```alpine
<!-- 🚫 Before -->
<div x-data="{ blockInput() { return false } }">
    <input type="text" @input="blockInput()">
</div>

<!-- ✅ After -->
<div x-data="{ blockInput(e) { e.preventDefault() }">
    <input type="text" @input="blockInput($event)">
</div>
```

[→ Read more about x-on](/directives/on)

<a name="x-spread-now-x-bind"></a>

### `x-spread` is now `x-bind`

One of Alpine's stories for re-using functionality is abstracting Alpine directives into objects and applying them to elements with `x-spread`. This behavior is still the same, except now `x-bind` (with no specified attribute) is the API instead of `x-spread`.

[→x-onについてもっと読む]（/ directives / on）

<a name="x-spread-now-x-bind"> </a>

###`x-spread`は`x-bind`になりました

機能を再利用するためのAlpineのストーリーの1つは、Alpineディレクティブをオブジェクトに抽象化し、それらを`x-spread`を使用して要素に適用することです。 この動作は同じですが、 `x-bind`（属性が指定されていない）が`x-spread`ではなくAPIになっている点が異なります。

```alpine
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

[→ Read more about binding directives using x-bind](/directives/bind#bind-directives)

<a name="use-global-events-now"></a>

### Use global lifecycle events instead of `Alpine.deferLoadingAlpine()`

[→x-bindを使用したディレクティブのバインドについてもっと読む]（/directives/bind#bind-directives）

<a name="use-global-events-now"> </a>

### `Alpine.deferLoadingAlpine（）`の代わりにグローバルライフサイクルイベントを使用する

```alpine
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

[→ Read more about Alpine lifecycle events](/essentials/lifecycle#alpine-initialization)

<a name="x-ref-no-more-dynamic"></a>

### `x-ref` no longer supports binding

In Alpine V2 for below code

```alpine
<div x-data="{options: [{value: 1}, {value: 2}, {value: 3}] }">
    <div x-ref="0">0</div>
    <template x-for="option in options">
        <div :x-ref="option.value" x-text="option.value"></div>
    </template>

    <button @click="console.log($refs[0], $refs[1], $refs[2], $refs[3]);">Display $refs</button>
</div>
```

after clicking button all `$refs` were displayed. However, in Alpine V3 it's possible to access only `$refs` for elements created statically, so only first ref will be returned as expected.

<a name="no-ie-11"></a>

### IE11 no longer supported

Alpine will no longer officially support Internet Explorer 11. If you need support for IE11, we recommend still using Alpine V2.

## Deprecated APIs

The following 2 APIs will still work in V3, but are considered deprecated and are likely to be removed at some point in the future.

<a name="away-replace-with-outside"></a>

### Event listener modifier `.away` should be replaced with `.outside`

ボタンをクリックすると、すべての`$refs`が表示されました。 ただし、Alpine V3では、静的に作成された要素の `$ refs`にのみアクセスできるため、期待どおりに最初のrefのみが返されます。

<a name="no-ie-11"> </a>

###IE11はサポートされなくなりました

AlpineはInternetExplorer11を正式にサポートしなくなります。IE11のサポートが必要な場合は、AlpineV2を引き続き使用することをお勧めします。

##非推奨のAPI

次の2つのAPIはV3でも引き続き機能しますが、非推奨と見なされ、将来のある時点で削除される可能性があります。

<a name="away-replace-with-outside"> </a>

###イベントリスナー修飾子`.away`は`.outside`に置き換える必要があります

```alpine
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

### Prefer `Alpine.data()` to global Alpine function data providers

###グローバルAlpine関数データプロバイダーよりも`Alpine.data（）`を優先する

```alpine
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

> Note that you need to define `Alpine.data()` extensions BEFORE you call `Alpine.start()`. For more information, refer to the [Lifecycle Concerns](https://alpinejs.dev/advanced/extending#lifecycle-concerns) and [Installation as a Module](https://alpinejs.dev/essentials/installation#as-a-module) documentation pages.

> `Alpine.start（）`を呼び出す前に、 `Alpine.data（）`拡張子を定義する必要があることに注意してください。 詳細については、[ライフサイクルの懸念事項]（https://alpinejs.dev/advanced/extending#lifecycle-concerns）および[モジュールとしてのインストール]（https://alpinejs.dev/essentials/installation#as-）を参照してください。 a-module）ドキュメントページ。