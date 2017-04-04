# php.ini中用来控制文件上传的指令有哪些？

1）file_uploads：控制是否允许http方式的文件上传，默认为ON
2）upload_tmp_dir：指定被上传的文件在被处理之前的临时存放目录，如果没有配置，将使用系统默认值
3）upload_max_filesize：控制允许上传的文件的大小，如果文件大小大于该值，将创建一个文件大小为0的占位符文件，默认为2M
4）post_max_size：控制可接受的，通过POST方法上传数据的最大值。