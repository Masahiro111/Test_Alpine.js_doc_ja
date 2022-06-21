---
order: 12
title: cloak
---

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

Now, the following example will hide the `<span>` tag until Alpine has set its text content to the `message` property.

以下の例では、Alpine が `message` プロパティへのテキストがセット完了するまで、`s-cloak` を指定した `<span>` タグが表示されません。

```alpine
<span x-cloak x-text="message"></span>
```

<!-- When Alpine loads on the page, it removes all `x-cloak` property from the element, which also removes the `display: none;` applied by CSS, therefore showing the element. -->

<!-- If you'd like to achieve this same behavior, but avoid having to include a global style, you can use the following cool, but admittedly odd trick: -->

Alpineがページに読み込まれると、要素からすべての `x-cloak`プロパティが削除されます。これにより、CSSによって適用された ` display:none;` も削除されるため、要素が表示されます。

これと同じ動作を実現したいが、グローバルスタイルを含める必要がない場合は、次のクールな、しかし確かに奇妙なトリックを使用できます。

```alpine
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