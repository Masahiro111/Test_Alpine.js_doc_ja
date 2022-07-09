---
order: 2
title: Extending
---

# 拡張

Alpine には、さまざまな方法で拡張できる非常にオープンなコードベースがあります。 実際、Alpine 自体で利用可能なすべてのディレクティブと魔法は、これらの正確な API を使用しています。 理論的には、Alpine のすべての機能を自分で再構築できます。

<!-- Alpine has a very open codebase that allows for extension in a number of ways. In fact, every available directive and magic in Alpine itself uses these exact APIs. In theory you could rebuild all of Alpine's functionality using them yourself. -->

<a name="lifecycle-concerns"></a>

## ライフサイクルの懸念

個々の API について詳しく説明する前に、まず、コードベースのどこでこれらの API を使用する必要があるかについて説明しましょう。

これらの API は、Alpine がページを初期化する方法に影響を与えるため、Alpine がダウンロードされてページで利用可能になった後、ただしページ自体を初期化する前に登録する必要があります。

Alpine をバンドルにインポートするか、`<script>` タグを介して直接含めるかによって、2つの異なる手法があります。 それらの両方を見てみましょう

<!-- Before we dive into each individual API, let's first talk about where in your codebase you should consume these APIs. -->

<!-- Because these APIs have an impact on how Alpine initializes the page, they must be registered AFTER Alpine is downloaded and available on the page, but BEFORE it has initialized the page itself. -->

<!-- There are two different techniques depending on if you are importing Alpine into a bundle, or including it directly via a `<script>` tag. Let's look at them both: -->

<a name="via-script-tag"></a>

### script タグ経由

スクリプトタグを介して Alpine を含める場合は、`alpine:init` イベントリスナー内にカスタム拡張コードを登録する必要があります。

<!-- If you are including Alpine via a script tag, you will need to register any custom extension code inside an `alpine:init` event listener. -->

<!-- Here's an example: -->

```html
<html>
    <script src="/js/alpine.js" defer></script>

    <div x-data x-foo></div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.directive('foo', ...)
        })
    </script>
</html>
```

<!-- If you want to extract your extension code into an external file, you will need to make sure that file's `<script>` tag is located BEFORE Alpine's like so: -->

拡張コードを外部ファイルに抽出する場合は、ファイルの `<script>` タグが Alpine のようになる前に配置されていることを確認する必要があります。

```html
<html>
    <script src="/js/foo.js" defer></script>
    <script src="/js/alpine.js" defer></script>

    <div x-data x-foo></div>
</html>
```

<a name="via-npm"></a>

### NPM モジュール経由

Alpineをバンドルにインポートした場合は、`Alpine` グローバルオブジェクトをインポートするとき、および `Alpine.start()` を呼び出して Alpine を初期化するときに、拡張コードを BETWEEN に登録していることを確認する必要があります。

<!-- If you imported Alpine into a bundle, you have to make sure you are registering any extension code IN BETWEEN when you import the `Alpine` global object, and when you initialize Alpine by calling `Alpine.start()`. For example: -->

```js
import Alpine from 'alpinejs'

Alpine.directive('foo', ...)

window.Alpine = Alpine
window.Alpine.start()
```

<!-- Now that we know where to use these extension APIs, let's look more closely at how to use each one: -->

これらの拡張 API の使用場所がわかったので、それぞれの使用方法を詳しく見ていきましょう。

<a name="custom-directives"></a>

## カスタムディレクティブ

<!-- Alpine allows you to register your own custom directives using the `Alpine.directive()` API. -->

Alpine では、`Alpine.directive()` APIを使用して独自のカスタムディレクティブを登録できます。

<a name="method-signature"></a>

### メソッドシグネチャ

```js
Alpine.directive(
    '[name]',
    (
        el,
        { value, modifiers, expression },
        { Alpine, effect, cleanup }
    ) => {})
```

