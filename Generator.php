<?php

namespace generator;

class GeneratorXml
{
    private string $priority;
    private string|bool $lastmod;

    // remote site
    private string $siteAddress;
    // path to .xml file
    private $xmlPath;

    /**
     * @return string
     */
    public function getSiteAddress(): string
    {
        return $this->siteAddress;
    }

    /**
     * @return mixed
     */
    public function getXmlPath(): mixed
    {
        return $this->xmlPath;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * @return bool|string
     */
    public function getLastmod(): bool|string
    {
        return $this->lastmod;
    }

    public function __construct($priority, $lastmod, $xmlPath, $siteAddress)
    {
        $this->priority = $priority;
        $this->lastmod = $lastmod;
        $this->xmlPath = fopen($xmlPath, 'w');
        $this->siteAddress = $siteAddress;
    }

    /**
     *
     * @param $json
     */
    public function parseJson($json): void
    {
        $url = json_decode($json);
        foreach ($url as $key => $value) {
            $this->writeUrls($value, $key);
        }
    }

    /**
     * @param $urlArray
     * @param $part
     * @param null $lastPart
     */
    public function writeUrls($urlArray, $part, $lastPart = null): void
    {
        if ($lastPart) {
            $lastPart .= "/" . $part;
        } else {
            $lastPart .= $part;
        }
        $link = $this->siteAddress . "/" . $lastPart . "/";
        $this->writeUrl($link);

        foreach ($urlArray as $nextPart => $value) {
            if (is_array($value)) {
                $this->writeUrls($value, $nextPart, $lastPart);
            } else {
                if (is_object($value)) {
                    foreach ($value as $objectPart => $nextValue) {
                        $objectNextPart = $lastPart . "/" . $nextPart;
                        $this->writeUrls($nextValue, $objectPart, $objectNextPart);
                    }
                } else {
                    $link = $this->siteAddress . "/" . $lastPart . "/" . $value . ".html";
                    $this->writeUrl($link);
                }
            }
        }
    }

    /**
     * @param $link
     */
    private function writeUrl($link): void
    {
        $content = '<url> <loc>' . $link . '</loc> <lastmod>' . $this->lastmod . '</lastmod> <priority>' . $this->priority . '</priority> </url>';
        fwrite($this->xmlPath, $content);
    }

}
