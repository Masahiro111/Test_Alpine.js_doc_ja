---
order: 1
title: Mask
description: Automatically format text fields as users type
graph_image: https://alpinejs.dev/social_mask.jpg
---

# マスクプラグイン (Mask Plugin)

<!-- Alpine's Mask plugin allows you to automatically format a text input field as a user types. -->

<!-- This is useful for many different types of inputs: phone numbers, credit cards, dollar amounts, account numbers, dates, etc. -->

Alpine の Mask プラグインを使用すると、ユーザーの入力に応じてテキスト入力フィールドを自動的にフォーマットできます。

これは、電話番号、クレジットカード、金額、口座番号、日付など、さまざまな種類の入力に役立ちます。

<a name="installation"></a>

## インストール

```html
<div x-data="{ expanded: false }">
    <div class=" relative">
        <div 
            x-show="!expanded" 
            class="absolute inset-0 flex justify-start items-end bg-gradient-to-t from-white to-[#ffffff66]"></div>
        <div 
            x-show="expanded" 
            x-collapse.min.80px 
            class="markdown">
```

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

### CDN 経由

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

次のように、バンドル内で使用するために NPM から Mask をインストールできます。

<!-- You can install Mask from NPM for use inside your bundle like so: -->

```shell
npm install @alpinejs/mask
```

<!-- Then initialize it from your bundle: -->

次に、バンドルから初期化します。

```js
import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'

Alpine.plugin(mask)

...
```

<!-- ```html
        </div>
    </div>
    <button :aria-expanded="expanded" @click="expanded = ! expanded" class="text-cyan-600 font-medium underline">
    <span x-text="expanded ? 'Hide' : 'Show more'">Show</span> <span x-text="expanded ? '↑' : '↓'">↓</span>
    </button>
</div>
 ``` -->

<a name="x-mask"></a>

## x-mask

<!-- The primary API for using this plugin is the `x-mask` directive. -->

<!-- Let's start by looking at the following simple example of a date field: -->

このプラグインを使用するための主要な API は、`x-mask` ディレクティブです。

日付フィールドの次の簡単な例を見てみましょう。

```html
<input x-mask="99/99/9999" placeholder="MM/DD/YYYY">
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <input x-data x-mask="99/99/9999" placeholder="MM/DD/YYYY">
</div>
<!-- END_VERBATIM -->
```

<!-- Notice how the text you type into the input field must adhere to the format provided by `x-mask`. In addition to enforcing numeric characters, the forward slashes `/` are also automatically added if a user doesn't type them first. -->

<!-- The following wildcard characters are supported in masks: -->

入力フィールドに入力するテキストが、`x-mask` によって提供される形式に準拠している必要があることに注意してください。数字を強制することに加えて、ユーザーが最初に数字を入力しない場合、スラッシュ `/` も自動的に追加されます。

次のワイルドカード文字がマスクでサポートされています。

| ワイルドカード                   | 説明                 |
| -------------------------- | --------------------------- |
| `*` | 任意の文字 |
| `a` | 英字のみ (a-z、A-Z) |
| `9` | 数字のみ (0〜9) |

<a name="mask-functions"></a>

## ダイナミックマスク

単純なマスクリテラル（つまり `(999) 999-9999`）では不十分な場合があります。このような場合、`x-mask:dynamic` を使用すると、ユーザー入力に基づいてその場でマスクを動的に生成できます。

これは、番号が「34」または「37」のどちらで始まるかに基づいてマスクを変更する必要があるクレジットカード入力の例です（つまり、Amexカードであるため、形式が異なります）。

<!-- Sometimes simple mask literals (i.e. `(999) 999-9999`) are not sufficient. In these cases, `x-mask:dynamic` allows you to dynamically generate masks on the fly based on user input. -->

<!-- Here's an example of a credit card input that needs to change it's mask based on if the number starts with the numbers "34" or "37" (which means it's an Amex card and therefore has a different format). -->

```html
<input x-mask:dynamic="
    $input.startsWith('34') || $input.startsWith('37')
        ? '9999 999999 99999' : '9999 9999 9999 9999'">
```

<!-- As you can see in the above example, every time a user types in the input, that value is passed to the expression as `$input`. Based on the `$input`, a different mask is utilized in the field. -->

<!-- Try it for yourself by typing a number that starts with "34" and one that doesn't. -->

上記の例でわかるように、ユーザーが入力を入力するたびに、その値は `$input` として式に渡されます。 `$input` に基づいて、フィールドで異なるマスクが使用されます。

「34」で始まる数字とそうでない数字を入力して、自分で試してみてください。

```html
<!-- START_VERBATIM -->
<div class="demo">
    <input x-data x-mask:dynamic="
        $input.startsWith('34') || $input.startsWith('37')
            ? '9999 999999 99999' : '9999 9999 9999 9999'
    ">
</div>
<!-- END_VERBATIM -->
```

<!-- `x-mask:dynamic` also accepts a function as a result of the expression and will automatically pass it the `$input` as the the first paramter. For example: -->

`x-mask:dynamic` は式の結果として関数も受け入れ、最初のパラメーターとして `$input` を自動的に渡します。例えば：

```html
<input x-mask:dynamic="creditCardMask">

<script>
function creditCardMask(input) {
    return input.startsWith('34') || input.startsWith('37')
        ? '9999 999999 99999'
        : '9999 9999 9999 9999'
}
</script>
```

<a name="money-inputs"></a>

## 金額の入力 (Money Inputs)

お金の入力用に独自の動的マスク式を作成するのはかなり複雑なため、Alpineは事前に作成されたものを提供し、`$money()` として利用できるようにします。

これが完全に機能するお金の入力マスクです：

<!-- Because writing your own dynamic mask expression for money inputs is fairly complex, Alpine offers a prebuilt one and makes it available as `$money()`. -->

<!-- Here is a fully functioning money input mask: -->

```html
<input x-mask:dynamic="$money($input)">
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-data>
    <input type="text" x-mask:dynamic="$money($input)" placeholder="0.00">
</div>
<!-- END_VERBATIM -->
```

<!-- If you wish to swap the periods for commas and vice versa (as is required in certain currencies), you can do so using the second optional parameter: -->

ピリオドをコンマに、またはその逆に交換する場合（特定の通貨で必要な場合）、2番目のオプションのパラメーターを使用して行うことができます。

```html
<input x-mask:dynamic="$money($input, ',')">
```

```html
<!-- START_VERBATIM -->
<div class="demo" x-data>
    <input type="text" x-mask:dynamic="$money($input, ',')"  placeholder="0,00">
</div>
<!-- END_VERBATIM -->
```