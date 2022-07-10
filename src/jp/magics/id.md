---
order: 9
prefix: $
title: id
---

# $id

`$id` は、要素の ID を生成し、同じページ上の同じ名前の他の ID と競合しないようにするために使用できる魔法のプロパティです。

<!-- `$id` is a magic property that can be used to generate an element's ID and ensure that it won't conflict with other IDs of the same name on the same page. -->

このユーティリティは、ページ上で複数回発生する可能性のある再利用可能なコンポーネント（おそらくバックエンドテンプレート内）を構築し、ID 属性を利用する場合に非常に役立ちます。

<!-- This utility is extremely helpful when building re-usable components (presumably in a back-end template) that might occur multiple times on a page, and make use of ID attributes. -->

入力コンポーネント、モーダル、リストボックスなどはすべて、このユーティリティの恩恵を受けます。

<!-- Things like input components, modals, listboxes, etc. will all benefit from this utility. -->

<a name="basic-usage"></a>

## 基本的な使用法

ページに2つの入力要素があり、それらに相互に一意の ID を持たせたい場合は、次のように実行できます。

<!-- Suppose you have two input elements on a page, and you want them to have a unique ID from each other, you can do the following: -->

```html
<input type="text" :id="$id('text-input')">
<!-- id="text-input-1" -->

<input type="text" :id="$id('text-input')">
<!-- id="text-input-2" -->
```

<!-- As you can see, `$id` takes in a string and spits out an appended suffix that is unique on the page. -->

ご覧のとおり、`$id` は文字列を受け取り、ページ上で一意の追加されたサフィックスを吐き出します。

<a name="groups-with-x-id"></a>

## x-id によるグループ化

ここで、同じ2つの入力要素が必要であるが、今回はそれぞれに `<label>` 要素が必要であるとします。

これには問題があります。同じIDを2回参照できるようにする必要があります。 1つは `<label>` の `for` 属性用で、もう1つは入力の `id` 用です。

<!-- Now let's say you want to have those same two input elements, but this time you want `<label>` elements for each of them. -->

<!-- This presents a problem, you now need to be able to reference the same ID twice. One for the `<label>`'s `for` attribute, and the other for the `id` on the input. -->

<!-- Here is a way that you might think to accomplish this and is totally valid: -->

これを達成するためにあなたが考えるかもしれない方法はここにあり、完全に有効です

```html
<div x-data="{ id: $id('text-input') }">
    <label :for="id"> <!-- "text-input-1" -->
    <input type="text" :id="id"> <!-- "text-input-1" -->
</div>

<div x-data="{ id: $id('text-input') }">
    <label :for="id"> <!-- "text-input-2" -->
    <input type="text" :id="id"> <!-- "text-input-2" -->
</div>
```

<!-- This approach is fine, however, having to name and store the ID in your component scope feels cumbersome. -->

<!-- To accomplish this same task in a more flexible way, you can use Alpine's `x-id` directive to declare an "id scope" for a set of IDs: -->

このアプローチは問題ありませんが、ID に名前を付けてコンポーネントスコープに格納するのは面倒です。

これと同じタスクをより柔軟な方法で実行するために、Alpine の `x-id` ディレクティブを使用して、一連の ID の「 id スコープ 」を宣言できます。

```html
<div x-id="['text-input']">
    <label :for="$id('text-input')"> <!-- "text-input-1" -->
    <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->
</div>

<div x-id="['text-input']">
    <label :for="$id('text-input')"> <!-- "text-input-2" -->
    <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->
</div>
```

As you can see, `x-id` accepts an array of ID names. Now any usages of `$id()` within that scope, will all use the same ID. Think of them as "id groups".

ご覧のとおり、`x-id` は ID 名の配列を受け入れます。これで、そのスコープ内での `$id()` の使用は、すべて同じ ID を使用します。それらを「 id グループ」と考えてください。

<a name="nesting"></a>

## ネスト

直感的に理解できたかもしれませんが、次のように、これらの `x-id` グループを自由にネストできます。

<!-- As you might have intuited, you can freely nest these `x-id` groups, like so: -->

```html
<div x-id="['text-input']">
    <label :for="$id('text-input')"> <!-- "text-input-1" -->
    <input type="text" :id="$id('text-input')"> <!-- "text-input-1" -->

    <div x-id="['text-input']">
        <label :for="$id('text-input')"> <!-- "text-input-2" -->
        <input type="text" :id="$id('text-input')"> <!-- "text-input-2" -->
    </div>
</div>
```

<a name="keyed-ids"></a>

## キー付きID（ループ用）

ループ内で ID を識別するために、ID の末尾に追加のサフィックスを指定すると便利な場合があります。

このため、`$id()` は、生成された ID の最後にサフィックスとして追加されるオプションの2番目のパラメーターを受け入れます。

この必要性の一般的な例は、`aria-activedescendant` 属性を使用して、リスト内のどの要素が「アクティブ」であるかを支援技術に伝えるリストボックスコンポーネントのようなものです。

<!-- Sometimes, it is helpful to specify an additional suffix on the end of an ID for the purpose of identifying it within a loop. -->

<!-- For this, `$id()` accepts an optional second parameter that will be added as a suffix on the end of the generated ID. -->

<!-- A common example of this need is something like a listbox component that uses t
he `aria-activedescendant` attribute to tell 
assistive technologies which element is "active" in the list: -->

```html
<ul
    x-id="['list-item']"
    :aria-activedescendant="$id('list-item', activeItem.id)"
>
    <template x-for="item in items" :key="item.id">
        <li :id="$id('list-item', item.id)">...</li>
    </template>
</ul>
```

<!-- This is an incomplete example of a listbox, but it should still be helpful to demonstrate a scenario where you might need each ID in a group to still be unique to the page, but also be keyed within a loop so that you can reference individual IDs within that group. -->

これはリストボックスの不完全な例ですが、グループ内の各 ID がページに固有であるだけでなく、個々の ID を参照できるようにループ内でキー設定される必要があるシナリオを示すのに役立つはずです。そのグループ内。
