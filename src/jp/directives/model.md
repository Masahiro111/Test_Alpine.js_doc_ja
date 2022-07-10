---
order: 7
title: model
---

# x-model

<!-- `x-model` allows you to bind the value of an input element to Alpine data. -->

<!-- Here's a simple example of using `x-model` to bind the value of a text field to a piece of data in Alpine. -->

`x-model`を使用すると、入力要素の値を Alpineの データにバインドできます。

これは、`x-model` を使用してテキストフィールドの値をAlpine のデータにバインドする簡単な例です。

```html
<div x-data="{ message: '' }">
    <input type="text" x-model="message">

    <span x-text="message">
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <input type="text" x-model="message" placeholder="Type message...">

        <div class="pt-4" x-text="message"></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now as the user types into the text field, the `message` will be reflected in the `<span>` tag. -->

<!-- `x-model` is two-way bound, meaning it both "sets" and "gets". In addition to changing data, if the data itself changes, the element will reflect the change. -->

<!-- We can use the same example as above but this time, we'll add a button to change the value of the `message` property. -->

これで、ユーザーがテキストフィールドに入力すると、`message` プロパティの値が `<span>` タグに反映されます。

`x-model` は双方向にバインドされており、「sets (入力)」と「gets (取得)」の両方を意味します。 データの変更に加えて、データ自体が変更された場合、要素は変更を反映します。

上記と同じ例を使用できますが、今回は、`message` プロパティの値を変更するためのボタンを追加します。

```html
<div x-data="{ message: '' }">
    <input type="text" x-model="message">

    <button x-on:click="message = 'changed'">Change Message</button>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <input type="text" x-model="message" placeholder="Type message...">

        <button x-on:click="message = 'changed'">Change Message</button>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- Now when the `<button>` is clicked, the input element's value will instantly be updated to "changed". -->

<!-- `x-model` works with the following input elements: -->

これで、 `<button>` をクリックすると、入力要素の値がすぐに「changed」に更新されます。

`x-model` は、次の入力要素で機能します。

* `<input type="text">`
* `<textarea>`
* `<input type="checkbox">`
* `<input type="radio">`
* `<select>`

<a name="text-inputs"></a>

## テキストの入力

```html
<input type="text" x-model="message">

<span x-text="message"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <input type="text" x-model="message" placeholder="Type message">

        <div class="pt-4" x-text="message"></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="textarea-inputs"></a>

## テキストエリアの入力

```html
<textarea x-model="message"></textarea>

<span x-text="message"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: '' }">
        <textarea x-model="message" placeholder="Type message"></textarea>

        <div class="pt-4" x-text="message"></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="checkbox-inputs"></a>

## チェックボックスの入力

<a name="single-checkbox-with-boolean"></a>

### ブール値を含む単一のチェックボックス

```html
<input type="checkbox" id="checkbox" x-model="show">

<label for="checkbox" x-text="show"></label>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ open: '' }">
        <input type="checkbox" id="checkbox" x-model="open">

        <label for="checkbox" x-text="open"></label>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="multiple-checkboxes-bound-to-array"></a>

### 配列にバインドされた複数のチェックボックス

```html
<input type="checkbox" value="red" x-model="colors">
<input type="checkbox" value="orange" x-model="colors">
<input type="checkbox" value="yellow" x-model="colors">

Colors: <span x-text="colors"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ colors: [] }">
        <input type="checkbox" value="red" x-model="colors">
        <input type="checkbox" value="orange" x-model="colors">
        <input type="checkbox" value="yellow" x-model="colors">

        <div class="pt-4">Colors: <span x-text="colors"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="radio-inputs"></a>

## ラジオボタンの入力

```html
<input type="radio" value="yes" x-model="answer">
<input type="radio" value="no" x-model="answer">

Answer: <span x-text="answer"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ answer: '' }">
        <input type="radio" value="yes" x-model="answer">
        <input type="radio" value="no" x-model="answer">

        <div class="pt-4">Answer: <span x-text="answer"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="select-inputs"></a>

## 単一のインプット


<a name="single-select"></a>

### 単一のセレクトボックス

```html
<select x-model="color">
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>

Color: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color">
            <option>Red</option>
            <option>Orange</option>
            <option>Yellow</option>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="single-select-with-placeholder"></a>

### プレースホルダー付きの単一選択

```html
<select x-model="color">
    <option value="" disabled>Select A Color</option>
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>

Color: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color">
            <option value="" disabled>Select A Color</option>
            <option>Red</option>
            <option>Orange</option>
            <option>Yellow</option>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="multiple-select"></a>

### 複数選択のセレクトボックス

```html
<select x-model="color" multiple>
    <option>Red</option>
    <option>Orange</option>
    <option>Yellow</option>
</select>

Colors: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color" multiple>
            <option>Red</option>
            <option>Orange</option>
            <option>Yellow</option>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="dynamically-populated-select-options"></a>

### 動的に入力される選択オプション