&nbsp; | &nbsp;
--- | ---
name | ディレクティブの名前。 たとえば、「foo」という名前は「x-foo」として使用されます。
el | ディレクティブが追加されるDOM要素
value | 提供されている場合、コロンの後のディレクティブの部分。 例： `x-foo：bar`の`'bar' `
modifiers | ディレクティブへのドットで区切られた末尾の追加の配列。 例： `['baz'、'lob']` from `x-foo.baz.lob`
expression | ディレクティブの属性値部分。 例： `x-foo="law"`の`law`
Alpine | Alpine グローバルオブジェクト
effect | このディレクティブがDOMから削除された後に自動クリーンアップするリアクティブエフェクトを作成する関数
cleanup | このディレクティブがDOMから削除されたときに実行される、特注のコールバックを渡すことができる関数

<a name="simple-example"></a>

### シンプルな例

<!-- Here's an example of a simple directive we're going to create called: `x-uppercase`: -->

これから作成する単純なディレクティブの例を次に示します。

`x-uppercase`

```js
Alpine.directive('uppercase', el => {
    el.textContent = el.textContent.toUpperCase()
})
```
```html
<div x-data>
    <span x-uppercase>Hello World!</span>
</div>
```

<a name="evaluating-expressions"></a>

### 式の評価

<!-- When registering a custom directive, you may want to evaluate a user-supplied JavaScript expression: -->

<!-- For example, let's say you wanted to create a custom directive as a shortcut to `console.log()`. Something like: -->

カスタムディレクティブを登録するときに、ユーザーが指定したJavaScript 式を評価することをお勧めします。

たとえば、`console.log()` へのショートカットとしてカスタムディレクティブを作成したいとします。 

```html
<div x-data="{ message: 'Hello World!' }">
    <div x-log="message"></div>
</div>
```

<!-- You need to retrieve the actual value of `message` by evaluating it as a JavaScript expression with the `x-data` scope. -->

<!-- Fortunately, Alpine exposes its system for evaluating JavaScript expressions with an `evaluate()` API. Here's an example: -->

`x-data` スコープで JavaScript 式として評価することにより、`message` の実際の値を取得する必要があります。

幸い、Alpine は、`evaluate()` API を使用して JavaScript 式を評価するためのシステムを公開しています。 次に例を示します。

```js
Alpine.directive('log', (el, { expression }, { evaluate }) => {
    // expression === 'message'

    console.log(
        evaluate(expression)
    )
})
```

<!-- Now, when Alpine initializes the `<div x-log...>`, it will retrieve the expression passed into the directive ("message" in this case), and evaluate it in the context of the current element's Alpine component scope. -->

これで、Alpine が `<div x-log ...>` を初期化すると、ディレクティブに渡された式（この場合は "message"）が取得され、現在の要素の Alpine コンポーネントスコープのコンテキストで評価されます。

<a name="introducing-reactivity"></a>

### 反応性の紹介

<!-- Building on the `x-log` example from before, let's say we wanted `x-log` to log the value of `message` and also log it if the value changes. -->

<!-- Given the following template: -->

以前の `x-log` の例に基づいて、`x-log` で `message` の値をログに記録し、値が変更された場合にもログに記録したいとします。

次のテンプレートがあるとします。

```html
<div x-data="{ message: 'Hello World!' }">
    <div x-log="message"></div>

    <button @click="message = 'yolo'">Change</button>
</div>
```

<!-- We want "Hello World!" to be logged initially, then we want "yolo" to be logged after pressing the `<button>`. -->

<!-- We can adjust the implementation of `x-log` and introduce two new APIs to achieve this: `evaluateLater()` and `effect()`: -->

「HelloWorld！」が欲しいです。 最初にログに記録する場合は、`<button>` を押した後に「yolo」をログに記録する必要があります。

`x-log` の実装を調整し、これを実現するために2つの新しいAPIを導入できます。

例：`evaluateLater()` と `effect()`

```js
Alpine.directive('log', (el, { expression }, { evaluateLater, effect }) => {
    let getThingToLog = evaluateLater(expression)

    effect(() => {
        getThingToLog(thingToLog => {
            console.log(thingToLog)
        })
    })
})
```

<!-- Let's walk through the above code, line by line. -->

上記のコードを 1行ずつ見ていきましょう。

```js
let getThingToLog = evaluateLater(expression)
```

<!-- Here, instead of immediately evaluating `message` and retrieving the result, we will convert the string expression ("message") into an actual JavaScript function that we can run at any time. If you're going to evaluate a JavaScript expression more than once, it is highly recommended to first generate a JavaScript function and use that rather than calling `evaluate()` directly. The reason being that the process to interpret a plain string as a JavaScript function is expensive and should be avoided when unnecessary. -->

