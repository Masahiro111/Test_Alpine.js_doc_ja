---
order: 1
title: data()
---

# Alpine.data

`Alpine.data(...)` provides a way to re-use `x-data` contexts within your application.

Here's a contrived `dropdown` component for example:

`Alpine.data（...）`は、アプリケーション内で`x-data`コンテキストを再利用する方法を提供します。

たとえば、考案された「ドロップダウン」コンポーネントを次に示します。

```alpine
<div x-data="dropdown">
    <button @click="toggle">...</button>

    <div x-show="open">...</div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,

            toggle() {
                this.open = ! this.open
            }
        }))
    })
</script>
```

As you can see we've extracted the properties and methods we would usually define directly inside `x-data` into a separate Alpine component object.

ご覧のとおり、通常は`x-data`内で直接定義するプロパティとメソッドを別のAlpineコンポーネントオブジェクトに抽出しました。

<a name="registering-from-a-bundle"></a>

## バンドルからの登録

Alpineコードのビルドステップを使用することを選択した場合は、次の方法でコンポーネントを登録する必要があります。

If you've chosen to use a build step for your Alpine code, you should register your components in the following way:

```js
import Alpine from `alpinejs`
import dropdown from './dropdown.js'

Alpine.data('dropdown', dropdown)

Alpine.start()
```

This assumes you have a file called `dropdown.js` with the following contents:

これは、次の内容の`dropdown.js`というファイルがあることを前提としています。

```js
export default () => ({
    open: false,

    toggle() {
        this.open = ! this.open
    }
})
```

<a name="initial-parameters"></a>

## 初期パラメータ

`Alpine.data`プロバイダーを名前でわかりやすく参照する（` x-data = "dropdown" `など）だけでなく、関数として参照することもできます（` x-data = "dropdown（）" `）。それらを関数として直接呼び出すことにより、次のように初期データオブジェクトを作成するときに使用される追加のパラメーターを渡すことができます。

In addition to referencing `Alpine.data` providers by their name plainly (like `x-data="dropdown"`), you can also reference them as functions (`x-data="dropdown()"`). By calling them as functions directly, you can pass in additional parameters to be used when creating the initial data object like so:

```alpine
<div x-data="dropdown(true)">
```
```js
Alpine.data('dropdown', (initialOpenState = false) => ({
    open: initialOpenState
}))
```

Now, you can re-use the `dropdown` object, but provide it with different parameters as you need to.

これで、 `dropdown`オブジェクトを再利用できますが、必要に応じてさまざまなパラメータを指定できます。

<a name="init-functions"></a>

## 初期化関数

コンポーネントに`init（）`メソッドが含まれている場合、Alpineはコンポーネントをレンダリングする前に自動的にそれを実行します。例えば：

If your component contains an `init()` method, Alpine will automatically execute it before it renders the component. For example:

```js
Alpine.data('dropdown', () => ({
    init() {
        // This code will be executed before Alpine
        // initializes the rest of the component.
    }
}))
```

<a name="using-magic-properties"></a>

## マジックプロパティを使用する

コンポーネントオブジェクトからマジックメソッドまたはプロパティにアクセスする場合は、`this`コンテキストを使用してアクセスできます。

If you want to access magic methods or properties from a component object, you can do so using the `this` context:

```js
Alpine.data('dropdown', () => ({
    open: false,

    init() {
        this.$watch('open', () => {...})
    }
}))
```

<a name="encapsulating-directives-with-x-bind"></a>

## `x-bind`を使用したディレクティブのカプセル化

コンポーネントのデータオブジェクト以外のものを再利用したい場合は、`x-bind`を使用してAlpineテンプレートディレクティブ全体をカプセル化できます。

以下は、`x-bind`を使用して前のドロップダウンコンポーネントのテンプレートの詳細を抽出する例です。

If you wish to re-use more than just the data object of a component, you can encapsulate entire Alpine template directives using `x-bind`.

The following is an example of extracting the templating details of our previous dropdown component using `x-bind`:

```alpine
<div x-data="dropdown">
    <button x-bind="trigger"></button>

    <div x-bind="dialogue"></div>
</div>
```

```js
Alpine.data('dropdown', () => ({
    open: false,

    trigger: {
        ['@click']() {
            this.open = ! this.open
        },
    },

    dialogue: {
        ['x-show']() {
            return this.open
        },
    },
}))
```
