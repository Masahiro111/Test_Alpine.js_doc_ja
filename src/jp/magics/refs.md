---
order: 2
prefix: $
title: refs
---

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
