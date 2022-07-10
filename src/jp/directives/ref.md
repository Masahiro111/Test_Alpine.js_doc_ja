---
order: 11
title: ref
---

# x-ref

<!-- `x-ref` in combination with `$refs` is a useful utility for easily accessing DOM elements directly. It's most useful as a replacement for APIs like `getElementById` and `querySelector`. -->

`$refs` と組み合わせた `x-ref` は、DOM 要素に直接簡単にアクセスするための便利なユーティリティです。 これは、`getElementById` や `querySelector` などの API の代わりとして最も役立ちます。

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