ここでは、すぐに `message` を評価して結果を取得する代わりに、文字列式（"message"）をいつでも実行できる実際の JavaScript 関数に変換します。 JavaScript 式を複数回評価する場合は、`evaluate()` を直接呼び出すのではなく、最初に JavaScript 関数を生成して使用することを強くお勧めします。 その理由は、プレーンな文字列を JavaScript 関数として解釈するプロセスはコストがかかるため、不要な場合は避ける必要があるためです。

```js
effect(() => {
    ...
})
```

<!-- By passing in a callback to `effect()`, we are telling Alpine to run the callback immediately, then track any dependencies it uses (`x-data` properties like `message` in our case). Now as soon as one of the dependencies changes, this callback will be re-run. This gives us our "reactivity". -->

<!-- You may recognize this functionality from `x-effect`. It is the same mechanism under the hood. -->

<!-- You may also notice that `Alpine.effect()` exists and wonder why we're not using it here. The reason is that the `effect` function provided via the method parameter has special functionality that cleans itself up when the directive is removed from the page for any reason. -->

<!-- For example, if for some reason the element with `x-log` on it got removed from the page, by using `effect()` instead of `Alpine.effect()` when the `message` property is changed, the value will no longer be logged to the console. -->

<!-- [→ Read more about reactivity in Alpine](/advanced/reactivity) -->

コールバックを `effect()` に渡すことで、コールバックをすぐに実行し、使用する依存関係（この場合は `message` などの `x-data` プロパティ）を追跡するように Alpine に指示しています。 依存関係の1つが変更されるとすぐに、このコールバックが再実行されます。 これは私たちに「反応性」を与えます。

この機能は `x-effect` からわかるかもしれません。 これは、内部で同じメカニズムです。

また、`Alpine.effect()` が存在することに気づき、なぜここでそれを使用しないのか不思議に思うかもしれません。 その理由は、メソッドパラメータを介して提供される `effect` 関数には、何らかの理由でディレクティブがページから削除されたときにそれ自体をクリーンアップする特別な機能があるためです。

たとえば、何らかの理由で「x-log」が含まれている要素がページから削除された場合、「message」プロパティが変更されたときに「Alpine.effect()」の代わりに「effect()」を使用すると、値は コンソールに記録されなくなります。

[→アルパインの反応性についてもっと読む](/advanced/reactivity)

```js
getThingToLog(thingToLog => {
    console.log(thingToLog)
})
```

<!-- Now we will call `getThingToLog`, which if you recall is the actual JavaScript function version of the string expression: "message". -->

<!-- You might expect `getThingToCall()` to return the result right away, but instead Alpine requires you to pass in a callback to receive the result. -->

<!-- The reason for this is to support async expressions like `await getMessage()`. By passing in a "receiver" callback instead of getting the result immediately, you are allowing your directive to work with async expressions as well. -->

<!-- [→ Read more about async in Alpine](/advanced/async) -->

ここで、`getThingToLog` を呼び出します。これは、文字列式の実際の JavaScript 関数バージョンである "message" です。

`getThingToCall()` がすぐに結果を返すことを期待するかもしれませんが、代わりに Alpine は結果を受け取るためにコールバックを渡すことを要求します。

これは、`await getMessage()` のような非同期式をサポートするためです。 結果をすぐに取得する代わりに「レシーバー」コールバックを渡すことで、ディレクティブが非同期式でも機能できるようになります。

[ → アルパインの非同期についてもっと読む ](/advanced/async)

<a name="cleaning-up"></a>

### クリーンアップ

<!-- Let's say you needed to register an event listener from a custom directive. After that directive is removed from the page for any reason, you would want to remove the event listener as well. -->

<!-- Alpine makes this simple by providing you with a `cleanup` function when registering custom directives. -->

<!-- Here's an example: -->

カスタムディレクティブからイベントリスナーを登録する必要があるとしましょう。 何らかの理由でそのディレクティブがページから削除された後は、イベントリスナーも削除する必要があります。

Alpine は、カスタムディレクティブを登録するときに `cleanup` 関数を提供することにより、これを簡単にします。

