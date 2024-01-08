<?php

namespace Classes\DataModel;
class LayoutDataModel
{
    private string $_pageName = "";
    private array $_body = [];
    private array $_includeCssTags = [];
    private array $_includeJS = [];
    private array $_includeJSText = [];

    public function getPageName(): string
    {
        return $this->_pageName;
    }

    public function setPageName(string $pageName): void
    {
        $this->_pageName = $pageName;
    }

    public function getBody(): array
    {
        return $this->_body;
    }

    public function GetIncludeJS(): array
    {
        return $this->_includeJS;
    }

    public function SetIncludeJS(array $includeJSLink): void
    {
        $this->_includeJS = $includeJSLink;
    }

    public function GetIncludeJSText(): array
    {
        return $this->_includeJSText;
    }

    public function SetIncludeJSText(array $includeJSText): void
    {
        $this->_includeJSText = $includeJSText;
    }

    public function AddBodySegment(string $bodySegment): void
    {
        $this->_body[] = $bodySegment;
    }

    public function getIncludeCssTags(): array
    {
        return $this->_includeCssTags;
    }

    public function IncludeCss(string $cssName): void
    {
        $this->_includeCssTags[] = "<link rel='stylesheet' href='/Css/$cssName.css'>";
    }

    public function IncludeJsLink(string $link): void
    {
        $this->_includeJS[] = <<<JS_LINK
            <script src="$link"></script>
        JS_LINK;
    }

    public function IncludeJsText(string $code): void
    {
        $this->_includeJS[] = <<<JS_LINK
            <script type="module">$code</script>
        JS_LINK;
    }
}