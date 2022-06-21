---
order: 10
title: transition
---

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
