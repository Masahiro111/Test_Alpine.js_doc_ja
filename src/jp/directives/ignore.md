---
order: 11
title: ignore
---

# x-ignore

<!-- By default, Alpine will crawl and initialize the entire DOM tree of an element containing `x-init` or `x-data`. -->

<!-- If for some reason, you don't want Alpine to touch a specific section of your HTML, you can prevent it from doing so using `x-ignore`. -->

デフォルトでは、Alpineは `x-init` または `x-data` を含む要素のDOMツリー全体をクロールして初期化します。

何らかの理由で、Alpine が HTML の特定のセクションに触れないようにする場合は、`x-ignore` を使用してそれを防ぐことができます。

```html
<div x-data="{ label: 'From Alpine' }">
    <div x-ignore>
        <span x-text="label"></span>
    </div>
</div>
```

In the above example, the `<span>` tag will not contain "From Alpine" because we told Alpine to ignore the contents of the `div` completely.

上記の例では、`div` の内容を完全に無視するように Alpine に指示したため、`<span>` タグには"FromAlpine" は含まれません。
