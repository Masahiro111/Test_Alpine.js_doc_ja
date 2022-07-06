---
order: 5
title: Morph
description: Morph an element into the provided HTML
graph_image: https://alpinejs.dev/social_morph.jpg
---

# モーフ (変形) プラグイン

<!-- Alpine's Morph plugin allows you to "morph" an element on the page into the provided HTML template, all while preserving any browser or Alpine state within the "morphed" element. -->

<!-- This is useful for updating HTML from a server request without loosing Alpine's on-page state. A utility like this is at the core of full-stack frameworks like [Laravel Livewire](https://laravel-livewire.com/) and [Phoenix LiveView](https://dockyard.com/blog/2018/12/12/phoenix-liveview-interactive-real-time-apps-no-need-to-write-javascript). -->

<!-- The best way to understand its purpose is with the following interactive visualization. Give it a try! -->

Alpine の モーフプラグインを使用すると、ページ上の要素を提供された HTML テンプレートに「モーフィング」すると同時に、「モーフィング」要素内のブラウザまたは Alpine の状態を保持できます。

これは、Alpine のページ上の状態を失うことなく、サーバー要求からHTMLを更新する場合に役立ちます。 このようなユーティリティは、[Laravel Livewire](https://laravel-livewire.com/) や [Phoenix LiveView](https://dockyard.com/blog/2018/12/12/phoenix-liveview-interactive-real-time-apps-no-need-to-write-javascript) などのフルスタックフレームワークの中核にあります。

その目的を理解する最良の方法は、次のインタラクティブな視覚化を使用することです。 まずは試してみましょう。

```html
<!-- START_VERBATIM -->
<div x-data="{ slide: 1 }" class="border rounded">
    <div>
        <img :src="'/img/morphs/morph'+slide+'.png'">
    </div>

    <div class="flex w-full justify-between" style="padding-bottom: 1rem">
        <div class="w-1/2 px-4">
            <button @click="slide = (slide === 1) ? 13 : slide - 1" class="w-full bg-cyan-400 rounded-full text-center py-3 font-bold text-white">Previous</button>
        </div>
        <div class="w-1/2 px-4">
            <button @click="slide = (slide % 13) + 1" class="w-full bg-cyan-400 rounded-full text-center py-3 font-bold text-white">Next</button>
        </div>
    </div>
</div>
<!-- END_VERBATIM -->
```

<a name="installation"></a>

## インストール

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

このプラグインは、`<script>` タグから含めるか、NPM 経由でインストールすることで使用できます。

### CDN 経由

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

このプラグインの CDN ビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

```html
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/morph@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

<!-- You can install Morph from NPM for use inside your bundle like so: -->

次のように、バンドル内で使用するために NPM から Morph をインストールできます。

```shell
npm install @alpinejs/morph
```

<!-- Then initialize it from your bundle: -->

そのあと、バンドルから初期化をします。

```js
import Alpine from 'alpinejs'
import morph from '@alpinejs/morph'

window.Alpine = Alpine
Alpine.plugin(morph)

...
```

<a name="alpine-morph"></a>

## Alpine.morph()

<!-- The `Alpine.morph(el, newHtml)` allows you to imperatively morph a dom node based on passed in HTML. It accepts the following parameters: -->

<!-- | Parameter | Description |
| ---       | --- |
| `el`      | A DOM element on the page. |
| `newHtml` | A string of HTML to use as the template to morph the dom element into. |
| `options` (optional) | An options object used mainly for [injecting lifecycle hooks](#lifecycle-hooks). | -->

<!-- Here's an example of using `Alpine.morph()` to update an Alpine component with new HTML: (In real apps, this new HTML would likely be coming from the server) -->

`Alpine.morph(el, newHtml)` を使用すると、渡されたHTML に基づいて DOM ノードを強制的にモーフィングできます。 次のパラメータを受け入れます。

| パラメータ| 説明|
| --- | --- |
| `el` | ページ上のDOM要素。 |
| `newHtml` | DOM 要素をモーフィングするためのテンプレートとして使用する HTML の文字列。 |
| `options`<br>(オプション) | 主に[ライフサイクルフックの挿入](#lifecycle-hooks) に使用されるオプションオブジェクト。 |

`Alpine.morph()` を使用して Alpine コンポーネントを新しい HTML で更新する例を次に示します。(実際のアプリでは、この新しい HTML はサーバーから取得される可能性があります）

```html
<div x-data="{ message: 'Change me, then press the button!' }">
    <input type="text" x-model="message">
    <span x-text="message"></span>
</div>

<button>Run Morph</button>

<script>
    document.querySelector('button').addEventListener('click', () => {
        let el = document.querySelector('div')

        Alpine.morph(el, `
            <div x-data="{ message: 'Change me, then press the button!' }">
                <h2>See how new elements have been added</h2>

                <input type="text" x-model="message">
                <span x-text="message"></span>

                <h2>but the state of this component hasn't changed? Magical.</h2>
            </div>
        `)
    })
</script>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ message: 'Change me, then press the button!' }" id="morph-demo-1" class="space-y-2">
        <input type="text" x-model="message" class="w-full">
        <span x-text="message"></span>
    </div>

    <button id="morph-button-1" class="mt-4">Run Morph</button>
