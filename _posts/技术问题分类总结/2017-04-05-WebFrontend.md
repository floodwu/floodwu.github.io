---
layout: post
title:  "WebFrontend"
date: 2017-04-05 00:00:04
categories: 技术问题分类总结
tags: JavaScript
excerpt: ""
---

* content
{:toc}

## DOCTYPE
`<!DOCTYPE>` 声明`不是HTML标签`；它是指示web浏览器关于页面使用哪个HTML版本进行编写的指令。必须是HTML文档的第一行，位于`<html>`标签之前。没有结束标签。对大小写不敏感。
在HTML 4.01中有三种`<!DOCTYPE>`声明。在HTML5中只有一种：`<!DOCTYPE html>`
应该始终向HTML文档添加`<!DOCTYPE>`声明，这样浏览器才能获知文档类型。


## meat标签的http-equiv属性
http-equiv属性可用于模拟一个HTTP响应头。
```
// 设定网页的到期时间（一旦网页过期，必须到服务器上重新传输）
＜meta http-equiv="expires" content="Wed, 20 Jun 2007 22:33:00 GMT"＞

// 禁止浏览器从本地机的缓存中调阅页面内容（这样设定，访问者将无法脱机浏览）
＜meta http-equiv="Pragma" content="no-cache"＞

// 自动刷新并指向新页面（停留2秒钟后自动刷新到URL网址）
＜meta http-equiv="Refresh" content="2; URL=http://www.net.cn/"＞

// 设置Cookie（如果网页过期，那么存盘的cookie将被删除）
＜meta http-equiv="Set-Cookie" content="cookievalue=xxx;expires=Wednesday, 20-Jun-2007 22:33:00 GMT;path=/"＞ 

// 显示窗口的设定（强制页面在当前窗口以独立页面显示，防止别人在框架里调用自己的页面）
＜meta http-equiv="Window-target" content="_top"＞

// 设定页面使用的字符集
＜meta http-equiv="Content-Type" content="text/html; charset=gb2312"＞

// 网页等级评定
<meta http-equiv="Pics-label" contect="">
在IE的internet选项中有一项内容设置，可以防止浏览一些受限制的网站，而网站的限制级别就是通过meta属性来设置的。

// 设定进入页面时的特殊效果
<meta http-equiv="Page-Enter" contect="revealTrans(duration=1.0,transtion=12)">

// 设定离开页面时的特殊效果
<meta http-equiv="Page-Exit" contect="revealTrans(duration=1.0,transtion=12)">

// 清除缓存
<meta http-equiv="cache-control" content="no-cache">

// 关键字，给搜索引擎用的
<meta http-equiv="keywords" content="keyword1,keyword2,keyword3">

// 页面描述，给搜索引擎用的
<meta http-equiv="description" content="This is my page">
```

## CSS选择器总结
* 类型选择器、元素选择器、简单选择器
```css
p {color:black;}
```

* 后代选择器
```css
blockquote p{color:black;}
```

* ID选择器
```css
#intro{color:black;}
```

* 类选择器
```css
.intro{color:black;}
```

* 伪类
根据文档结构之外的其他条件对元素应用样式，例如表单元素或链接的状态
```css
tr:hover{background-color:red;}
input:focus{background-color:red;}
a:hover,a:focus,a:active{color:red;}
```
:link和:visited称为链接伪类，只能应用于锚元素。:hover、:active和:focus称为动态伪类，理论上可以应用于任何元素。
可以把伪类连接在一起，创建更复杂的行为：
```css
a:visited:hover{color:red;}
```

* 通用选择器
匹配所有可用元素
```css
*{
padding:0;
margin:0;
}
```
通用选择器与其他选择器结合使用时，可以用来对某个元素的所有后代应用样式。

* 子选择器
只选择元素的直接后代，而不是像后代选择器一样选择元素的所有后代。
```css
#nav>li{
padding-left:20px;
color:red;
}
```

