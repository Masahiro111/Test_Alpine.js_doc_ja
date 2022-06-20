---
order: 6
title: text
---

# x-text

<!-- `x-text` sets the text content of an element to the result of a given expression. -->

<!-- Here's a basic example of using `x-text` to display a user's username. -->

`x-text`は、要素のテキストコンテンツを特定の式の結果に設定します。

`x-text`を使用してユーザーのユーザー名を表示する基本的な例を次に示します。

```alpine
<div x-data="{ username: 'calebporzio' }">
    Username: <strong x-text="username"></strong>
</div>
```

<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ username: 'calebporzio' }">
        Username: <strong x-text="username"></strong>
    </div>
</div>
<!-- END_VERBATIM -->

<!-- Now the `<strong>` tag's inner text content will be set to "calebporzio". -->

これで、`<strong>` タグの内部テキストコンテンツが「calebporzio」に設定されます。