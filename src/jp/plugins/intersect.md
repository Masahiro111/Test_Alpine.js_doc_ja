---
order: 2
title: Intersect
description: An Alpine convenience wrapper for Intersection Observer that allows you to easily react when an element enters the viewport.
graph_image: https://alpinejs.dev/social_intersect.jpg
---

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
