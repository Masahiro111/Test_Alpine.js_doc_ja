---
order: 2
title: store()
---

# Alpine.store

<!-- Alpine offers global state management through the `Alpine.store()` API. -->

Alpine は、`Alpine.store()` API を介してグローバルな状態管理を提供します。

<a name="registering-a-store"></a>

## ストアの登録

`alpine:init` リスナー内に Alpine ストアを定義するか（`<script>` タグを介して Alpine を含める場合）、手動で `Alpine.start()` を呼び出す前に定義することができます（ Alpine をビルドにインポートする場合）

<!-- You can either define an Alpine store inside of an `alpine:init` listener (in the case of including Alpine via a `<script>` tag), OR you can define it before manually calling `Alpine.start()` (in the case of importing Alpine into a build): -->

**<script>タグから**
```html
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

**バンドルから**
```js
import Alpine from 'alpinejs'

Alpine.store('darkMode', {
    on: false,

    toggle() {
        this.on = ! this.on
    }
})

Alpine.start()
```

<a name="accessing stores"></a>

## 店舗へのアクセス

`$store` マジックプロパティを使用して、Alpine 式内の任意のストアからデータにアクセスできます。

<!-- You can access data from any store within Alpine expressions using the `$store` magic property: -->

```html
<div x-data :class="$store.darkMode.on && 'bg-black'">...</div>
```

<!-- You can also modify properties within the store and everything that depends on those properties will automatically react. For example: -->

ストア内のプロパティを変更することもでき、それらのプロパティに依存するすべてのものが自動的に反応します。例えば

```html
<button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>
```

<!-- Additionally, you can access a store externally using `Alpine.store()` by omitting the second parameter like so: -->

さらに、次のように2番目のパラメータを省略することで、`Alpine.store()` を使用して外部からストアにアクセスできます。

```html
<script>
    Alpine.store('darkMode').toggle()
</script>
```

<a name="initializing-stores"></a>

## ストアの初期化

Alpine ストアで `init()` メソッドを指定すると、ストアが登録された直後に実行されます。これは、適切な開始値を使用してストア内の状態を初期化する場合に役立ちます。

<!-- If you provide `init()` method in an Alpine store, it will be executed right after the store is registered. This is useful for initializing any state inside the store with sensible starting values. -->

```html
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('darkMode', {
            init() {
                this.on = window.matchMedia('(prefers-color-scheme: dark)').matches
            },

            on: false,

            toggle() {
                this.on = ! this.on
            }
        })
    })
</script>
```

<!-- Notice the newly added `init()` method in the example above. With this addition, the `on` store variable will be set to the browser's color scheme preference before Alpine renders anything on the page. -->

上記の例で新しく追加された `init()` メソッドに注目してください。この追加により、Alpine がページ上に何かをレンダリングする前に、`on` ストア変数がブラウザの配色設定に設定されます。

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
