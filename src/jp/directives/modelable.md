---
order: 7
title: modelable
---

# x-modelable

<!-- `x-modelable` allows you to expose any Alpine property as the target of the `x-model` directive. -->

<!-- Here's a simple example of using `x-modelable` to expose a variable for binding with `x-model`. -->

`x-modelable` を使用すると、任意の Alpine プロパティを `x-model` ディレクティブのターゲットとして公開できます。

これは、`x-modelable` を使用して `x-model` とバインドするための変数を公開する簡単な例です。

```html
<div x-data="{ number: 5 }">
    <div x-data="{ count: 0 }" x-modelable="count" x-model="number">
        <button @click="count++">Increment</button>
    </div>

    Number: <span x-text="number"></span>
</div>
```

```html
<!-- START_VERBATIM -->
<div class="demo">
    <div x-data="{ number: 5 }">
        <div x-data="{ count: 0 }" x-modelable="count" x-model="number">
            <button @click="count++">Increment</button>
        </div>

        Number: <span x-text="number"></span>
    </div>
</div>
<!-- END_VERBATIM -->
```

<!-- As you can see the outer scope property "number" is now bound to the inner scope property "count". -->

<!-- Typically this feature would be used in conjunction with a backend templating framework like Laravel Blade. It's useful for abstracting away Alpine components into backend templates and exposing state to the outside through `x-model` as if it were a native input. -->

ご覧のとおり、外部スコープのプロパティ「number」は内部スコープのプロパティ「count」にバインドされています。

通常、この機能はLaravelBladeのようなバックエンドテンプレートフレームワークと組み合わせて使用されます。 これは、Alpine コンポーネントをバックエンドテンプレートに抽象化し、ネイティブ入力であるかのように `x-model` を介して状態を外部に公開するのに役立ちます。
