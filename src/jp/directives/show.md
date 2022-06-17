---
order: 3
title: show
---

# x-show

`x-show` is one of the most useful and powerful directives in Alpine. It provides an expressive way to show and hide DOM elements.

Here's an example of a simple dropdown component using `x-show`.

x-showAlpineで最も便利で強力なディレクティブの1つです。DOM要素を表示および非表示にする表現力豊かな方法を提供します。

を使用した単純なドロップダウンコンポーネントの例を次に示しますx-show。

```alpine
<div x-data="{ open: false }">
    <button x-on:click="open = ! open">Toggle Dropdown</button>

    <div x-show="open">
        Dropdown Contents...
    </div>
</div>
```

When the "Toggle Dropdown" button is clicked, the dropdown will show and hide accordingly.

> If the "default" state of an `x-show` on page load is "false", you may want to use `x-cloak` on the page to avoid "page flicker" (The effect that happens when the browser renders your content before Alpine is finished initializing and hiding it.) You can learn more about `x-cloak` in its documentation.

[ドロップダウンの切り替え]ボタンをクリックすると、それに応じてドロップダウンが表示および非表示になります。

x-showページの読み込みの「デフォルト」状態が「false」の場合x-cloak、「ページのちらつき」（Alpineがコンテンツの初期化と非表示を完了する前にブラウザがコンテンツをレンダリングするときに発生する効果）を回避するために、ページで使用することをお勧めします。 ）詳細についてx-cloakは、そのドキュメントをご覧ください。

<a name="with-transitions"></a>
## With transitions トランジション付き

If you want to apply smooth transitions to the `x-show` behavior, you can use it in conjunction with `x-transition`. You can learn more about that directive [here](/directives/transition), but here's a quick example of the same component as above, just with transitions applied.

動作にスムーズな遷移を適用する場合はx-show、と組み合わせて使用​​できますx-transition。このディレクティブの詳細については、ここを参照してください。ただし、トランジションを適用した、上記と同じコンポーネントの簡単な例を次に示します。

```alpine
<div x-data="{ open: false }">
    <button x-on:click="open = ! open">Toggle Dropdown</button>

    <div x-show="open" x-transition>
        Dropdown Contents...
    </div>
</div>
```
