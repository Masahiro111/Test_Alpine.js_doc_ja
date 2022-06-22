---
order: 2
title: Persist
description: Easily persist data across page loads using localStorage
graph_image: https://alpinejs.dev/social_persist.jpg
---

# Persistプラグイン

<!-- Alpine's Persist plugin allows you to persist Alpine state across page loads. -->

<!-- This is useful for persisting search filters, active tabs, and other features where users will be frustrated if their configuration is reset after refreshing or leaving and revisiting a page. -->

Alpine の Persist プラグインを使用すると、ページの読み込み全体で Alpine の状態を永続化できます。

これは、検索フィルター、アクティブなタブ、およびページを更新したり、ページを離れて再訪した後に構成がリセットされた場合にユーザーがイライラするその他の機能を永続化する場合に役立ちます。

<a name="installation"></a>

## インストール

<!-- You can use this plugin by either including it from a `<script>` tag or installing it via NPM: -->

このプラグインは、`<script>`タグから取り込むか、NPM経由でインストールすることで使用できます。

### CDN経由

<!-- You can include the CDN build of this plugin as a `<script>` tag, just make sure to include it BEFORE Alpine's core JS file. -->

このプラグインのCDNビルドを `<script>` タグとして含めることができますが、Alpine のコア JS ファイルの前に必ず含めてください。

```alpine
<!-- Alpine Plugins -->
<script defer src="https://unpkg.com/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>

<!-- Alpine Core -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
```

### NPM 経由

<!-- You can install Persist from NPM for use inside your bundle like so: -->

次のように、バンドル内で使用するために NPM から Persist をインストールできます。

```shell
npm install @alpinejs/persist
```

Then initialize it from your bundle:

```js
import Alpine from 'alpinejs'
import persist from '@alpinejs/persist'

Alpine.plugin(persist)

...
```

<a name="magic-persist"></a>

## $persist

<!-- The primary API for using this plugin is the magic `$persist` method. -->

<!-- You can wrap any value inside `x-data` with `$persist` like below to persist its value across page loads: -->

このプラグインを使用するための主要な API は、魔法の `$persist` メソッドです。

以下のように `x-data` 内の任意の値を `$persist` でラップして、ページの読み込み間でその値を永続化できます。

```alpine
<div x-data="{ count: $persist(0) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ count: $persist(0) }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- In the above example, because we wrapped `0` in `$persist()`, Alpine will now intercept changes made to `count` and persist them across page loads. -->

<!-- You can try this for yourself by incrementing the "count" in the above example, then refreshing this page and observing that the "count" maintains its state and isn't reset to "0". -->

上記の例では、`0` を `$persist()` でラップしたため、Alpineは `count` に加えられた変更をインターセプトし、ページの読み込み全体でそれらを永続化します。

上記の例で「count」をインクリメントしてから、このページを更新し、「カウント」がその状態を維持し、「0」にリセットされないことを確認することで、これを自分で試すことができます。

<a name="how-it-works"></a>

## どのように機能しますか？

<!-- If a value is wrapped in `$persist`, on initialization Alpine will register its own watcher for that value. Now everytime that value changes for any reason, Alpine will store the new value in [localStorage](https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage). -->

<!-- Now when a page is reloaded, Alpine will check localStorage (using the name of the property as the key) for a value. If it finds one, it will set the property value from localStorage immediately. -->

<!-- You can observe this behavior by opening your browser devtool's localStorage viewer: -->

<!-- <a href="https://developer.chrome.com/docs/devtools/storage/localstorage/"><img src="/img/persist_devtools.png" alt="Chrome devtools showing the localStorage view with count set to 0"></a> -->

<!-- You'll observe that by simply visiting this page, Alpine already set the value of "count" in localStorage. You'll also notice it prefixes the property name "count" with "_x_" as a way of namespacing these values so Alpine doesn't conflict with other tools using localStorage. -->

<!-- Now change the "count" in the following example and observe the changes made by Alpine to localStorage: -->

値が `$persist` でラップされている場合、初期化時に Alpine はその値に対して独自のウォッチャーを登録します。これで、何らかの理由でその値が変更されるたびに、Alpineは新しい値を [localStorage](https://developer.mozilla.org/en-US/docs/Web/API/Window/localStorage) に保存します。

これで、ページがリロードされると、Alpine は localStorageを（プロパティの名前をキーとして使用して）値をチェックします。見つかった場合は、localStorage からプロパティ値をすぐに設定します。

この動作は、ブラウザの devtool の localStorage ビューアを開くことで確認できます。

<a href="https://developer.chrome.com/docs/devtools/storage/localstorage/"><img src="/img/persist_devtools.png" alt="Chrome devtools showing the localStorage view with count set to 0"></a>

このページにアクセスするだけで、Alpine は localStorage に「 count 」の値をすでに設定していることがわかります。また、これらの値の名前空間を設定する方法として、プロパティ名「 count 」の前に「 `_x_` 」を付けて、alpine が localStorage を使用する他のツールと競合しないようにします。

次に、次の例の「count」を変更し、Alpine によってlocalStorage に加えられた変更を確認します。

```alpine
<div x-data="{ count: $persist(0) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ count: $persist(0) }">
        <button x-on:click="count++">Increment</button>
        <span x-text="count"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

