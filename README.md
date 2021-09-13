<h1 align="center">Wallpaper Api</h1>

<p align="center">基于第三方的 壁纸 接口组件。</p>

## 安装

```sh
$ composer require lsoex/wallpaper-api -vvv
```

## 必应壁纸

```php
use Lsoex\Wallpaper\Bing;

$bing = new Bing();
```

### 获取今日壁纸

```php
$response = $bing->getLive();
```

### 获取近期壁纸

```php
$response = $bing->getBing($start,$count);
```

### 获取 XML 格式返回值

以上两个方法最后一个参数为返回值类型，可选 `json` 与 `xml`，默认 `json`：

```php
$response = $bing->getLive('xml');
```

### 参数说明

| 参数 | 说明 | 选择 |
|----|-----|------|
|start| 从几开始，默认 0 | 可选 |
|count| 截取数量，默认 1 | 可选 |

## 360壁纸
```php 
use Lsoex\Wallpaper\Zero;

$zero = new Zero();
```
### 获取壁纸分类
```php 
$response = $zero->getCategories();
```

### 根据壁纸分类ID获取分类下壁纸图片
```php 
$response = $zero->getAppsByCategory($cid,$page,$count)
```

### 获取最新壁纸
```php 
$response = $zero->getAppsNews($page,$count)
```

### 参数说明
| 参数 | 说明 | 选择 |
|----|-----|------|
|cid| 获取到的分类ID | 必填 |
|page| 分页从几开始，默认 1 | 可选 |
|count| 截取数量，默认 10 | 可选 |

欢迎点评→[issue](https://github.com/lsoex/wallpaper-api/issues)
