<?php

require('./vendor/autoload.php');

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;


// configure start ---------------------------------

// 1, Check target directory
$file_dir = "src/jp/";

// configure end ---------------------------------

$filelist = array(
    // Getting started
    'start-here.md',
    'upgrade-guide.md',
    'essentials/installation.md',
    'essentials/state.md',
    'essentials/templating.md',
    'essentials/events.md',
    'essentials/lifecycle.md',

    // Directives
    'directives/data.md',
    'directives/init.md',
    'directives/show.md',
    'directives/bind.md',
    'directives/on.md',
    'directives/text.md',
    'directives/html.md',
    'directives/model.md',
    'directives/modelable.md',
    'directives/for.md',
    'directives/transition.md',
    'directives/effect.md',
    'directives/ignore.md',
    'directives/ref.md',
    'directives/cloak.md',
    'directives/teleport.md',
    'directives/if.md',
    'directives/id.md',

    // Magics
    'magics/el.md',
    'magics/refs.md',
    'magics/store.md',
    'magics/watch.md',
    'magics/dispatch.md',
    'magics/nextTick.md',
    'magics/root.md',
    'magics/data.md',
    'magics/id.md',

    // UI
    // Globals
    'globals/alpine-data.md',
    'globals/alpine-store.md',
    'globals/alpine-bind.md',

    //  Plugins
    'plugins/mask.md',
    'plugins/intersect.md',
    'plugins/persist.md',
    'plugins/focus.md',
    'plugins/collapse.md',
    'plugins/morph.md',

    // Advanced
    'advanced/reactivity.md',
    'advanced/extending.md',
    'advanced/async.md',
    'advanced/csp.md',
);


$data = "";
foreach ($filelist as $file) {
    $filedata = file_get_contents($file_dir . $file);
    $filedata = str_replace("[[toc]]\n\n", "", $filedata);
    // $filedata = preg_replace("/import .*\n/", "",  $filedata);
    $filedata = preg_replace('/\-\-\-\n[\s\S]*?\-\-\-\n/', "\n", $filedata);
    // $filedata = preg_replace('/^---$(.)^---$/', '', $filedata);
    $data .= $filedata . "\n";
}


$converter = new GithubFlavoredMarkdownConverter([
    'html_input' => 'strip',
    'allow_unsafe_links' => true,
]);

$src = '
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/5.1.0/github-markdown.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/styles/default.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.6.0/highlight.min.js"></script>
        <script>hljs.highlightAll();</script>
        <style>
        .markdown-body h1 {
            margin-top:3rem;
            padding: 1rem;
            background-color: #efefef;
        }

        .markdown-body h1:first {
            margin-top:0rem;
        }

        .markdown-body menu,
        .markdown-body ol,
        .markdown-body ul 
        {
            list-style: disc;
        }

        .markdown-body .highlight pre, .markdown-body pre {
            padding: 6px;
            overflow: auto;
            font-size: 98%;
        }
        </style>
        <title>Publish html</title>
    </head>
    <body>
        <div class="markdown-body">
            ' . $converter->convert($data) . '
        </div>
    </body>
</html>
';


file_put_contents("publish_to_.md", $data);
file_put_contents("publish_to_.html", $src);
