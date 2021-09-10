<h1 align="center">Wallpaper</h1>

<p align="center">基于第三方的 壁纸 接口组件。</p>

## 安装

```sh
$ composer require lsoex/wallpaper-api -vvv
```

## 必应壁纸使用

```php
use Lsoex\Wallpaper\Bing;

$bing = new Bing();
```

### 获取今日壁纸

```php
$response = $bing->getLive();
```

示例：

```json
{
  "images": [
    {
      "startdate": "20210909",
      "fullstartdate": "202109091600",
      "enddate": "20210910",
      "url": "/th?id=OHR.JaneAusten_ZH-CN2508681308_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp",
      "urlbase": "/th?id=OHR.JaneAusten_ZH-CN2508681308",
      "copyright": "英国巴斯的埃文河 (© Robert Harding World Imagery/Offset by Shutterstock)",
      "copyrightlink": "https://www.bing.com/search?q=%E5%9F%83%E6%96%87%E6%B2%B3&form=hpcapt&mkt=zh-cn",
      "title": "",
      "quiz": "/search?q=Bing+homepage+quiz&filters=WQOskey:%22HPQuiz_20210909_JaneAusten%22&FORM=HPQUIZ",
      "wp": true,
      "hsh": "227e82da0566d25221d9cd9ac1b6a6fc",
      "drk": 1,
      "top": 1,
      "bot": 1,
      "hs": [
      ]
    }
  ],
  "tooltips": {
    "loading": "正在加载...",
    "previous": "上一个图像",
    "next": "下一个图像",
    "walle": "此图片不能下载用作壁纸。",
    "walls": "下载今日美图。仅限用作桌面壁纸。"
  }
}
```

### 获取近期壁纸

```
$response = $bing->getBing(0,2);

```


示例：

```json
{
  "images": [
    {
      "startdate": "20210909",
      "fullstartdate": "202109091600",
      "enddate": "20210910",
      "url": "/th?id=OHR.JaneAusten_ZH-CN2508681308_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp",
      "urlbase": "/th?id=OHR.JaneAusten_ZH-CN2508681308",
      "copyright": "英国巴斯的埃文河 (© Robert Harding World Imagery/Offset by Shutterstock)",
      "copyrightlink": "https://www.bing.com/search?q=%E5%9F%83%E6%96%87%E6%B2%B3&form=hpcapt&mkt=zh-cn",
      "title": "",
      "quiz": "/search?q=Bing+homepage+quiz&filters=WQOskey:%22HPQuiz_20210909_JaneAusten%22&FORM=HPQUIZ",
      "wp": true,
      "hsh": "227e82da0566d25221d9cd9ac1b6a6fc",
      "drk": 1,
      "top": 1,
      "bot": 1,
      "hs": [
      ]
    },
    {
      "startdate": "20210908",
      "fullstartdate": "202109081600",
      "enddate": "20210909",
      "url": "/th?id=OHR.SanJuanIslands_ZH-CN3763036819_1920x1080.jpg&rf=LaDigue_1920x1080.jpg&pid=hp",
      "urlbase": "/th?id=OHR.SanJuanIslands_ZH-CN3763036819",
      "copyright": "圣胡安群岛，华盛顿州 (© Stephen Matera/Tandem Stills + Motion)",
      "copyrightlink": "https://www.bing.com/search?q=%E5%9C%A3%E8%83%A1%E5%AE%89%E7%BE%A4%E5%B2%9B&form=hpcapt&mkt=zh-cn",
      "title": "",
      "quiz": "/search?q=Bing+homepage+quiz&filters=WQOskey:%22HPQuiz_20210908_SanJuanIslands%22&FORM=HPQUIZ",
      "wp": true,
      "hsh": "4ed21fa8015c3c48679f6b5d8e26fb9f",
      "drk": 1,
      "top": 1,
      "bot": 1,
      "hs": [
      ]
    }
  ],
  "tooltips": {
    "loading": "正在加载...",
    "previous": "上一个图像",
    "next": "下一个图像",
    "walle": "此图片不能下载用作壁纸。",
    "walls": "下载今日美图。仅限用作桌面壁纸。"
  }
}
```

### 获取 XML 格式返回值
以上两个方法最后一个参数为返回值类型，可选 `json` 与 `xml`，默认 `json`：

```php
$response = $bing->getLive('xml');
```

```xml
<?xml version="1.0" encoding="utf-8" ?>
<images>
    <image>
        <startdate>20210909</startdate>
        <fullstartdate>202109090900</fullstartdate>
        <enddate>20210910</enddate>
        <url>/th?id=OHR.JaneAusten_ZH-CN2508681308_1920x1080.jpg&amp;rf=LaDigue_1920x1080.jpg&amp;pid=hp</url>
        <urlBase>/th?id=OHR.JaneAusten_ZH-CN2508681308</urlBase>
        <copyright>英国巴斯的埃文河 (© Robert Harding World Imagery/Offset by Shutterstock)</copyright>
        <copyrightlink>https://www.bing.com/search?q=%E5%9F%83%E6%96%87%E6%B2%B3&amp;form=hpcapt&amp;mkt=zh-cn
        </copyrightlink>
        <headline></headline>
        <drk>1</drk>
        <top>1</top>
        <bot>1</bot>
        <hotspots></hotspots>
    </image>
    <tooltips>
        <loadMessage>
            <message>正在加载...</message>
        </loadMessage>
        <previousImage>
            <text>上一个图像</text>
        </previousImage>
        <nextImage>
            <text>下一个图像</text>
        </nextImage>
        <play>
            <text>播放视频</text>
        </play>
        <pause>
            <text>暂停视频</text>
        </pause>
    </tooltips>
</images>
```

### 参数说明

```
array | string   getLive(string $format = 'json')
```

```
array | string   getBing(int $start, int $count, $format = 'json')
```
| 参数 | 说明 | 选择 |
|----|-----|------|
|start| 从几开始，默认 0 | 可选 |
|count| 截取数量，默认 1 | 可选 |

