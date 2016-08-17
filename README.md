# URL Shortener / URL缩短器
A simple url shortener.

一个简单的URL Shortener。

## How to install
Create a table called `urls` in your database.
```sql
CREATE TABLE urls (id BIGINT PRIMARY KEY AUTO_INCREMENT, target_url LONGTEXT);
```

Modify `include/db.php`.

Modify `index.php`, change line 69 to 
```js
$("#success span").text("{Your server address}?h=" + data.id.toString(16));
```

## 如何安装
在你的数据库中创建一个叫做`urls`的表。
```sql
CREATE TABLE urls (id BIGINT PRIMARY KEY AUTO_INCREMENT, target_url LONGTEXT);
```

修改 `include/db.php`.

修改 `index.php`, 将第69行改成
```js
$("#success span").text("{你的服务器地址}?h=" + data.id.toString(16));
```

## Speed coding video / Actual time ~1.7hrs.

## 快速编程视频 / 实际时间 ~1.7小时
