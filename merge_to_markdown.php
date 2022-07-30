<?php

require('./vendor/autoload.php');

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;


// configure start ---------------------------------

// 1, Check target directory
$file_dir = "src/ja/";

// configure end ---------------------------------

$filelist = array(
    // Getting started
    'introduction.md',
    'installation.md',
    'installation/react.md',
    'installation/nextjs.md',
    'installation/vue3.md',
    'installation/vue2.md',
    'installation/nuxt.md',
    'installation/svelte.md',
    'installation/alpine.md',
    'installation/php.md',
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
    'allow_unsafe_links' => false,
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
