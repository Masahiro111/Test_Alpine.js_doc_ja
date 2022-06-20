---
order: 7
title: html
---

# x-html

<!-- `x-html` sets the "innerHTML" property of an element to the result of a given expression. -->

<!-- > ⚠️ Only use on trusted content and never on user-provided content. ⚠️ -->
<!-- > Dynamically rendering HTML from third parties can easily lead to XSS vulnerabilities. -->

<!-- Here's a basic example of using `x-html` to display a user's username. -->

`x-html` は、要素の「 innerHTML 」プロパティを指定された式の結果に設定します。

> ⚠️ 信頼できるコンテンツにのみ使用し、ユーザー提供のコンテンツには使用しないでください。⚠️

> サードパーティから HTML を動的にレンダリングすると、XSS の脆弱性が簡単に発生する可能性があります。

`x-html` を使用してユーザーのユーザー名を表示する基本的な例を次に示します。

```html
<div x-data="{ username: '<strong>calebporzio</strong>' }">
    Username: <span x-html="username"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ username: '<strong>calebporzio</strong>' }">
        Username: <span x-html="username"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now the `<span>` tag's inner HTML will be set to "<strong>calebporzio</strong>". -->

これで、`<span>`タグの内部HTMLが「<strong>calebporzio</strong>」に設定されます。