次に例を示します。

```js
Alpine.directive('...', (el, {}, { cleanup }) => {
    let handler = () => {}

    window.addEventListener('click', handler)

    cleanup(() => {
        window.removeEventListener('click', handler)
    })

})
```

<!-- Now if the directive is removed from this element or the element is removed itself, the event listener will be removed as well. -->

これで、ディレクティブがこの要素から削除されるか、要素自体が削除されると、イベントリスナーも削除されます。

<a name="custom-magics"></a>

## カスタムマジック

<!-- Alpine allows you to register custom "magics" (properties or methods) using `Alpine.magic()`. Any magic you register will be available to all your application's Alpine code with the `$` prefix. -->

<!-- <a name="custom-magics"> </a> -->

<!-- ##カスタムマジック -->

Alpine では、`Alpine.magic()` を使用してカスタムの `magics`（プロパティまたはメソッド）を登録できます。 登録したすべてのマジックは、`$` プレフィックスが付いたすべてのアプリケーションのアルパインコードで使用できます。

<a name="method-signature"></a>

### メソッドシグネチャ

```js
Alpine.magic('[name]', (el, { Alpine }) => {})
```
<!-- 
&nbsp; | &nbsp;
---|---
name | The name of the magic. The name "foo" for example would be consumed as `$foo`
el | The DOM element the magic was triggered from
Alpine | The Alpine global object -->

＆nbsp; | ＆nbsp;
--- | ---
name | マジックの名前。たとえば、「foo」という名前は「$foo」として使用されます。
el |マジックが引き起こされた DOM 要素
Alpine | Alpine グローバルオブジェクト

<a name="magic-properties"></a>

### マジックプロパティ

<!-- Here's a basic example of a "$now" magic helper to easily get the current time from anywhere in Alpine: -->

これは、Alpine のどこからでも現在の時刻を簡単に取得できる「$now」マジックヘルパーの基本的な例です。

```js
Alpine.magic('now', () => {
    return (new Date).toLocaleTimeString()
})
```
```html
<span x-text="$now"></span>
```

<!-- Now the `<span>` tag will contain the current time, resembling something like "12:00:00 PM". -->

<!-- As you can see `$now` behaves like a static property, but under the hood is actually a getter that evaluates every time the property is accessed. -->

<!-- Because of this, you can implement magic "functions" by returning a function from the getter. -->

これで、`<span>` タグに現在の時刻が含まれ、「12:00:00PM」のようになります。

ご覧のとおり、`$now` は静的プロパティのように動作しますが、実際には、プロパティにアクセスするたびに評価するゲッターが内部にあります。

このため、ゲッターから関数を返すことで、魔法の「関数」を実装できます。

<a name="magic-functions"></a>

### Magic Functions

<!-- For example, if we wanted to create a `$clipboard()` magic function that accepts a string to copy to clipboard, we could implement it like so: -->

たとえば、クリップボードにコピーする文字列を受け入れる `$clipboard()` マジック関数を作成したい場合は、次のように実装できます。

```js
Alpine.magic('clipboard', () => {
    return subject => navigator.clipboard.writeText(subject)
})
```
```html
<button @click="$clipboard('hello world')">Copy "Hello World"</button>
```

<!-- Now that accessing `$clipboard` returns a function itself, we can immediately call it and pass it an argument like we see in the template with `$clipboard('hello world')`. -->

<!-- You can use the more brief syntax (a double arrow function) for returning a function from a function if you'd prefer: -->

`$clipboard` にアクセスすると関数自体が返されるので、すぐにそれを呼び出して、`$clipboard('hello world')` のテンプレートにあるような引数を渡すことができます。

必要に応じて、関数から関数を返すためのより簡単な構文（二重矢印関数）を使用できます。

```js
Alpine.magic('clipboard', () => subject => {
    navigator.clipboard.writeText(subject)
})
```

<a name="writing-and-sharing-plugins"></a>

## プラグインの作成と共有

これで、独自のカスタムディレクティブとマジックをアプリケーションに登録することがいかにフレンドリーでシンプルであるかがわかるはずですが、NPM パッケージなどを介してその機能を他のユーザーと共有するのはどうでしょうか。

