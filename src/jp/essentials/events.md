---
order: 4
title: Events
---

# イベント

<!-- Alpine makes it simple to listen for browser events and react to them. -->

Alpine を使用すると、ブラウザのイベントを簡単にリッスンして対応できます。

<a name="listening-for-simple-events"></a>

## 簡単なイベントを聞く

`x-on` を使用すると、要素上または要素内でディスパッチされるブラウザイベントをリッスンできます。

ボタンのクリックをリッスンする基本的な例を次に示します。

<!-- By using `x-on`, you can listen for browser events that are dispatched on or within an element. -->

<!-- Here's a basic example of listening for a click on a button: -->

```html
<button x-on:click="console.log('clicked')">...</button>
```

<!-- As an alternative, you can use the event shorthand syntax if you prefer: `@`. Here's the same example as before, but using the shorthand syntax (which we'll be using from now on): -->

別の方法として、必要に応じてイベントの省略構文を使用できます：`@`。これは前と同じ例ですが、省略構文（これから使用します）を使用します。

```html
<button @click="...">...</button>
```

In addition to `click`, you can listen for any browser event by name. For example: `@mouseenter`, `@keyup`, etc... are all valid syntax.

「クリック」に加えて、名前で任意のブラウザイベントをリッスンできます。例：`@mouseenter`、`@keyup` などはすべて有効な構文です。

<a name="listening-for-specific-keys"></a>

## 特定のキーをリッスンする

<!-- Let's say you wanted to listen for the `enter` key to be pressed inside an `<input>` element. Alpine makes this easy by adding the `.enter` like so: -->

`<input>` 要素内で押される `enter` キーをリッスンしたいとします。 Alpine は、次のように `.enter` を追加することで、これを簡単にします。

```html
<input @keyup.enter="...">
```

<!-- You can even combine key modifiers to listen for key combinations like pressing `enter` while holding `shift`: -->

キー修飾子を組み合わせて、`shift` を押しながら `Enter` を押すなどのキーの組み合わせをリッスンすることもできます。

```html
<input @keyup.shift.enter="...">
```

<a name="preventing-default"></a>

## デフォルトの防止

ブラウザイベントに対応する場合、多くの場合、「デフォルトを防止する」（ブラウザイベントのデフォルトの動作を防止する）必要があります。

たとえば、フォームの送信をリッスンしたいが、ブラウザがフォームリクエストを送信できないようにする場合は、`.prevent` を使用できます。

<!-- When reacting to browser events, it is often necessary to "prevent default" (prevent the default behavior of the browser event). -->

<!-- For example, if you want to listen for a form submission but prevent the browser from submitting a form request, you can use `.prevent`: -->

```html
<form @submit.prevent="...">...</form>
```

<!-- You can also apply `.stop` to achieve the equivalent of `event.stopPropagation()`. -->

`.stop` を適用して、`event.stopPropagation()` と同等のものを実現することもできます。

<a name="accessing-the-event-object"></a>

## イベントオブジェクトへのアクセス

独自のコード内でネイティブブラウザイベントオブジェクトにアクセスしたい場合があります。これを簡単にするために、Alpine は自動的に `$event` マジック変数を挿入します。

<!-- Sometimes you may want to access the native browser event object inside your own code. To make this easy, Alpine automatically injects an `$event` magic variable: -->

```html
<button @click="$event.target.remove()">Remove Me</button>
```

<a name="dispatching-custom-events"></a>

## カスタムイベントのディスパッチ

ブラウザイベントをリッスンするだけでなく、それらをディスパッチすることもできます。これは、他の Alpine コンポーネントと通信したり、Alpine 自体の外部のツールでイベントをトリガーしたりする場合に非常に役立ちます。

Alpine は、このために `$dispatch` と呼ばれる魔法のヘルパーを公開しています。

<!-- In addition to listening for browser events, you can dispatch them as well. This is extremely useful for communicating with other Alpine components or triggering events in tools outside of Alpine itself. -->

<!-- Alpine exposes a magic helper called `$dispatch` for this: -->

```html
<div @foo="console.log('foo was dispatched')">
    <button @click="$dispatch('foo')"></button>
</div>
```

<!-- As you can see, when the button is clicked, Alpine will dispatch a browser event called "foo", and our `@foo` listener on the `<div>` will pick it up and react to it. -->

ご覧のとおり、ボタンがクリックされると、Alpine は「foo」というブラウザイベントをディスパッチし、`<div>` の `@foo` リスナーがそれを取得して反応します。

<a name="listening-for-events-on-window"></a>

## ウィンドウでイベントをリッスンする

ブラウザのイベントの性質上、トップレベルのウィンドウオブジェクトでイベントをリッスンすると便利な場合があります。

これにより、次の例のように、コンポーネント間で完全に通信できます。


<!-- Because of the nature of events in the browser, it is sometimes useful to listen to events on the top-level window object. -->

<!-- This allows you to communicate across components completely like the following example: -->


```html
<div x-data>
    <button @click="$dispatch('foo')"></button>
</div>

<div x-data @foo.window="console.log('foo was dispatched')">...</div>
```

<!-- In the above example, if we click the button in the first component, Alpine will dispatch the "foo" event. Because of the way events work in the browser, they "bubble" up through parent elements all the way to the top-level "window". -->

<!-- Now, because in our second component we are listening for "foo" on the window (with `.window`), when the button is clicked, this listener will pick it up and log the "foo was dispatched" message. -->

上記の例では、最初のコンポーネントのボタンをクリックすると、Alpine は「foo」イベントをディスパッチします。ブラウザでのイベントの動作方法により、イベントは親要素を介してトップレベルの「ウィンドウ」まで「バブル」します。

ここで、2番目のコンポーネントで（ `.window`を使用して）ウィンドウで「foo」をリッスンしているため、ボタンがクリックされると、このリスナーはそれを取得し、「fooがディスパッチされました」メッセージをログに記録します。

[→ x-on についてもっと読む](/directives/on)