* 相邻同胞选择器
用于定位同一个父元素下与某个元素相邻的下一个元素。
```css
h2 + p{
font-size:1.4em;
}
```

* 属性选择器
根据某个属性是否存在或者属性的值来寻找元素。
```css
abbr[title]{
border-bottom:1px dotted #999;
}

abbr[title]:hover{
cursor:help;
}

a[rel=’nofollow’]{
color:red;
}
```
注意：属性名无引号，属性值有引号。

对于属性可以有多个值的情况（空格分割），属性选择器允许根据属性值之一来寻找元素：
```css
.blogroll a[rel~=’co-worker’]{...}
```

## self=this
This question is not specific to jQuery, but specific to JavaScript in general. The core problem is how to "channel" a variable in embedded functions. This is the example:

```javascript
var abc = 1; // we want to use this variable in embedded functions

function xyz(){
  console.log(abc); // it is available here!
  function qwe(){
    console.log(abc); // it is available here too!
  }
  ...
};
```
This technique relies on using a closure. But it doesn't work with this because this is a pseudo variable that may change from scope to scope dynamically:
```javascript
// we want to use "this" variable in embedded functions

function xyz(){
  // "this" is different here!
  console.log(this); // not what we wanted!
  function qwe(){
    // "this" is different here too!
    console.log(this); // not what we wanted!
  }
  ...
};
```
What can we do? Assign it to some variable and use it through the alias:
```javascript
var self = this; // we want to use this variable in embedded functions

function xyz(){
  // "this" is different here! --- but we don't care!
  console.log(self); // now it is the right object!
  function qwe(){
    // "this" is different here too! --- but we don't care!
    console.log(self); // it is the right object here too!
  }
  ...
};
```
this is not unique in this respect: arguments is the other pseudo variable that should be treated the same way — by aliasing.


## 使用 [].slice.call将对象转换为数组的局限性
```javascript
var arrayLike = {
    '0': 'a',
    '1': 'b',
    '2': 'c',
    length: 3
};

var arr = [].slice.call(arrayLike); 
console.log(arr);  // ["a", "b", "c"]
```
被转换为数组的对象必须有length属性，所谓类似数组的对象，本质特征只有一点，即必须有length属性。

```javascript
var arrayLike = {
    '0': 'a',
    '1': 'b',
    '2': 'c'
};


var arr = [].slice.call(arrayLike); 
console.log(arr);  // []
```

## 解决jQuery不同版本之间、与其他js库之间的冲突
* 同一页面jQuery多个版本或冲突解决方法

```javascript
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
 <head>
 </head>
 <body>
     <!-- 引入 jquery 1.8.0 -->
     <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
     <script type="text/javascript">
         var $180 = $;
     </script>
     <!-- 引入 jquery 1.9.0 -->
     <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
     <script type="text/javascript">
         var $190 = $;
     </script>
     <!-- 引入 jquery 2.0.0 -->
     <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
     <script type="text/javascript">
         var $200 = $;
     </script>

    <script type="text/javascript">
         console.log($180.fn.jquery);
         console.log($190.fn.jquery);
         console.log($200.fn.jquery);
     </script>
 </body>
 </html>
```

* 同一页面jQuery和其他js库冲突解决方法
1）jQuery在其他js库之前
```javascript
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
 <head>
 </head>
 <body>
     <!-- 引入 jquery 1.8.0 -->
     <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
     <script type="text/javascript">
         var $180 = $;
         console.log($.fn.jquery);		# 1.8.0
     </script>
     <!-- 引入 其他库-->
     <script type="text/javascript">
         $ = {
             fn:{
                 jquery:"111cn.net"
             }
         };
     </script>

    <script type="text/javascript">        
         console.log($.fn.jquery);		# 111cn.net
         console.log($180.fn.jquery);		# 1.8.0
     </script>
 </body>
 </html>
```

