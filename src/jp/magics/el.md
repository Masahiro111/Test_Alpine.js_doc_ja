---
order: 1
prefix: $
title: el
---

# $el

`$el` is a magic property that can be used to retrieve the current DOM node.

`$ el`は、現在のDOMノードを取得するために使用できる魔法のプロパティです。

```alpine
<button @click="$el.innerHTML = 'Hello World!'">Replace me with "Hello World!"</button>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data>
        <button @click="$el.textContent = 'Hello World!'">Replace me with "Hello World!"</button>
    </div>
</div>
<!-- END_VERBATIM -->
```