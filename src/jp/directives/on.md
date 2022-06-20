---
order: 5
title: on
---

# x-on

<!-- `x-on` allows you to easily run code on dispatched DOM events. -->

<!-- Here's an example of simple button that shows an alert when clicked. -->

`x-on` はディスパッチされた (割り当てられた) DOMイベントでコードを簡単に実行できます。

クリックするとアラートを表示するシンプルなボタンの例を次に示します。

```alpine
<button x-on:click="alert('Hello World!')">Say Hi</button>
```

<!-- > `x-on` can only listen for events with lower case names, as HTML attributes are case-insensitive. Writing `x-on:CLICK` will listen for an event named `click`. -->

 <!-- If you need to listen for a custom event with a camelCase name, you can use the [`.camel` helper](#camel) to work around this limitation.  -->
 
 <!-- Alternatively, you can use  [`x-bind`](/directives/bind#bind-directives) to attach an `x-on` directive to an element in javascript code (where case will be preserved). -->

> `x-on`を使用する際は、 HTML 属性で大文字と小文字が区別されないため、小文字のイベントのみをリッスンします。`x-on:CLICK` でしたら、`click` という名前のイベントをリッスンします。

> キャメルケース名のカスタムイベントをリッスンする必要がある場合は、`.camel` ヘルパーを使用してこの制限を回避できます。または、JavaScript コードの要素に `x-on` ディレクティブをアタッチするために `x-bind` を使用できます （大文字と小文字は区別されます）。

<a name="shorthand-syntax"></a>

## 省略構文

<!-- If `x-on:` is too verbose for your tastes, you can use the shorthand syntax: `@`. -->

<!-- Here's the same component as above, but using the shorthand syntax instead: -->


`x-on:` が冗長すぎて好みに合わない場合は、省略構文 `@` を使用できます。

上記と同じコンポーネントですが、代わりに省略構文を使用しています。

```alpine
<button @click="alert('Hello World!')">Say Hi</button>
```

<a name="the-event-object"></a>

## イベントオブジェクト

<!-- If you wish to access the native JavaScript event object from your expression, you can use Alpine's magic `$event` property. -->

式からネイティブ JavaScript イベントオブジェクトにアクセスする場合は、Alpineの魔法の `$event` プロパティを使用できます。

```alpine
<button @click="alert($event.target.getAttribute('message'))" message="Hello World">Say Hi</button>
```

<!-- In addition, Alpine also passes the event object to any methods referenced without trailing parenthesis. For example: -->

さらに、Alpineは、末尾の括弧なしで参照されるメソッドにイベントオブジェクトを渡します。例えば

```alpine
<button @click="handleClick">...</button>

<script>
    function handleClick(e) {
        // Now you can access the event object (e) directly
    }
</script>
```

<a name="keyboard-events"></a>

## キーボードイベント

<!-- Alpine makes it easy to listen for `keydown` and `keyup` events on specific keys. -->

<!-- Here's an example of listening for the `Enter` key inside an input element. -->

Alpine を使用すると、特定のキーの `keydown` および `keyup` イベントを簡単にリッスンできます。

これは、入力要素内で「Enter」キーをリッスンする例です。

```alpine
<input type="text" @keyup.enter="alert('Submitted!')">
```

<!-- You can also chain these key modifiers to achieve more complex listeners. -->

<!-- Here's a listener that runs when the `Shift` key is held and `Enter` is pressed, but not when `Enter` is pressed alone. -->

これらのキー修飾子をチェーンして、より複雑なリスナーを実現することもできます。

これは、`Shift` キーを押したまま、`Enter` キーを押したときに実行されるリスナーですが、単独で `Enter` キーを押したときは実行されません。

```alpine
<input type="text" @keyup.shift.enter="alert('Submitted!')">
```

<!-- You can directly use any valid key names exposed via [`KeyboardEvent.key`](https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/key/Key_Values) as modifiers by converting them to kebab-case. -->

[`KeyboardEvent.key`](https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/key/Key_Values) を介して公開された有効なキー名は、kebab-case に変換することで、修飾子として直接使用できます。

```alpine
<input type="text" @keyup.page-down="alert('Submitted!')">
```

<!-- For easy reference, here is a list of common keys you may want to listen for. -->

一般的にリッスンできるキーのリストです。

| Modifier                   | Keyboard Key                |
| -------------------------- | --------------------------- |
| `.shift`                    | Shift                       |
| `.enter`                    | Enter                       |
| `.space`                    | Space                       |
| `.ctrl`                     | Ctrl                        |
| `.cmd`                      | Cmd                         |
| `.meta`                     | Cmd on Mac, Ctrl on Windows |
| `.alt`                      | Alt                         |
| `.up` `.down` `.left` `.right` | Up/Down/Left/Right arrows   |
| `.escape`                   | Escape                      |
| `.tab`                      | Tab                         |
| `.caps-lock`                | Caps Lock                   |
| `.equal`                    | Equal, `=`                  |
| `.period`                   | Period, `.`                 |
| `.slash`                    | Foward Slash, `/`           |

<a name="custom-events"></a>

## カスタムイベント

<!-- Alpine event listeners are a wrapper for native DOM event listeners. Therefore, they can listen for ANY DOM event, including custom events. -->

<!-- Here's an example of a component that dispatches a custom DOM event and listens for it as well. -->

Alpine のイベントリスナーは、ネイティブDOMイベントリスナーのラッパーです。したがって、カスタムイベントを含むすべてのDOMイベントをリッスンできます。

これは、カスタムDOMイベントをディスパッチし、それもリッスンするコンポーネントの例です。

```alpine
<div x-data @foo="alert('Button Was Clicked!')">
	<button @click="$event.target.dispatchEvent(new CustomEvent('foo', { bubbles: true }))">...</button>
</div>
```

<!-- When the button is clicked, the `@foo` listener will be called. -->

<!-- Because the `.dispatchEvent` API is verbose, Alpine offers a `$dispatch` helper to simplify things. -->

Here's the same component re-written with the `$dispatch` magic property.

ボタンがクリックされると、`@foo` リスナーが呼び出されます。

`.dispatchEventAPI` は冗長であるため、Alpine は `$dispatch`ヘルパーで単純化して提供しています。

$dispatchこれは、 magicプロパティで書き直された同じコンポーネントです。

```alpine
<div x-data @foo="alert('Button Was Clicked!')">
  <button @click="$dispatch('foo')">...</button>
</div>
```

[→ Read more about `$dispatch`](/magics/dispatch)

詳細を読む$dispatch

<a name="modifiers"></a>

## Modifiers

Alpine offers a number of directive modifiers to customize the behavior of your event listeners.

修飾子
Alpineには、イベントリスナーの動作をカスタマイズするためのディレクティブ修飾子がいくつか用意されています。

<a name="prevent"></a>

### .prevent

`.prevent` is the equivalent of calling `.preventDefault()` inside a listener on the browser event object.

.prevent.preventDefault()ブラウザのイベントオブジェクトのリスナー内で呼び出すのと同じです。

```alpine
<form @submit.prevent="console.log('submitted')" action="/foo">
    <button>Submit</button>
</form>
```

In the above example, with the `.prevent`, clicking the button will NOT submit the form to the `/foo` endpoint. Instead, Alpine's listener will handle it and "prevent" the event from being handled any further.

上記の例では、ボタンをクリックしてもフォームはエンドポイント.preventに送信されません。/foo代わりに、Alpineのリスナーがそれを処理し、イベントがそれ以上処理されないようにします。

<a name="stop"></a>

### .stop

Similar to `.prevent`, `.stop` is the equivalent of calling `.stopPropagation()` inside a listener on the browser event object.

と同様に.prevent、ブラウザのイベントオブジェクトのリスナー内.stopで呼び出すのと同じです。.stopPropagation()

```alpine
<div @click="console.log('I will not get logged')">
    <button @click.stop>Click Me</button>
</div>
```

In the above example, clicking the button WON'T log the message. This is because we are stopping the propagation of the event immediately and not allowing it to "bubble" up to the `<div>` with the `@click` listener on it.

上記の例では、ボタンをクリックしてもメッセージはログに記録されません。これは、イベントの伝播をすぐに停止<div>し、@clickリスナーが乗っている状態でイベントが「バブル」することを許可していないためです。

<a name="outside"></a>

### .outside

`.outside` is a convenience helper for listening for a click outside of the element it is attached to. Here's a simple dropdown component example to demonstrate:

.outsideは、アタッチされている要素の外側のクリックをリッスンするための便利なヘルパーです。次に、簡単なドロップダウンコンポーネントの例を示します。

```alpine
<div x-data="{ open: false }">
    <button @click="open = ! open">Toggle</button>

    <div x-show="open" @click.outside="open = false">
        Contents...
    </div>
</div>
```

In the above example, after showing the dropdown contents by clicking the "Toggle" button, you can close the dropdown by clicking anywhere on the page outside the content.

This is because `.outside` is listening for clicks that DON'T originate from the element it's registered on.

上記の例では、[切り替え]ボタンをクリックしてドロップダウンのコンテンツを表示した後、コンテンツの外側のページの任意の場所をクリックしてドロップダウンを閉じることができます。

これは、.outside登録されている要素から発生していないクリックをリッスンしているためです。

> It's worth noting that the `.outside` expression will only be evaluated when the element it's registered on is visible on the page. Otherwise, there would be nasty race conditions where clicking the "Toggle" button would also fire the `@click.outside` handler when it is not visible.

.outside式は、登録されている要素がページに表示されている場合にのみ評価されることに注意してください。そうしないと、「トグル」ボタンをクリックしても@click.outsideハンドラーが表示されていないときにハンドラーが起動するという厄介な競合状態が発生します。

<a name="window"></a>

### .window

When the `.window` modifier is present, Alpine will register the event listener on the root `window` object on the page instead of the element itself.

修飾子が存在する場合、Alpineは、要素自体ではなく、ページ.windowのルートオブジェクトにイベントリスナーを登録します。window

```alpine
<div @keyup.escape.window="...">...</div>
```

The above snippet will listen for the "escape" key to be pressed ANYWHERE on the page.

Adding `.window` to listeners is extremely useful for these sorts of cases where a small part of your markup is concerned with events that take place on the entire page.

上記のスニペットは、ページのどこでも押される「エスケープ」キーをリッスンします。

リスナーへの追加.windowは、マークアップのごく一部がページ全体で発生するイベントに関係しているこのような場合に非常に役立ちます。

<a name="document"></a>

### .document

`.document` works similarly to `.window` only it registers listeners on the `document` global, instead of the `window` global.

.documentグローバルではなく.window、グローバルにリスナーを登録するだけの場合と同様に機能します。documentwindow

<a name="once"></a>

### .once

By adding `.once` to a listener, you are ensuring that the handler is only called ONCE.

リスナーに追加.onceすることで、ハンドラーが1回だけ呼び出されるようになります。

```alpine
<button @click.once="console.log('I will only log once')">...</button>
```

<a name="debounce"></a>

### .debounce

Sometimes it is useful to "debounce" an event handler so that it only is called after a certain period of inactivity (250 milliseconds by default).

For example if you have a search field that fires network requests as the user types into it, adding a debounce will prevent the network requests from firing on every single keystroke.

イベントハンドラーを「デバウンス」して、特定の非アクティブ期間（デフォルトでは250ミリ秒）の後にのみ呼び出されるようにすると便利な場合があります。

たとえば、ユーザーが入力したときにネットワークリクエストを発生させる検索フィールドがある場合、デバウンスを追加すると、キーストロークごとにネットワークリクエストが発生するのを防ぐことができます。


```alpine
<input @input.debounce="fetchResults">
```

Now, instead of calling `fetchResults` after every keystroke, `fetchResults` will only be called after 250 milliseconds of no keystrokes.

If you wish to lengthen or shorten the debounce time, you can do so by trailing a duration after the `.debounce` modifier like so:

fetchResultsこれで、すべてのキーストロークの後に呼び出す代わりに、fetchResults250ミリ秒のキーストロークがない場合にのみ呼び出されます。

デバウンス時間を長くしたり短くしたりする場合は、次の.debounceように修飾子の後に継続時間を追跡することでこれを行うことができます。

```alpine
<input @input.debounce.500ms="fetchResults">
```

Now, `fetchResults` will only be called after 500 milliseconds of inactivity.

これで、fetchResults500ミリ秒の非アクティブの後にのみ呼び出されます。

<a name="throttle"></a>

### .throttle

`.throttle` is similar to `.debounce` except it will release a handler call every 250 milliseconds instead of deferring it indefinitely.

This is useful for cases where there may be repeated and prolonged event firing and using `.debounce` won't work because you want to still handle the event every so often.

.throttle.debounceは、無期限に延期するのではなく、250ミリ秒ごとにハンドラー呼び出しを解放することを除いて、に似ています。

これは、イベントの発生が繰り返されて長時間発生する可能性があり、イベントを頻繁に処理する必要があるために使用が機能しない場合に役立ち.debounceます。

For example:

```alpine
<div @scroll.window.throttle="handleScroll">...</div>
```

The above example is a great use case of throttling. Without `.throttle`, the `handleScroll` method would be fired hundreds of times as the user scrolls down a page. This can really slow down a site. By adding `.throttle`, we are ensuring that `handleScroll` only gets called every 250 milliseconds.

> Fun Fact: This exact strategy is used on this very documentation site to update the currently highlighted section in the right sidebar.

Just like with `.debounce`, you can add a custom duration to your throttled event:

上記の例は、スロットルの優れたユースケースです。がない.throttleと、handleScrollユーザーがページを下にスクロールするときにメソッドが何百回も起動されます。これにより、サイトの速度が大幅に低下する可能性があります。を追加すること.throttleで、handleScroll250ミリ秒ごとにのみ呼び出されるようにしています。

おもしろ情報：この正確な戦略は、まさにこのドキュメントサイトで使用され、右側のサイドバーで現在強調表示されているセクションを更新します。

と同様に.debounce、スロットルされたイベントにカスタム期間を追加できます。


```alpine
<div @scroll.window.throttle.750ms="handleScroll">...</div>
```

Now, `handleScroll` will only be called every 750 milliseconds.

現在、handleScroll750ミリ秒ごとにのみ呼び出されます。

<a name="self"></a>

### .self

By adding `.self` to an event listener, you are ensuring that the event originated on the element it is declared on, and not from a child element.

イベントリスナーに追加.selfすることで、イベントが子要素からではなく、宣言された要素から発生したことを確認できます。

```alpine
<button @click.self="handleClick">
    Click Me

    <img src="...">
</button>
```

In the above example, we have an `<img>` tag inside the `<button>` tag. Normally, any click originating within the `<button>` element (like on `<img>` for example), would be picked up by a `@click` listener on the button.

However, in this case, because we've added a `.self`, only clicking the button itself will call `handleClick`. Only clicks originating on the `<img>` element will not be handled.

上記の例では、<img>タグ内に<button>タグがあります。通常、<button>要素内で発生したクリック（たとえばのように）は、ボタンのリスナー<img>によってピックアップされます。@click

ただし、この場合、を追加したため.self、ボタン自体をクリックするだけで。が呼び出されますhandleClick。要素で発生したクリックのみが<img>処理されません。

<a name="camel"></a>

### .camel

```alpine
<div @custom-event.camel="handleCustomEvent">
    ...
</div>
```

Sometimes you may want to listen for camelCased events such as `customEvent` in our example. Because camelCasing inside HTML attributes is not supported, adding the `.camel` modifier is necessary for Alpine to camelCase the event name internally.

By adding `.camel` in the above example, Alpine is now listening for `customEvent` instead of `custom-event`.

この例のように、キャメルケースのイベントを聞きたい場合がありますcustomEvent。HTML属性内のcamelCasingはサポートされていない.camelため、Alpineがイベント名を内部でcamelCaseにするには、修飾子を追加する必要があります。

上記の例を追加する.camelと、AlpineはのcustomEvent代わりにリッスンしcustom-eventます。

<a name="dot"></a>

### .dot

```alpine
<div @custom-event.dot="handleCustomEvent">
    ...
</div>
```

Similar to the `.camelCase` modifier there may be situations where you want to listen for events that have dots in their name (like `custom.event`). Since dots within the event name are reserved by Alpine you need to write them with dashes and add the `.dot` modifier.

In the code example above `custom-event.dot` will correspond to the event name `custom.event`.

修飾子と同様に.camelCase、名前にドットが含まれているイベント（など）をリッスンしたい場合がありますcustom.event。イベント名内のドットはAlpineによって予約されているため、ダッシュを使用してドットを記述し、.dot修飾子を追加する必要があります。

上記のコード例custom-event.dotでは、イベント名に対応しcustom.eventます。

<a name="passive"></a>

### .passive

Browsers optimize scrolling on pages to be fast and smooth even when JavaScript is being executed on the page. However, improperly implemented touch and wheel listeners can block this optimization and cause poor site performance.

If you are listening for touch events, it's important to add `.passive` to your listeners to not block scroll performance.

ブラウザは、JavaScriptがページで実行されている場合でも、ページのスクロールを高速かつスムーズに最適化します。ただし、不適切に実装されたタッチおよびホイールリスナーは、この最適化をブロックし、サイトのパフォーマンスを低下させる可能性があります。

タッチイベントをリッスンしている場合は、.passiveスクロールのパフォーマンスを妨げないようにリスナーに追加することが重要です。

```alpine
<div @touchstart.passive="...">...</div>
```

[→ Read more about passive listeners](https://developer.mozilla.org/en-US/docs/Web/API/EventTarget/addEventListener#improving_scrolling_performance_with_passive_listeners)

パッシブリスナーについてもっと読む