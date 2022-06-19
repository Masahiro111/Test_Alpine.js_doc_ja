---
order: 4
title: bind
---

# x-bind

<!-- `x-bind` allows you to set HTML attributes on elements based on the result of JavaScript expressions.

For example, here's a component where we will use `x-bind` to set the placeholder value of an input. -->

`x-bind` を使用すると、JavaScript 式の結果に基づいて要素にHTML属性を設定できます。

たとえば、これは、`x-bind`を使用して入力のプレースホルダー値を設定するコンポーネントです。

```alpine
<div x-data="{ placeholder: 'Type here...' }">
  <input type="text" x-bind:placeholder="placeholder">
</div>
```

<a name="shorthand-syntax"></a>

## 省略構文

<!-- If `x-bind:` is too verbose for your liking, you can use the shorthand: `:`. For example, here is the same input element as above, but refactored to use the shorthand syntax. -->

`x-bind：`が冗長すぎて好みに合わない場合は、省略形 `：` を使用できます。たとえば、これは上記と同じ入力要素ですが、短縮構文を使用するようにリファクタリングされています。

```alpine
<input type="text" :placeholder="placeholder">
```

<a name="binding-classes"></a>

## バインディングクラス

<!-- `x-bind` is most often useful for setting specific classes on an element based on your Alpine state.

Here's a simple example of a simple dropdown toggle, but instead of using `x-show`, we'll use a "hidden" class to toggle an element. -->

`x-bind` は、Alpineの状態に基づいて要素に特定のクラスを設定する場合に最もよく役立ちます。

これは単純なドロップダウントグルの簡単な例ですが、`x-show`を使用する代わりに、「hidden」クラスを使用して要素をトグルします。

```alpine
<div x-data="{ open: false }">
  <button x-on:click="open = ! open">Toggle Dropdown</button>

  <div :class="open ? '' : 'hidden'">
    Dropdown Contents...
  </div>
</div>
```

<!-- Now, when `open` is `false`, the "hidden" class will be added to the dropdown. -->

これで、`open`が `false` の場合、「非表示」クラスがドロップダウンに追加されます。

<a name="shorthand-conditionals"></a>

### 省略形の条件

<!-- In cases like these, if you prefer a less verbose syntax you can use JavaScript's short-circuit evaluation instead of standard conditionals: -->

このような場合、より冗長でない構文が必要な場合は、標準の条件の代わりにJavaScriptの短絡評価を使用できます。

```alpine
<div :class="show ? '' : 'hidden'">
<!-- Is equivalent to: -->
<div :class="show || 'hidden'">
```

<!-- The inverse is also available to you. Suppose instead of `open`, we use a variable with the opposite value: `closed`. -->

逆も利用できます。`open` の代わりに、反対の値を持つ変数 `closed` を使用するとします。

```alpine
<div :class="closed ? 'hidden' : ''">
<!-- Is equivalent to: -->
<div :class="closed && 'hidden'">
```

<a name="class-object-syntax"></a>

### クラスオブジェクト構文

<!-- Alpine offers an additional syntax for toggling classes if you prefer. By passing a JavaScript object where the classes are the keys and booleans are the values, Alpine will know which classes to apply and which to remove. For example: -->

Alpine は、必要に応じてクラスを切り替えるための追加の構文を提供します。クラスがキーでブール値が値である JavaScript オブジェクトを渡すことにより、Alpine は、適用するクラスと削除するクラスを認識します。以下のような例となります。

```alpine
<div :class="{ 'hidden': ! show }">
```

<!-- This technique offers a unique advantage to other methods. When using object-syntax, Alpine will NOT preserve original classes applied to an element's `class` attribute. -->

<!-- For example, if you wanted to apply the "hidden" class to an element before Alpine loads, AND use Alpine to toggle its existence you can only achieve that behavior using object-syntax: -->

この手法は、他の方法に固有の利点を提供します。 `object-syntax` を使用する場合、Alpine は要素の`class`属性に適用された元のクラスを保持しません。

たとえば、Alpine が読み込まれる前に「hidden」クラスを要素に適用し、Alpine を使用してその存在を切り替える場合、`object-syntax` を使用してのみその動作を実現できます。

```alpine
<div class="hidden" :class="{ 'hidden': ! show }">
```

<!-- In case that confused you, let's dig deeper into how Alpine handles `x-bind:class` differently than other attributes. -->

混乱した場合に備えて、Alpine が他の属性とは異なる方法で `x-bind:class`を処理する方法を詳しく見ていきましょう。

<a name="special-behavior"></a>

### 特別な振る舞い

<!-- `x-bind:class` behaves differently than other attributes under the hood. -->

<!-- Consider the following case. -->

`x-bind:class` は、内部で他の属性とは異なる動作をします。

次の場合を考えてみましょう。

```alpine
<div class="opacity-50" :class="hide && 'hidden'">
```

<!-- If "class" were any other attribute, the `:class` binding would overwrite any existing class attribute, causing `opacity-50` to be overwritten by either `hidden` or `''`. -->

