---
order: 4
title: watch
---

# $watch

<!-- You can "watch" a component property using the `$watch` magic method. For example: -->

`$watch` マジックメソッドを使用して、コンポーネントプロパティを「watch (監視)」できます。例えば

```html
<div x-data="{ open: false }" x-init="$watch('open', value => console.log(value))">
    <button @click="open = ! open">Toggle Open</button>
</div>
```

<!-- In the above example, when the button is pressed and `open` is changed, the provided callback will fire and `console.log` the new value: -->

<!-- You can watch deeply nested properties using "dot" notation -->

上記の例では、ボタンが押されて `open` が変更されると、提供されたコールバックが起動し、`console.log` に新しい値が表示されます。

「ドット」表記を使用して、深くネストされたプロパティを監視できます

```html
<div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo.bar', value => console.log(value))">
    <button @click="foo.bar = 'bob'">Toggle Open</button>
</div>
```

<!-- When the `<button>` is pressed, `foo.bar` will be set to "bob", and "bob" will be logged to the console. -->

`<button>` を押すと、`foo.bar` が `bob` に設定され、`bob` がコンソールに記録されます。

<a name="getting-the-old-value"></a>

### 古い値を取得する

`$watch` は、監視されているプロパティの以前の値を追跡します。次のように、コールバックへのオプションの2番目の引数を使用してアクセスできます。

<!-- `$watch` keeps track of the previous value of the property being watched, You can access it using the optional second argument to the callback like so: -->

```html
<div x-data="{ open: false }" x-init="$watch('open', (value, oldValue) => console.log(value, oldValue))">
    <button @click="open = ! open">Toggle Open</button>
</div>
```

<a name="deep-watching"></a>

### ディープウォッチング

`$watch` は任意のレベルの変更を自動的に監視しますが、変更が検出されると、ウォッチャーは変更されたサブプロパティの値ではなく、監視されたプロパティの値を返すことに注意してください。

<!-- `$watch` will automatically watches from changes at any level but you should keep in mind that, when a change is detected, the watcher will return the value of the observed property, not the value of the subproperty that has changed. -->

```html
<div x-data="{ foo: { bar: 'baz' }}" x-init="$watch('foo', (value, oldValue) => console.log(value, oldValue))">
    <button @click="foo.bar = 'bob'">Update</button>
</div>
```

<!-- When the `<button>` is pressed, `foo.bar` will be set to "bob", and "{bar: 'bob'} {bar: 'baz'}" will be logged to the console (new and old value). -->

<!-- > ⚠️ Changing a property of a "watched" object as a side effect of the `$watch` callback will generate an infinite loop and eventually error.  -->

`<button>` を押すと、`foo.bar` が `bob` に設定され、"{bar: 'bob'} {bar: 'baz'}" がコンソールに記録されます（新旧の値）。

> ⚠️`$watch` コールバックの副作用として`watched` オブジェクトのプロパティを変更すると、無限ループが発生し、最終的にエラーが発生します。

```html
<!-- 🚫 Infinite loop -->
<div x-data="{ foo: { bar: 'baz', bob: 'lob' }}" x-init="$watch('foo', value => foo.bob = foo.bar)">
    <button @click="foo.bar = 'bob'">Update</button>
</div>
```
