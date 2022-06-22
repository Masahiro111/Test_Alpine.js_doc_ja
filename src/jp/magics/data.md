---
order: 8
prefix: $
title: data
---

# $data

`$data` is a magic property that gives you access to the current Alpine data scope (generally provided by `x-data`).

Most of the time, you can just access Alpine data within expressions directly. for example `x-data="{ message: 'Hello Caleb!' }"` will allow you to do things like `x-text="message"`.

However, sometimes it is helpful to have an actual object that encapsulates all scope that you can pass around to other functions:

`$ data`は、現在のAlpineデータスコープ（通常は` x-data`によって提供されます）へのアクセスを提供する魔法のプロパティです。

ほとんどの場合、式内のアルパインデータに直接アクセスできます。 たとえば、 `x-data =" {message：'Hello Caleb！' } "`を使用すると、 `x-text="message"`のようなことができます。

ただし、他の関数に渡すことができるすべてのスコープをカプセル化する実際のオブジェクトがあると便利な場合があります。

```html
<div x-data="{ greeting: 'Hello' }">
    <div x-data="{ name: 'Caleb' }">
        <button @click="sayHello($data)">Say Hello</button>
    </div>
</div>

<script>
    function sayHello({ greeting, name }) {
        alert(greeting + ' ' + name + '!')
    }
</script>
```

<!-- START_VERBATIM -->
<div x-data="{ greeting: 'Hello' }" class="demo">
    <div x-data="{ name: 'Caleb' }">
        <button @click="sayHello($data)">Say Hello</button>
    </div>
</div>

<script>
    function sayHello({ greeting, name }) {
        alert(greeting + ' ' + name + '!')
    }
</script>
<!-- END_VERBATIM -->

Now when the button is pressed, the browser will alert `Hello Caleb!` because it was passed a data object that contained all the Alpine scope of the expression that called it (`@click="..."`).

Most applications won't need this magic property, but it can be very helpful for deeper, more complicated Alpine utilities.

これで、ボタンが押されると、ブラウザは `Hello Caleb！`を警告します。これは、ボタンを呼び出した式（ `@ click = "..." `）のすべてのAlpineスコープを含むデータオブジェクトが渡されたためです。

ほとんどのアプリケーションはこの魔法の特性を必要としませんが、より深く、より複雑なAlpineユーティリティには非常に役立ちます。
