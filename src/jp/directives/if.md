---
order: 16
title: if
---

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