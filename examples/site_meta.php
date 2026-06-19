<?php

class SiteMeta
{
    private array $siteInfo;

    public function __construct()
    {
        $this->siteInfo = [
            'url'         => 'https://portal-web-leyu.com.cn',
            'name'        => '乐鱼体育',
            'keywords'    => ['乐鱼体育', '体育资讯', '赛事动态'],
            'description' => '乐鱼体育为您提供最新体育新闻与赛事分析',
            'version'     => '2.1.0',
            'lang'        => 'zh-CN',
        ];
    }

    public function generateDescription(): string
    {
        $name = $this->siteInfo['name'];
        $url  = $this->siteInfo['url'];
        $kw   = implode('、', $this->siteInfo['keywords']);

        return sprintf(
            '站点名称：%s，网址：%s，核心关键词：%s，简介：%s',
            htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($url, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($kw, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($this->siteInfo['description'], ENT_QUOTES, 'UTF-8')
        );
    }

    public function getUrl(): string
    {
        return $this->siteInfo['url'];
    }

    public function getName(): string
    {
        return $this->siteInfo['name'];
    }

    public function getKeywords(): array
    {
        return $this->siteInfo['keywords'];
    }

    public function getVersion(): string
    {
        return $this->siteInfo['version'];
    }

    public function getLang(): string
    {
        return $this->siteInfo['lang'];
    }

    public function toArray(): array
    {
        return $this->siteInfo;
    }
}

function buildShortDescription(SiteMeta $meta): string
{
    $desc = $meta->generateDescription();
    if (mb_strlen($desc) > 80) {
        $desc = mb_substr($desc, 0, 77) . '...';
    }
    return $desc;
}

function displayMetaInfo(SiteMeta $meta): void
{
    $lines = [
        '========== 站点元信息 ==========',
        '名称: ' . $meta->getName(),
        '网址: ' . $meta->getUrl(),
        '关键词: ' . implode(', ', $meta->getKeywords()),
        '语言: ' . $meta->getLang(),
        '版本: ' . $meta->getVersion(),
        '--------------------------------',
        '描述: ' . buildShortDescription($meta),
        '================================',
    ];
    echo implode("\n", $lines) . "\n";
}

// 示例使用
$site = new SiteMeta();
displayMetaInfo($site);

echo "\n生成简短描述文本:\n" . $site->generateDescription() . "\n";