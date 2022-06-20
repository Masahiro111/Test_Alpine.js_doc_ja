---
order: 8
title: for
---

# x-for

<!-- Alpine's `x-for` directive allows you to create DOM elements by iterating through a list. Here's a simple example of using it to create a list of colors based on an array. -->

Alpine の `x-for` ディレクティブを使用すると、リストを反復処理してDOM要素を作成できます。これを使用して、配列に基づいて色のリストを作成する簡単な例を次に示します。

```html
<ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
    <template x-for="color in colors">
        <li x-text="color"></li>
    </template>
</ul>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
        <template x-for="color in colors">
            <li x-text="color"></li>
        </template>
    </ul>
</div>
<!-- END_VERBATIM -->
```

<!-- There are two rules worth noting about `x-for`: -->

<!-- * `x-for` MUST be declared on a `<template>` element -->
<!-- * That `<template>` element MUST have only one root element -->

`x-for` について注目する価値のある2つのルールがあります。

* `x-for`は `<template>` 要素で宣言する必要があります
* その `<template>` 要素は1つのルート要素のみを持たなければなりません

<a name="keys"></a>

## Keys

<!-- It is important to specify unique keys for each `x-for` iteration if you are going to be re-ordering items. Without dynamic keys, Alpine may have a hard time keeping track of what re-orders and will cause odd side-effects. -->

アイテムを並べ替える場合は、`x-for` の反復ごとに一意のキーを指定することが重要です。動的キーがないと、Alpine は何が並べ替えられるかを追跡するのに苦労し、奇妙な副作用を引き起こす可能性があります。

```alpine
<ul x-data="{ colors: [
    { id: 1, label: 'Red' },
    { id: 2, label: 'Orange' },
    { id: 3, label: 'Yellow' },
]}">
    <template x-for="color in colors" :key="color.id">
        <li x-text="color.label"></li>
    </template>
</ul>
```

<!-- Now if the colors are added, removed, re-ordered, or their "id"s change, Alpine will preserve or destroy the iterated `<li>`elements accordingly. -->

これで、色が追加、削除、並べ替えられた場合、またはそれらの「id」が変更された場合、Alpineはそれに応じて繰り返される `<li>` 要素を保持または破棄します。

<a name="accessing-indexes"></a>

## インデックスへのアクセス

<!-- If you need to access the index of each item in the iteration, you can do so using the `([item], [index]) in [items]` syntax like so: -->

反復で各アイテムのインデックスにアクセスする必要がある場合は、次のようにしてアクセスできます。例：「 `(color, index) in colors` 」

```html
<ul x-data="{ colors: ['Red', 'Orange', 'Yellow'] }">
    <template x-for="(color, index) in colors">
        <li>
            <span x-text="index + ': '"></span>
            <span x-text="color"></span>
        </li>
    </template>
</ul>
```

<!-- You can also access the index inside a dynamic `:key` expression. -->

動的な `:key` 式内のインデックスにアクセスすることもできます。

```alpine
<template x-for="(color, index) in colors" :key="index">
```

<a name="iterating-over-a-range"></a>

## 範囲を反復する

配列を反復処理するのではなく、単に `n` 回ループする必要がある場合、Alpine は短い構文を提供します。

```html
<ul>
    <template x-for="i in 10">
        <li x-text="i"></li>
    </template>
</ul>
```

`i` in this case can be named anything you like.

この場合の `i` には、好きな名前をつけることができます。