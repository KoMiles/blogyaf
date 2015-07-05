yaf demo test
======================
## 记录yaf学习历程
方便yaf入门

## 查看文档效果
通过将生成的文档放到master分支中，可以通过链接<https://github.com/KoMiles/blogyaf>直接查看源码

## 贡献者
komiles@163.com

##如何在linux下面安装yaf

- 把项目中的yaf.so放在/usr/lib/php5/20121212/下面
```
cp yaf.so /usr/lib/php5/20121212/
```
- 在/etc/php5/cgi/conf.d/下面添加yaf.so
```
extension=yaf.so
```
- 修改yaf.so的权限
```
chmod -R 777 yaf.so
```
- 重启php-fpm
```
service php5-fpm restart
```
- 重启php-cgi
先杀死 kill -9 pid(php-cgi的进程)
```
php-cgi -b 127.0.0.1:9000
```


