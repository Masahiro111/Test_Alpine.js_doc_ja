---
order: 17
title: id
---

# x-id

<!-- `x-id` allows you to declare a new "scope" for any new IDs generated using `$id()`. It accepts an array of strings (ID names) and adds a suffix to each `$id('...')` generated within it that is unique to other IDs on the page. -->

<!-- `x-id` is meant to be used in conjunction with the `$id(...)` magic. -->

<!-- [Visit the $id documentation](/magics/id) for a better understanding of this feature. -->

<!-- Here's a brief example of this directive in use: -->

`x-id` を使用すると、`$id()` を使用して生成された新しい ID の新しい「スコープ」を宣言できます。 文字列（ID名）の配列を受け入れ、その中で生成された各 `$ id('...')`に、ページ上の他の ID に固有の接尾辞を追加します。

`x-id` は、`$id(...)`マジックと組み合わせて使用することを目的としています。

この機能の理解を深めるには、[$id のドキュメントにアクセスしてください](/magics/id)。

使用中のこのディレクティブの簡単な例を次に示します。

```html
<div x-id="['text-input']">
    <label :for="$id('text-input')">Username</label>
    <!-- for="text-input-1" -->

    <input type="text" :id="$id('text-input')">
    <!-- id="text-input-1" -->
</div>

<div x-id="['text-input']">
    <label :for="$id('text-input')">Username</label>
    <!-- for="text-input-2" -->

    <input type="text" :id="$id('text-input')">
    <!-- id="text-input-2" -->
</div>
```