2）jQuery在其他js库后
```javascript
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
 <head>
 </head>
 <body>
     <!-- 引入 其他库-->
     <script type="text/javascript">
         $ = {
             fn:{
                 jquery:"111cn.net"
             }
         };
     </script>
     <!-- 引入 jquery 1.8.0 -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
    <script type="text/javascript">    
         console.log($.fn.jquery);    	# 1.8.0
         var $180 = $.noConflict();
         console.log($.fn.jquery);		# 111cn.net
         console.log($180.fn.jquery);		# 1.8.0
     </script>
 </body>
 </html>
```


## JavaScript中__proto__与prototype的关系
__proto__ 对象的内部原型
prototype 构造函数的原型

* 所有函数/构造函数（包括内置的、自定义的）的__proto__都指向Function.prototype，它是一个空函数（Empty function）
```javascript
Number.__proto__ === Function.prototype  // true
```

Global对象的__proto__不能直接访问；
Arguments对象仅在函数调用时由JS引擎创建；
Math，JSON是以对象形式存在的，无需new，它们的__proto__是Object.prototype：
JSON.__proto__ === Object.prototype  // true

* 构造函数都来自于Function.prototype，包括Object及Function自身，因此都继承了Function.prototype的属性及方法。如length、call、apply、bind等

* Function.prototype也是唯一一个typeof XXX.prototype为 “function”的prototype。其它的构造器的prototype都是一个对象：
```javascript
console.log(typeof Function.prototype) // function  一个空函数
console.log(typeof Object.prototype)   // object
console.log(typeof Number.prototype)   // object
```

* Function.prototype的__proto__等于Object的prototype：
console.log(Function.prototype.__proto__ === Object.prototype) // true  体现了在Javascript中`函数也是一等公民`

* Object.prototype的__proto__为null
```javascript
Object.prototype.__proto__ === null  // true  到顶了
```

* 所有对象的__proto__都指向其构造器的prototype
```javascript
var obj = {name: 'jack'}
var arr = [1,2,3]
var reg = /hello/g

console.log(obj.__proto__ === Object.prototype) // true
console.log(arr.__proto__ === Array.prototype)  // true
console.log(reg.__proto__ === RegExp.prototype) // true

function Person(name) {
  this.name = name
}
var p = new Person('jack')
console.log(p.__proto__ === Person.prototype) // true
```javascript

* 每个对象都有一个`constructor属性`，可以获取它的构造器
```javascript
function Person(name) {
  this.name = name
}

Person.prototype.getName = function() {}  // 修改原型
var p = new Person('jack')
console.log(p.__proto__ === Person.prototype) // true
console.log(p.__proto__ === p.constructor.prototype) // true
```

* 使用对象字面量方式定义对象的构造函数，则对象的constructor的prototype可能不等于对象的__proto__
```javascript
function Person(name) {
  this.name = name
}
  
// 使用对象字面量方式定义的对象其constructor指向Object，Object.prototype是一个空对象{}
Person.prototype = {
  getName: function() {}
}
var p = new Person('jack')
console.log(p.__proto__ === Person.prototype) // true
console.log(p.__proto__ === p.constructor.prototype) // false
```

## JS中{}+[]和[]+{}的返回值
[] + {} 。一个数组加一个对象。
加法会进行隐式类型转换，规则是调用其 valueOf() 或 toString() 以取得一个非对象的值（primitive value）。如果两个值中的任何一个是字符串，则进行字符串串接，否则进行数字加法。
[] 和 {} 的 valueOf() 都返回对象自身，所以都会调用 toString()，最后的结果是字符串串接。[].toString() 返回空字符串，({}).toString() 返回“[object Object]”。最后的结果就是“[object Object]”。

