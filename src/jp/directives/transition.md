---
order: 10
title: transition
---

# x-transition

<!-- Alpine provides a robust transitions utility out of the box. With a few `x-transition` directives, you can create smooth transitions between when an element is shown or hidden. -->

<!-- There are two primary ways to handle transitions in Alpine: -->

Alpine は、すぐに使用できる堅牢な移行ユーティリティを提供します。 いくつかの `x-transition` ディレクティブを使用すると、要素が「表示」または「非表示」になるときの間のスムーズな遷移を作成できます。

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

<!-- As you can see, by default, `x-transition` applies pleasant transition defaults to fade and scale the revealing element. -->

<!-- You can override these defaults with modifiers attached to `x-transition`. Let's take a look at those. -->

ご覧のとおり、デフォルトでは、`x-transition` は快適なトランジションのデフォルトを適用して、表示要素をフェードおよびスケーリングします。

これらのデフォルトは、`x-transition` に付加された修飾子でオーバーライドできます。 それらを見てみましょう。

<a name="customizing-duration"></a>

### 期間のカスタマイズ

<!-- Initially, the duration is set to be 150 milliseconds when entering, and 75 milliseconds when leaving. -->

<!-- You can configure the duration you want for a transition with the `.duration` modifier: -->

当初、継続時間は、入力時に150ミリ秒、終了時に75ミリ秒に設定されています。

`.duration` 修飾子を使用して、トランジションに必要な期間を構成できます。

```html
<div ... x-transition.duration.500ms>
```

<!-- The above `<div>` will transition for 500 milliseconds when entering, and 500 milliseconds when leaving. -->

上記の `<div>` は、入力時および終了時に、500ミリ秒の間隔を持ってトランジションが実行されます。

If you wish to customize the durations specifically for entering and leaving, you can do that like so:

もし、個々に「enter (入力時)」「leave (終了時)」の間隔を設定したい場合は、以下のように指定します。

```html
<div ...
    x-transition:enter.duration.500ms
    x-transition:leave.duration.400ms
>
```

<a name="customizing-delay"></a>

### Customizing delay

You can delay a transition using the `.delay` modifier like so:

```html
<div ... x-transition.delay.50ms>
```

The above example will delay the transition and in and out of the element by 50 milliseconds.

<a name="customizing-opacity"></a>

### Customizing opacity

By default, Alpine's `x-transition` applies both a scale and opacity transition to achieve a "fade" effect.

If you wish to only apply the opacity transition (no scale), you can accomplish that like so:

```html
<div ... x-transition.opacity>
```

<a name="customizing-scale"></a>

### Customizing scale

Similar to the `.opacity` modifier, you can configure `x-transition` to ONLY scale (and not transition opacity as well) like so:

```html
<div ... x-transition.scale>
```

The `.scale` modifier also offers the ability to configure its scale values AND its origin values:

```html
<div ... x-transition.scale.80>
```

The above snippet will scale the element up and down by 80%.

Again, you may customize these values separately for enter and leaving transitions like so:

```html
<div ...
    x-transition:enter.scale.80
    x-transition:leave.scale.90
>
```

To customize the origin of the scale transition, you can use the `.origin` modifier:

```html
<div ... x-transition.scale.origin.top>
```

Now the scale will be applied using the top of the element as the origin, instead of the center by default.

Like you may have guessed, the possible values for this customization are: `top`, `bottom`, `left`, and `right`.

If you wish, you can also combine two origin values. For example, if you want the origin of the scale to be "top right", you can use: `.origin.top.right` as the modifier.


<a name="applying-css-classes"></a>

## Applying CSS classes

For direct control over exactly what goes into your transitions, you can apply CSS classes at different stages of the transition.

> The following examples use [TailwindCSS](https://tailwindcss.com/docs/transition-property) utility classes.

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

| Directive      | Description |
| ---            | --- |
| `:enter`       | Applied during the entire entering phase. |
| `:enter-start` | Added before element is inserted, removed one frame after element is inserted. |
| `:enter-end`   | Added one frame after element is inserted (at the same time `enter-start` is removed), removed when transition/animation finishes.
| `:leave`       | Applied during the entire leaving phase. |
| `:leave-start` | Added immediately when a leaving transition is triggered, removed after one frame. |
| `:leave-end`   | Added one frame after a leaving transition is triggered (at the same time `leave-start` is removed), removed when the transition/animation finishes.
