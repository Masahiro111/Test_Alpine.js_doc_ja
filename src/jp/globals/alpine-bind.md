---
order: 3
title: bind()
---

# Alpine.bind

<!-- `Alpine.bind(...)` provides a way to re-use [`x-bind`](/directives/bind#bind-directives) objects within your application. -->

<!-- Here's a simple example. Rather than binding attributes manually with Alpine: -->

`Alpine.bind(...)`は、アプリケーション内で [`x-bind`](/directives/bind#bind-directives)  オブジェクトを再利用する方法を提供します。

これが簡単な例です。 Alpine で属性を手動でバインドするのではなく：

```html
<button type="button" @click="doSomething()" :disabled="shouldDisable"></button>
```

<!-- You can bundle these attributes up into a reusable object and use `x-bind` to bind to that: -->

これらの属性を再利用可能なオブジェクトにバンドルし、`x-bind` を使用してそれにバインドできます。

```html
<button x-bind="SomeButton"></button>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.bind('SomeButton', () => ({
            type: 'button',

            '@click'() {
                this.doSomething()
            },

            ':disabled'() {
                return this.shouldDisable
            },
        }))
    })
</script>
```