> `$persist` works with primitive values as well as with arrays and objects.
However, it is worth noting that localStorage must be cleared when the type of the variable changes.<br>
> Given the previous example, if we change count to a value of `$persist({ value: 0 })`, then localStorage must be cleared or the variable 'count' renamed.

> `$persist` は、配列やオブジェクトだけでなく、プリミティブ値でも機能します。
ただし、変数のタイプが変更された場合は、localStorage をクリアする必要があることに注意してください。

> 前の例で、count を `$persist({value：0})` の値に変更する場合は、localStorage をクリアするか、変数'count' の名前を変更する必要があります。

<a name="custom-key"></a>

## Setting a custom key

By default, Alpine uses the property key that `$persist(...)` is being assigned to ("count" in the above examples).

Consider the scenario where you have multiple Alpine components across pages or even on the same page that all use "count" as the property key.

Alpine will have no way of differentiating between these components.

In these cases, you can set your own custom key for any persisted value using the `.as` modifier like so:

カスタムキーの設定

デフォルトでは、Alpineは `$ persist（...）`が割り当てられているプロパティキー（上記の例では "count"）を使用します。

ページ間または同じページに複数のAlpineコンポーネントがあり、すべてがプロパティキーとして「count」を使用しているシナリオを考えてみます。

アルパインには、これらのコンポーネントを区別する方法がありません。

このような場合、次のように `.as`修飾子を使用して、永続化された値に独自のカスタムキーを設定できます。


```alpine
<div x-data="{ count: $persist(0).as('other-count') }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

Now Alpine will store and retrieve the above "count" value using the key "other-count".

Here's a view of Chrome Devtools to see for yourself:

これで、Alpineは、キー「other-count」を使用して上記の「count」値を保存および取得します。

自分で確認できるChromeDevtoolsのビューは次のとおりです。

<img src="/img/persist_custom_key_devtools.png" alt="Chrome devtools showing the localStorage view with count set to 0">

<a name="custom-storage"></a>

## Using a custom storage

By default, data is saved to localStorage, it does not have an expiration time and it's kept even when the page is closed.

Consider the scenario where you want to clear the data once the user close the tab. In this case you can persist data to sessionStorage using the `.using` modifier like so:

カスタムストレージの使用

デフォルトでは、データはlocalStorageに保存され、有効期限はなく、ページが閉じられても保持されます。

ユーザーがタブを閉じたらデータをクリアするシナリオを考えてみましょう。 この場合、次のように`.using`修飾子を使用してデータをsessionStorageに永続化できます。


```alpine
<div x-data="{ count: $persist(0).using(sessionStorage) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

You can also define your custom storage object exposing a getItem function and a setItem function. For example, you can decide to use a session cookie as storage doing so:

getItem関数とsetItem関数を公開するカスタムストレージオブジェクトを定義することもできます。 たとえば、セッションCookieをストレージとして使用することを決定できます。


```alpine
<script>
    window.cookieStorage = {
        getItem(key) {
            let cookies = document.cookie.split(";");
            for (let i = 0; i < cookies.length; i++) {
                let cookie = cookies[i].split("=");
                if (key == cookie[0].trim()) {
                    return decodeURIComponent(cookie[1]);
                }
            }
            return null;
        },
        setItem(key, value) {
            document.cookie = key+' = '+encodeURIComponent(value)
        }
    }
</script>

<div x-data="{ count: $persist(0).using(cookieStorage) }">
    <button x-on:click="count++">Increment</button>

    <span x-text="count"></span>
</div>
```

<a name="using-persist-with-alpine-data"></a>

## Using $persist with Alpine.data

If you want to use `$persist` with `Alpine.data`, you need to use a standard function instead of an arrow function so Alpine can bind a custom `this` context when it initially evaluates the component scope.

Alpine.dataで$persistを使用する

`$persist`を`Alpine.data`と一緒に使用する場合は、矢印関数の代わりに標準関数を使用する必要があります。これにより、Alpineは、コンポーネントスコープを最初に評価するときにカスタムの`this`コンテキストをバインドできます。

```js
Alpine.data('dropdown', function () {
    return {
        open: this.$persist(false)
    }
})
```

<a name="using-alpine-persist-global"></a>

## Using the Alpine.$persist global

`Alpine.$persist` is exposed globally so it can be used outside of `x-data` contexts. This is useful to persist data from other sources such as `Alpine.store`.

Alpineを使用します。$persistglobal

`Alpine。$persist`はグローバルに公開されるため、`x-data`コンテキストの外部で使用できます。 これは、`Alpine.store`などの他のソースからのデータを永続化するのに役立ちます。


```js
Alpine.store('darkMode', {
    on: Alpine.$persist(true).as('darkMode_on')
});
```