Alpine の公式「プラグインブループリント」パッケージをすぐに使い始めることができます。リポジトリのクローンを作成し、`npm install && npm run build` を実行して、プラグインを作成するのと同じくらい簡単です。

デモンストレーションの目的で、ディレクティブ（`x-foo`）とマジック（`$foo`）の両方を含む `Foo` と呼ばれる 見せかけの Alpine プラグインを最初から作成しましょう。

Alpine と一緒に単純な `<script>` タグとして使用するためにこのプラグインの作成を開始し、次にバンドルにインポートするためのモジュールにレベルアップします。

<!-- By now you should see how friendly and simple it is to register your own custom directives and magics in your application, but what about sharing that functionality with others via an NPM package or something? -->

<!-- You can get started quickly with Alpine's official "plugin-blueprint" package. It's as simple as cloning the repository and running `npm install && npm run build` to get a plugin authored. -->

<!-- For demonstration purposes, let's create a pretend Alpine plugin from scratch called `Foo` that includes both a directive (`x-foo`) and a magic (`$foo`). -->

<!-- We'll start producing this plugin for consumption as a simple `<script>` tag alongside Alpine, then we'll level it up to a module for importing into a bundle: -->

<a name="script-include"></a>

### スクリプトインクルード

<!-- Let's start in reverse by looking at how our plugin will be included into a project: -->

プラグインがプロジェクトにどのように含まれるかを見て、逆に始めましょう。

```html
<html>
    <script src="/js/foo.js" defer></script>
    <script src="/js/alpine.js" defer></script>

    <div x-data x-init="$foo()">
        <span x-foo="'hello world'">
    </div>
</html>
```

<!-- Notice how our script is included BEFORE Alpine itself. This is important, otherwise, Alpine would have already been initialized by the time our plugin got loaded. -->

<!-- Now let's look inside of `/js/foo.js`'s contents: -->

Alpine 自体の前にスクリプトがどのように含まれているかに注意してください。これは重要です。そうでない場合、プラグインがロードされるまでに Alpine はすでに初期化されているはずです。

それでは、`/js/foo.js` の内容の内部を見てみましょう。

```js
document.addEventListener('alpine:init', () => {
    window.Alpine.directive('foo', ...)

    window.Alpine.magic('foo', ...)
})
```

<!-- That's it! Authoring a plugin for inclusion via a script tag is extremely simple with Alpine. -->

それでおしまい！スクリプトタグを介してプラグインを含めるためのオーサリングは、Alpine を使用すると非常に簡単です。

<a name="bundle-module"></a>

### バンドルモジュール

ここで、誰かが NPM を介してインストールし、バンドルに含めることができるプラグインを作成したいとします。

最後の例のように、このプラグインを使用するとどのように見えるかから始めて、これを逆に説明します。

<!-- Now let's say you wanted to author a plugin that someone could install via NPM and include into their bundle. -->

<!-- Like the last example, we'll walk through this in reverse, starting with what it will look like to consume this plugin: -->

```js
import Alpine from 'alpinejs'

import foo from 'foo'
Alpine.plugin(foo)

window.Alpine = Alpine
window.Alpine.start()
```

<!-- You'll notice a new API here: `Alpine.plugin()`. This is a convenience method Alpine exposes to prevent consumers of your plugin from having to register multiple different directives and magics themselves. -->

<!-- Now let's look at the source of the plugin and what gets exported from `foo`: -->

ここに新しい API があります `Alpine.plugin()` これは、プラグインのコンシューマーが複数の異なるディレクティブやマジックを自分で登録する必要がないようにするために Alpine が公開する便利な方法です。

次に、プラグインのソースと、`foo` からエクスポートされるものを見てみましょう。

```js
export default function (Alpine) {
    Alpine.directive('foo', ...)
    Alpine.magic('foo', ...)
}
```

<!-- You'll see that `Alpine.plugin` is incredibly simple. It accepts a callback and immediately invokes it while providing the `Alpine` global as a parameter for use inside of it. -->

<!-- Then you can go about extending Alpine as you please. -->

`Alpine.plugin` は非常にシンプルであることがわかります。コールバックを受け入れ、すぐに呼び出します。その間、内部で使用するパラメータとして `Alpine` グローバルを提供します。

その後、好きなようにアルパインを拡張することができます。