</div>

<script>
    document.querySelector('#morph-button-1').addEventListener('click', () => {
        let el = document.querySelector('#morph-demo-1')

        Alpine.morph(el, `
            <div x-data="{ message: 'Change me, then press the button!' }" id="morph-demo-1" class="space-y-2">
                <h4>See how new elements have been added</h4>
                <input type="text" x-model="message" class="w-full">
                <span x-text="message"></span>
                <h4>but the state of this component hasn't changed? Magical.</h4>
            </div>
        `)
    })
</script>
<!-- END_VERBATIM -->
```

<a name="lifecycle-hooks"></a>

### ライフサイクルフック

<!-- The "Morph" plugin works by comparing two DOM trees, the live element, and the passed in HTML. -->

<!-- Morph walks both trees simultaneously and compares each node and its children. If it finds differences, it "patches" (changes) the current DOM tree to match the passed in HTML's tree. -->

<!-- While the default algorithm is very capable, there are cases where you may want to hook into its lifecycle and observe or change its behavior as it's happening. -->

<!-- Before we jump into the available Lifecycle hooks themselves, let's first list out all the potential parameters they receive and explain what each one is: -->

「Morph」プラグインは、2つの DOM ツリー、ライブ要素、および渡された HTML を比較することによって機能します。

モーフは両方のツリーを同時に解析して、各ノードとその子を比較します。違いが見つかった場合は、現在の DOM ツリーを「パッチ」（変更）して、渡された HTML のツリーと一致させます。

デフォルトのアルゴリズムは非常に機能的ですが、ライフサイクルに接続して、発生中の動作を観察または変更したい場合があります。

利用可能なライフサイクルフック自体に飛び込む前に、まず、それらが受け取る可能性のあるすべてのパラメーターをリストアップし、それぞれが何であるかを説明しましょう。

<!-- | Parameter | Description |
| ---       | --- |
| `el` | This is always the actual, current, DOM element on the page that will be "patched" (changed by Morph). |
| `toEl` | This is a "template element". It's a temporary element representing what the live `el` will be patched to. It will never actually live on the page and should only be used for reference purposes. |
| `childrenOnly()` | This is a function that can be called inside the hook to tell Morph to skip the current element and only "patch" its children. |
| `skip()` | A function that when called within the hook will "skip" comparing/patching itself and the children of the current element. |

Here are the available lifecycle hooks (passed in as the third parameter to `Alpine.morph(..., options)`): -->

|パラメータ|説明|
| --- | --- |
| `el` |これは常に、「パッチが適用される」（モーフによって変更される）ページ上の実際の現在の DOM 要素です。 |
| `toEl` |これは「テンプレート要素」です。これは、ライブの `el` にパッチが適用される対象を表す一時的な要素です。実際にページに表示されることはなく、参照目的でのみ使用する必要があります。 |
| `childrenOnly()` |これは、フック内で呼び出して、現在の要素をスキップし、その子のみを「パッチ」するように Morph に指示できる関数です。 |
| `skip()` |フック内で呼び出されたときに、それ自体と現在の要素の子を比較/パッチする関数を「スキップ」します。 |

使用可能なライフサイクルフックは次のとおりです（  `Alpine.morph(..., options)` に3番目のパラメーターとして渡されます）。

<!-- | Option | Description |
| ---       | --- |
| `updating(el, toEl, childrenOnly, skip)` | Called before patching the `el` with the comparison `toEl`.  |
| `updated(el, toEl)` | Called after Morph has patched `el`. |
| `removing(el, skip)` | Called before Morph removes an element from the live DOM. |
| `removed(el)` | Called after Morph has removed an element from the live DOM. |
| `adding(el, skip)` | Called before adding a new element. |
| `added(el)` | Called after adding a new element to the live DOM tree. |
| `key(el)` | A re-usable function to determine how Morph "keys" elements in the tree before comparing/patching. [More on that here](#keys) |
| `lookahead` | A boolean value telling Morph to enable an extra feature in its algorithm that "looks ahead" to make sure a DOM element that's about to be removed should instead just be "moved" to a later sibling. |

Here is code of all these lifecycle hooks for a more concrete reference: -->

|オプション|説明|
| --- | --- |
| `updating（el、toEl、childrenOnly、skip）` |比較`toEl`で`el`にパッチを当てる前に呼び出されます。 |
| `updated（el、toEl）` | Morphが`el`にパッチを適用した後に呼び出されます。 |
| `removing（el、skip）` | MorphがライブDOMから要素を削除する前に呼び出されます。 |
| `removed（el）` | MorphがライブDOMから要素を削除した後に呼び出されます。 |
| `adding（el、skip）` |新しい要素を追加する前に呼び出されます。 |
| `added（el）` |ライブDOMツリーに新しい要素を追加した後に呼び出されます。 |
| `key（el）` |比較/パッチ適用の前に、モーフがツリー内の要素をどのように「キー」するかを決定するための再利用可能な関数。 [詳細はこちら]（＃keys）|
| `先読み`|削除されようとしているDOM要素が代わりに後の兄弟に「移動」されることを確認するために、アルゴリズムの追加機能を有効にするようにMorphに指示するブール値。 |

より具体的なリファレンスとして、これらすべてのライフサイクルフックのコードを次に示します。

```js
Alpine.morph(el, newHtml, {
    updating(el, toEl, childrenOnly, skip) {
        //
    },

    updated(el, toEl) {
        //
    },

    removing(el, skip) {
        //
    },

    removed(el) {
        //
    },

    adding(el, skip) {
        //
    },

    added(el) {
        //
    },

    key(el) {
        // By default Alpine uses the `key=""` HTML attribute.
        return el.id
    },

    lookahead: true, // Default: false
})
```

<a name="keys"></a>

### キー (Keys)

<!-- Dom-diffing utilities like Morph try their best to accurately "morph" the original DOM into the new HTML. However, there are cases where it's impossible to determine if an element should be just changed, or replaced completely. -->

<!-- Because of this limitation, Morph has a "key" system that allows developers to "force" preserving certain elements rather than replacing them. -->

<!-- The most common use-case for them is a list of siblings within a loop. Below is an example of why keys are necessary sometimes: -->

Morph のような DOM 差分ユーティリティは、元の DOM を新しい HTML に正確に「モーフィング」するために最善を尽くします。 ただし、要素を変更するだけなのか、完全に置き換えるのかを判断できない場合があります。

この制限のため、Morph には、開発者が特定の要素を置き換えるのではなく、保存することを「強制」できる「キー」システムがあります。

それらの最も一般的なユースケースは、ループ内の兄弟のリストです。 以下は、キーが時々必要になる理由の例です。

```html
<!-- "Live" Dom on the page: -->
<ul>
    <li>Mark</li>
    <li>Tom</li>
    <li>Travis</li>
