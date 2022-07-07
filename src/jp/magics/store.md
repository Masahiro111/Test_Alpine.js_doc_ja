---
order: 3
prefix: $
title: store
---

# $store

`$store` を使用すると、[`Alpine.store(...)`](/globals/alpine-store) を使用して登録されたグローバル Alpine ストアに簡単にアクセスできます。例えば

<!-- You can use `$store` to conveniently access global Alpine stores registered using [`Alpine.store(...)`](/globals/alpine-store). For example: -->

```html
<button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>

...

<div x-data :class="$store.darkMode.on && 'bg-black'">
    ...
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', {
            on: false,

            toggle() {
                this.on = ! this.on
            }
        })
    })
</script>
```

<!-- Given that we've registered the `darkMode` store and set `on` to "false", when the `<button>` is pressed, `on` will be "true" and the background color of the page will change to black. -->

「darkMode」ストアを登録し、「on」を「false」に設定した場合、`<button>` を押すと、「on」が「true」になり、ページの背景色が黒に変わります。 。


<a name="single-value-stores"></a>

## 単一値ストア

ストアにオブジェクト全体が必要ない場合は、あらゆる種類のデータをストアとして設定して使用できます。

上記の例を次に示しますが、ブール値としてより単純に使用しています。

<!-- If you don't need an entire object for a store, you can set and use any kind of data as a store. -->

<!-- Here's the example from above but using it more simply as a boolean value: -->

```html
<button x-data @click="$store.darkMode = ! $store.darkMode">Toggle Dark Mode</button>

...

<div x-data :class="$store.darkMode && 'bg-black'">
    ...
</div>


<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', false)
    })
</script>
```

[→ Alpine ストアについてもっと読む](/globals/alpine-store)