{} + [] 。看上去应该和上面一样。但是 {} 除了表示一个对象之外，也可以表示一个空的 block。在 [] + {} 中，[] 被解析为数组，因此后续的 + 被解析为加法运算符，而 {} 就解析为对象。但在 {} + [] 中，{} 被解析为空的 block，随后的 + 被解析为正号运算符。即实际上成了：
{ // empty block }
+[]
即对一个空数组执行正号运算，实际上就是把数组转型为数字。首先调用 [].valueOf() 。返回数组自身，不是primitive value，因此继续调用 [].toString() ，返回空字符串。空字符串转型为数字，返回0，即最后的结果。


## js对象遍历顺序问题
```javascript
var a = {
  b:'a',
  10: "vv",
  1:"a",
  a:''
}
console.log(a);
```

Object:
 1:"a"
 10:"vv"
 a:""
 b:"a"

## JSONP的原理理解
JSONP是一种解决跨域传输JSON数据的问题的解决方案，是一种非官方跨域数据交互协议。
Ajax（或者说js）直接请求普通文件存在跨域无权限访问的问题，但是`Web页面上凡是拥有"src"属性的标签引用文件时则不受是否跨域的影响`。如果想通过纯web端（ActiveX控件、服务端代理、Websocket等方式不算）跨域访问数据就只有一种可能：在远程服务器上设法把数据装进js格式的文件里，供客户端调用和进一步处理。
为了便于客户端使用数据，逐渐形成了一种非正式传输协议:JSONP，该协议的一个要点就是`允许用户传递一个callback参数给服务端，然后服务端返回数据时会将这个callback参数作为函数名来包裹住JSON数据`，这样客户端就可以随意定制自己的函数来自动处理返回数据了。

例：使用Javascript实现JSONP
```html
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title></title>
<script type="text/javascript">
// 回调函数
  var flightHandler = function(data){
    alert('你查询的航班结果是：票价 ' + data.price + ' 元，' + '余票 ' + data.tickets + ' 张。');
  };

// 拼凑url
  var url = "http://flightQuery.com/jsonp/flightResult.aspx?code=CA1998&callback=flightHandler";

// 拼凑<script>标签，用于发出JSONP请求
  var script = document.createElement('script');
  script.setAttribute('src', url);
  document.getElementsByTagName('head')[0].appendChild(script);
</script>
</head>
<body>
</body>
</html>
```

服务器端返回格式：
```json
  flightHandler({
    "code": "CA1998",
    "price": 1780,
    "tickets": 5
 });
```

例：使用jQuery实现JSONP
```html

      <script type="text/javascript" src=jquery.min.js"></script>
      <script type="text/javascript">
     		jQuery(document).ready(function(){
        		$.ajax({
             		type: "get",
             		async: false,
             		url: "http://flightQuery.com/jsonp/flightResult.aspx?code=CA1998",
             		dataType: "jsonp",
             		jsonp: "callback",		// 传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(一般默认为:callback)
             		jsonpCallback:"flightHandler",		// 自定义的jsonp回调函数名称，没有定义的话会jQuery会自动生成以jQuery开头的函数
             		success: function(json){
                 		alert('您查询到航班信息：票价： ' + json.price + ' 元，余票： ' + json.tickets + ' 张。');
             		},
             		error: function(){
                 		alert('fail');
             		}
         		});
    		 });
     </script>
```
jquery在处理jsonp类型的ajax时自动生成回调函数并把数据（即不含函数名的纯json格式的数据）取出来供success属性方法来调用。



## AMD规范、requireJS理解
因为JavaScript本身的灵活性：框架没办法绝对的约束你的行为，一件事情总可以用多种途径去实现，所以我们只能在方法学上去引导正确的实施方法。
AMD规范：Asynchronous Module Definition，即异步模块加载机制。AMD规范简单到只有一个API，即define函数：
　　define([module-name?], [array-of-dependencies?], [module-factory-or-object]);
module-name: 模块标识，可以省略。
array-of-dependencies: 所依赖的模块，可以省略。
module-factory-or-object: 模块的实现，或者一个JavaScript对象。
当define函数执行时，它首先会异步地去调用第二个参数中列出的依赖模块，当所有的模块被载入完成之后，如果第三个参数是一个回调函数则执行，然后告诉系统模块可用，也就通知了依赖于自己的模块自己已经可用。
实例：

```javascript
	define("alpha", ["require", "exports", "beta"], function (require, exports, beta) {	// 依赖的模块做参数传入
　　	exports.verb = function() {	
　　		return beta.verb();
　　	}
　　});
```
requireJS例一：使用requirejs动态加载jquery
目录结构：
/web
/index.html				# 页面文件
/jquery-1.7.2.js			# jquery模块
/main.js					# js加载主入口，在引用require.js文件时通过data-main属性指定
/require.js				# requireJS文件

index.html文件内容：
```html
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <script data-main="main" src="require.js"></script>		# “main”指向模块加载入口文件main.js
    </head>
    <body>
  	...
    </body>
</html>
```
main.js文件内容：
```javascript
require.config({
    paths: {
        jquery: 'jquery-1.7.2'
    }
});
 
require(['jquery'], function($) {		
    alert($().jquery);
});
```
引用模块jquery，因为这里配置了jquery的paths参数，所以将使用参数所对应的值'jquery-1.7.2'（js后缀名省略）。
jQuery从1.7以后支持AMD规范，所以当jQuery作为一个AMD模块运行时，它的模块名是jquery（区分大小写）。
如果文件名'jquery-1.7.2'改为jquery，则无需配置path参数。

requireJS例二：使用自定义模块
目录结构：
/web
/js
/cache.js				# 自定义模块
/event.js				# 自定义模块
/main.js			
/selector.js			# 自定义模块
/index.html
/require.js

index.html文件内容：
```html
<html>
    <head>
        <meta charset="utf-8">
        <style type="text/css">
            p {
                width: 200px;
                background: gray;
            }
        </style>
    </head>
    <body>
        <p>p1</p><p>p2</p><p>p3</p><p>p4</p><p>p5</p>
        <script data-main="js/main" src="require.js"></script>
    </body>
</html>
```
cache模块内容：返回一个js对象
```javascript
	define(function() {
...
    return {
        set: function(el, key, val) {
            var c = ...;
            ...
            return c;
        },
        ...
    };
});
```
event模块内容：依赖于cache模块（define第一个参数为依赖的模块列表，第二个参数为一个函数，函数形参直接使用模块）
```javascript
define(['cache'], function(cache) {
    ...
    return {				# 返回一个js对象
        bind : bind,
        unbind : unbind,
        trigger : trigger
    };
});
```
selector模块内容：
```javascript
define(function() {
    function query(selector,context) {
        ...
    }
     
    return query;		# 返回一个js函数
});
```
main.js内容：
```javascript
require.config({
  baseUrl: 'js'
});

require(['selector', 'event'], function($, E) {		# 函数两个形参一一对应所依赖的两个模块
    var els = $('p');
    for (var i=0; i < els.length; i++) {
        E.bind(els[i], 'click', function() {
            alert(this.innerHTML);
        });
    }
});
```

## call()、apply()
call和apply都是为了改变某个函数运行时的context即上下文而存在的，换句话说，就是为了改变函数体内部this的指向。因为JavaScript 的函数存在`定义时上下文`和`运行时上下文`以及`上下文是可以改变的`这样的概念。

二者的作用完全一样，只是接受参数的方式不太一样。例如，有一个函数 func1 定义如下：
var func1 = function(arg1, arg2) {};
就可以通过 func1.call(this, arg1, arg2); 或者 func1.apply(this, [arg1, arg2]); 来调用。其中 this 是你想指定的上下文，他可以任何一个 JavaScript 对象(JavaScript 中一切皆对象)，call 需要把参数按顺序传递进去，而 apply 则是把参数放在数组里。

JavaScript 中，某个函数的参数数量是不固定的，因此要说适用条件的话，当你的参数是明确知道数量时，用 call，而不确定的时候，用 apply，然后把参数 push 进数组传递进去。当参数数量不确定时，函数内部也可以通过 arguments 这个数组来便利所有的参数。

call和apply是为了动态改变this而出现的，当一个object没有某个方法，但是其他的有，我们可以借助call或apply用其它对象的方法来操作。