</ul>

<!-- New HTML to "morph to": -->
<ul>
    <li>Travis</li>
    <li>Mark</li>
    <li>Tom</li>
</ul>
```

<!-- Given the above situation, Morph has no way to know that the "Travis" node has been moved in the DOM tree. It just thinks that "Mark" has been changed to "Travis" and "Travis" changed to "Tom". -->

<!-- This is not what we actually want, we want Morph to preserve the original elements and instead of changing them, MOVE them within the `<ul>`. -->

<!-- By adding keys to each node, we can accomplish this like so: -->

上記の状況を考えると、Morph は「Travis」ノードが DOM ツリーで移動されたことを知る方法がありません。 「Mark」が「Travis」に、「Travis」が「Tom」に変わったと思っているだけです。

これは私たちが実際に望んでいることではありません。Morphに元の要素を保持させ、それらを変更する代わりに、`<ul>` 内で移動させます。

各ノードにキーを追加することで、次のように実現できます。

```html
<!-- "Live" Dom on the page: -->
<ul>
    <li key="1">Mark</li>
    <li key="2">Tom</li>
    <li key="3">Travis</li>
</ul>

<!-- New HTML to "morph to": -->
<ul>
    <li key="3">Travis</li>
    <li key="1">Mark</li>
    <li key="2">Tom</li>
</ul>
```

<!-- Now that there are "keys" on the `<li>`s, Morph will match them in both trees and move them accordingly. -->

<!-- You can configure what Morph considers a "key" with the `key:` configuration option. [More on that here](#lifecycle-hooks) -->

`<li>` に「key」があるので、モーフは両方のツリーでそれらを一致させ、それに応じて移動します。

`key:` 構成オプションを使用して、Morph が「キー」と見なすものを構成できます。 [詳細はこちら](#lifecycle-hooks)