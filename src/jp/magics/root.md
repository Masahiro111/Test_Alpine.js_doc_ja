---
order: 7
prefix: $
title: root
---

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