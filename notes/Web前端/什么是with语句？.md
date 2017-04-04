# 什么是with语句？

with 语句的作用是将代码的作用域设置到一个特定的对象中。 with 语句的语法如下：
with (expression) statement;
定义 with 语句的目的主要是为了简化多次编写同一个对象的工作，如下面的例子所示：
var qs = location.search.substring(1);
var hostName = location.hostname;
var url = location.href;
上面几行代码都包含 location 对象。如果使用 with 语句，可以把上面的代码改写成如下所示：
with(location){
var qs = search.substring(1);
var hostName = hostname;
var url = href;
}
这意味着在 with 语句的代码块内部，每个变量首先被认为是一个局部变量，而如果在局部环境中找不到该变量的定义，就会查询location 对象中是否有同名的属性。如果发现了同名属性，则以 location 对象属性的值作为变量的值。