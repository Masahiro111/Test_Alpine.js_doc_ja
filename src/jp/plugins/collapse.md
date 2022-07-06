---
order: 4
title: Collapse
description: Collapse and expand elements with robust animations
graph_image: https://alpinejs.dev/social_collapse.jpg
---

# Collapse プラグイン

<!-- Alpine's Collapse plugin allows you to expand and collapse elements using smooth animations. -->

<!-- Because this behavior and implementation differs from Alpine's standard transition system, this functionality was made into a dedicated plugin. -->

Alpine の Collapse プラグインを使用すると、スムーズなアニメーションを使用して要素を展開および折りたたむことができます。

この動作と実装は Alpine の標準の トランジションシステムとは異なるため、この機能は専用のプラグインになりました。


<a name="installation"></a>

## インストール

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

### CDN 経由

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

次のように、バンドル内で使用するために NPM から Collapse をインストールできます。

<!-- You can install Collapse from NPM for use inside your bundle like so: -->

```shell
npm install @alpinejs/collapse
```

<!-- Then initialize it from your bundle: -->

次に、バンドルから初期化します。

```js
import Alpine from 'alpinejs'
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse)

...
```

<a name="x-collapse"></a>

## x-collapse

<!-- The primary API for using this plugin is the `x-collapse` directive. -->

<!-- `x-collapse` can only exist on an element that already has an `x-show` directive. When added to an `x-show` element, `x-collapse` will smoothly "collapse" and "expand" the element when it's visibility is toggled by animating its height property. -->

このプラグインを使用するための主要な API は、`x-collapse` ディレクティブです。

`x-collapse` は、すでに `x-show` ディレクティブを持つ要素にのみ存在できます。 `x-show` 要素に追加すると、` x-collapse` は、高さプロパティをアニメーション化することで要素の表示が切り替えられたときに、要素をスムーズに「折りたたむ」および「拡張する」ことができます。

<!-- For example: -->

例えば

```html
<div x-data="{ expanded: false }">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <p x-show="expanded" x-collapse>
        ...
    </p>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ expanded: false }" class="demo">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse>
        <div class="pt-4">
            Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="modifiers"></a>

## Modifiers (修飾子)

<a name="dot-duration"></a>

### .duration (間隔)

<!-- You can customize the duration of the collapse/expand transition by appending the `.duration` modifier like so: -->

次のように `.duration` 修飾子を追加することで、折りたたみ/展開遷移の期間をカスタマイズできます。

```html
<div x-data="{ expanded: false }">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <p x-show="expanded" x-collapse.duration.1000ms>
        ...
    </p>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ expanded: false }" class="demo">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse.duration.1000ms>
        <div class="pt-4">
            Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="dot-min"></a>

### .min

<!-- By default, `x-collapse`'s "collapsed" state sets the height of the element to `0px` and also sets `display: none;`. -->

<!-- Sometimes, it's helpful to "cut-off" an element rather than fully hide it. By using the `.min` modifier, you can set a minimum height for `x-collapse`'s "collapsed" state. For example: -->

デフォルトでは、`x-collapse` の "collapsed" 状態は、要素の高さを `0px` に設定し、 `display: none;` も設定します。

要素を完全に非表示にするのではなく、要素を「切り取る」と便利な場合があります。 `.min` 修飾子を使用すると、`x-collapse` の「collapsed (折りたたみ)」状態の最小の高さを設定できます。
例えば

```html
<div x-data="{ expanded: false }">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <p x-show="expanded" x-collapse.min.50px>
        ...
    </p>
</div>
```

```html
<!-- START_VERBATIM -->
<div x-data="{ expanded: false }" class="demo">
    <button @click="expanded = ! expanded">Toggle Content</button>

    <div x-show="expanded" x-collapse.min.50px>
        <div class="pt-4">
            Reprehenderit eu excepteur ullamco esse cillum reprehenderit exercitation labore non. Dolore dolore ea dolore veniam sint in sint ex Lorem ipsum. Sint laborum deserunt deserunt amet voluptate cillum deserunt. Amet nisi pariatur sit ut id. Ipsum est minim est commodo id dolor sint id quis sint Lorem.
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```