```html
<select x-model="color">
    <template x-for="color in ['Red', 'Orange', 'Yellow']">
        <option x-text="color"></option>
    </template>
</select>

Color: <span x-text="color"></span>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ color: '' }">
        <select x-model="color">
            <template x-for="color in ['Red', 'Orange', 'Yellow']">
                <option x-text="color"></option>
            </template>
        </select>

        <div class="pt-4">Color: <span x-text="color"></span></div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="modifiers"></a>

## 修飾子

<a name="lazy"></a>

### `.lazy`

<!-- On text inputs, by default, `x-model` updates the property on every keystroke. By adding the `.lazy` modifier, you can force an `x-model` input to only update the property when user focuses away from the input element. -->

<!-- This is handy for things like real-time form-validation where you might not want to show an input validation error until the user "tabs" away from a field. -->

テキスト入力では、デフォルトで、`x-model` はキーストロークごとにプロパティを更新します。 `.lazy` 修飾子を追加することにより、ユーザーが入力要素から離れてフォーカスした場合にのみ、`x-model` 入力がプロパティを更新するように強制できます。

これは、ユーザーがフィールドから「tabs」で移動するまで入力検証エラーを表示したくないリアルタイムのフォーム検証などに便利です。

```html
<input type="text" x-model.lazy="username">
<span x-show="username.length > 20">The username is too long.</span>
```

<a name="number"></a>

### `.number`

<!-- By default, any data stored in a property via `x-model` is stored as a string. To force Alpine to store the value as a JavaScript number, add the `.number` modifier. -->

デフォルトでは、`x-model` を介してプロパティに保存されているデータはすべて文字列として保存されます。 Alpine に値を JavaScript 番号として保存させるには、`.number` 修飾子を追加します。

```html
<input type="text" x-model.number="age">
<span x-text="typeof age"></span>
```

<a name="debounce"></a>

### `.debounce`

<!-- By adding `.debounce` to `x-model`, you can easily debounce the updating of bound input. -->

<!-- This is useful for things like real-time search inputs that fetch new data from the server every time the search property changes. -->

`.debounce` を `x-model` に追加することで、バインドされた入力の更新を簡単にデバウンスできます。

これは、検索プロパティが変更されるたびにサーバーから新しいデータをフェッチするリアルタイム検索入力などに役立ちます。

```html
<input type="text" x-model.debounce="search">
```

<!-- The default debounce time is 250 milliseconds, you can easily customize this by adding a time modifier like so. -->

デフォルトのデバウンス時間は250ミリ秒です。このように時間修飾子を追加することで、これを簡単にカスタマイズできます。

```html
<input type="text" x-model.debounce.500ms="search">
```

<a name="throttle"></a>

### `.throttle`

<!-- Similar to `.debounce` you can limit the property update triggered by `x-model` to only updating on a specified interval. -->

`.debounce` と同様に、`x-model` によってトリガーされるプロパティの更新を指定された間隔でのみ更新するように制限できます。

```html
<input type="text" x-model.throttle="search">
```

<!-- The default throttle interval is 250 milliseconds, you can easily customize this by adding a time modifier like so. -->

デフォルトのスロットル間隔は250ミリ秒です。次の例では、時間を付与した修飾子を追加することでカスタマイズもできます。

```html
<input type="text" x-model.throttle.500ms="search">
```

<a name="programmatic access"></a>

## プログラムによるアクセス

<!-- Alpine exposes under-the-hood utilities for getting and setting properties bound with `x-model`. This is useful for complex Alpine utilities that may want to override the default x-model behavior, or instances where you want to allow `x-model` on a non-input element. -->

<!-- You can access these utilities through a property called `_x_model` on the `x-model`ed element. `_x_model` has two methods to get and set the bound property: -->

<!-- * `el._x_model.get()` (returns the value of the bound property) -->
<!-- * `el._x_model.set()` (sets the value of the bound property) -->

Alpineは、`x-model` でバインドされたプロパティを取得および設定するための内部ユーティリティを公開しています。 これは、デフォルトの `x-model` の動作をオーバーライドしたい複雑な Alpine ユーティリティや、非入力要素で `x-model` を許可したい場合に便利です。

これらのユーティリティには、`x-model` ed要素の `_x_model` というプロパティを介してアクセスできます。 `_x_model` には、バインドされたプロパティを取得および設定するための2つのメソッドがあります。

* `el._x_model.get()`（バインドされたプロパティの値を返します）
* `el._x_model.set()`（バインドされたプロパティの値を設定します）

```html
<div x-data="{ username: 'calebporzio' }">
    <div x-ref="div" x-model="username"></div>

    <button @click="$refs.div._x_model.set('phantomatrix')">
        Change username to: 'phantomatrix'
    </button>

    <span x-text="$refs.div._x_model.get()"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ username: 'calebporzio' }">
        <div x-ref="div" x-model="username"></div>

        <button @click="$refs.div._x_model.set('phantomatrix')">
            Change username to: 'phantomatrix'
        </button>

        <span x-text="$refs.div._x_model.get()"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```
