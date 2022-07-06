---
order: 5
title: dispatch
---

# $dispatch

<!-- `$dispatch` is a helpful shortcut for dispatching browser events. -->

`$dispatch` は、ブラウザイベントをディスパッチするための便利なショートカットです。

```html
<div @notify="alert('Hello World!')">
    <button @click="$dispatch('notify')">
        Notify
    </button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data @notify="alert('Hello World!')">
        <button @click="$dispatch('notify')">
            Notify
        </button>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- You can also pass data along with the dispatched event if you wish. This data will be accessible as the `.detail` property of the event: -->

必要に応じて、ディスパッチされたイベントと一緒にデータを渡すこともできます。 このデータには、イベントの `.detail` プロパティとしてアクセスできます。

```html
<div @notify="alert($event.detail.message)">
    <button @click="$dispatch('notify', { message: 'Hello World!' })">
        Notify
    </button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data @notify="alert($event.detail.message)">
        <button @click="$dispatch('notify', { message: 'Hello World!' })">Notify</button>
    </div>
</div>
<!-- END_VERBATIM -->
```

Under the hood, `$dispatch` is a wrapper for the more verbose API: `element.dispatchEvent(new CustomEvent(...))`

内部的には、 `$dispatch` はより詳細な API のラッパーです：`element.dispatchEvent(new CustomEvent(...))`

<!-- **Note on event propagation** -->

**イベントの伝播に関する注意**

Notice that, because of [event bubbling](https://en.wikipedia.org/wiki/Event_bubbling), when you need to capture events dispatched from nodes that are under the same nesting hierarchy, you'll need to use the [`.window`](https://github.com/alpinejs/alpine#x-on) modifier:

**Example:**

```html
<!-- 🚫 Won't work -->
<div x-data>
    <span @notify="..."></span>
    <button @click="$dispatch('notify')">Notify</button>
</div>

<!-- ✅ Will work (because of .window) -->
<div x-data>
    <span @notify.window="..."></span>
    <button @click="$dispatch('notify')">Notify</button>
</div>
```

> The first example won't work because when `custom-event` is dispatched, it'll propagate to its common ancestor, the `div`, not its sibling, the `<span>`. The second example will work because the sibling is listening for `notify` at the `window` level, which the custom event will eventually bubble up to.

>最初の例は機能しません。これは、 `custom-event`がディスパッチされると、その兄弟である`<span>`ではなく共通の祖先である`div`に伝播するためです。 2番目の例は、兄弟が`window`レベルで`notify`をリッスンしているために機能します。これは、カスタムイベントが最終的にバブルアップします。

<a name="dispatching-to-components"></a>

## Dispatching to other components

You can also take advantage of the previous technique to make your components talk to each other:

他のコンポーネントへのディスパッチ

前の手法を利用して、コンポーネントを相互に通信させることもできます。

**Example:**

```html
<div
    x-data="{ title: 'Hello' }"
    @set-title.window="title = $event.detail"
>
    <h1 x-text="title"></h1>
</div>

<div x-data>
    <button @click="$dispatch('set-title', 'Hello World!')">Click me</button>
</div>
<!-- When clicked, the content of the h1 will set to "Hello World!". -->
```

<a name="dispatching-to-x-model"></a>

## x-model へのディスパッチ

You can also use `$dispatch()` to trigger data updates for `x-model` data bindings. For example:

`$dispatch()`を使用して、`x-model` データバインディングのデータ更新をトリガーすることもできます。例えば：

```html
<div x-data="{ title: 'Hello' }">
    <span x-model="title">
        <button @click="$dispatch('input', 'Hello World!')">Click me</button>
        <!-- After the button is pressed, `x-model` will catch the bubbling "input" event, and update title. -->
    </span>
</div>
```

<!-- This opens up the door for making custom input components whose value can be set via `x-model`. -->

これにより、`x-model` を介して値を設定できるカスタム入力コンポーネントを作成することができます。