<!-- However, Alpine treats `class` bindings differently. It's smart enough to preserve existing classes on an element. -->

<!-- For example, if `hide` is true, the above example will result in the following DOM element: -->

「class」が他の属性である場合、`:class` バインディングは既存のクラス属性を上書きし、`opacity-50` を `hidden` または `''` で上書きします。

ただし、Alpine は `class` バインディングを異なる方法で処理します。要素の既存のクラスを保持するのに役立ちます。

たとえば、`hide` が true の場合、上記の例は次のDOM要素になります。

```alpine
<div class="opacity-50 hidden">
```

If `hide` is false, the DOM element will look like:

`hide` が `false` の場合、DOM要素は次のようになります。

```alpine
<div class="opacity-50">
```

<!-- This behavior should be invisible and intuitive to most users, but it is worth mentioning explicitly for the inquiring developer or any special cases that might crop up. -->

この動作は、ほとんどのユーザーには見えず、直感的である必要がありますが、問い合わせを行う開発者や、発生する可能性のある特殊なケースについては、明示的に言及する価値があります。

<a name="binding-styles"></a>

## CSS スタイルを結合する

<!-- Similar to the special syntax for binding classes with JavaScript objects, Alpine also offers an object-based syntax for binding `style` attributes. -->

<!-- Just like the class objects, this syntax is entirely optional. Only use it if it affords you some advantage. -->

クラスを JavaScript オブジェクトにバインドするための特別な構文と同様に、Alpine は `style` 属性をバインドするためのオブジェクトベースの構文も提供します。

クラスオブジェクトと同様に、この構文は完全にオプションです。それがあなたにいくらかの利点を与える場合にのみそれを使用してください。

```alpine
<div :style="{ color: 'red', display: 'flex' }">

<!-- Will render: -->
<div style="color: red; display: flex;" ...>
```

<!-- Conditional inline styling is possible using expressions just like with x-bind:class. Short circuit operators can be used here as well by using a styles object as the second operand. -->

`x-bind:class` と同じように、式を使用して条件付きインラインスタイルを設定できます。ここでも、スタイルオブジェクトを第2引数として使用することにより、短絡演算子を使用できます。

```alpine
<div x-bind:style="true && { color: 'red' }">

<!-- Will render: -->
<div style="color: red;">
```

<!-- One advantage of this approach is being able to mix it in with existing styles on an element: -->

このアプローチの利点の1つは、要素の既存のスタイルと組み合わせることができることです。

```alpine
<div style="padding: 1rem;" :style="{ color: 'red', display: 'flex' }">

<!-- Will render: -->
<div style="padding: 1rem; color: red; display: flex;" ...>
```

<!-- And like most expressions in Alpine, you can always use the result of a JavaScript expression as the reference: -->

また、Alpine のほとんどの式と同様に、JavaScript 式の結果をいつでも参照として使用できます。

```alpine
<div x-data="{ styles: { color: 'red', display: 'flex' }}">
    <div :style="styles">
</div>

<!-- Will render: -->
<div ...>
    <div style="color: red; display: flex;" ...>
</div>
```

<a name="bind-directives"></a>

## Alpine ディレクティブを直接結合する

<!-- `x-bind` allows you to bind an object of different directives and attributes to an element. -->

<!-- The object keys can be anything you would normally write as an attribute name in Alpine. This includes Alpine directives and modifiers, but also plain HTML attributes. The object values are either plain strings, or in the case of dynamic Alpine directives, callbacks to be evaluated by Alpine. -->

`x-bind` を使用すると、さまざまなディレクティブと属性のオブジェクトを要素にバインドできます。

オブジェクトキーは、Alpine で属性名として通常書き込むものであれば何でもかまいません。これには、Alpine ディレクティブと修飾子だけでなく、プレーン HTML 属性も含まれます。オブジェクト値はプレーン文字列であるか、動的な Alpine ディレクティブの場合は、Alpine によって評価されるコールバックです。

```alpine
<div x-data="dropdown()">
    <button x-bind="trigger">Open Dropdown</button>

    <span x-bind="dialogue">Dropdown Contents</span>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,

            trigger: {
                ['x-ref']: 'trigger',
                ['@click']() {
                    this.open = true
                },
            },

            dialogue: {
                ['x-show']() {
                    return this.open
                },
                ['@click.outside']() {
                    this.open = false
                },
            },
        }))
    })
</script>
```

<!-- There are a couple of caveats to this usage of `x-bind`: -->

<!-- > When the directive being "bound" or "applied" is `x-for`, you should return a normal expression string from the callback. For example: `['x-for']() { return 'item in items' }` -->

この `x-bind` の使用法にはいくつかの注意点があります。

> 「バインド (bound)」または「適用 (applied)」されているディレクティブがの `x-for` 場合、コールバックから通常の式の文字列を返す必要があります。（ 例えば `['x-for']() { return 'item in items' }` ）