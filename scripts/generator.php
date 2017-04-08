<?php


$aboutme = '../page/4aboutme.html';

$content = '---
layout: default
title: 关于
permalink: /aboutme/
icon: about
type: page
---

<div class="page clearfix">
    <div class="left">
        <h1>{{page.title}}</h1>
        <hr>
        
        <p>这是woojean的个人博客。</p>
        <p>QQ:168056828</p>

        <p>最后更新时间：$updatedat$</p>
    </div>
    
    <button class="anchor"><i class="fa fa-anchor"></i></button>
</div>
';

$updatedat = date('Y-m-d H:i:s',time());

$content = str_replace('$updatedat$', $updatedat, $content);

file_put_contents($aboutme, $content);



