<?php

require_once "vendor/autoload.php";

use RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace;
use Symfony\Component\Finder\Finder;
use Symfony\Component\DomCrawler\Crawler;

class SvgIconCleaner
{
    const RESOURCE_DIR = "resources/svg";

    protected $attrsNotRequired = [
        "id",
        "class",
        "width",
        "height",
    ];

    protected $replacePatterns = [
        '/\s(id=\"[a-zA-Z0-9_]+\")/' => '',
        '/\s(style=\"[a-z\s\-\\;:A-Z0-9_]+\")/' => '',
        '/\s(class=\"[a-zA-Z0-9]+\")/' => '',
        '/\s(height=\"[0-9]+\")/' => '',
        '/\s(width=\"[0-9]+\")/' => '',
        '/\<\?xml.*\?\>/' => '',
    ];

    private function removeAttributes()
    {
        $finder = new Finder();
        $finder->files()->in(self::RESOURCE_DIR);
        foreach ($finder as $file) {
            $text = $file->getContents();
            $newtext = preg_replace(array_keys($this->replacePatterns), array_values($this->replacePatterns), $text);
            if ($text !== $newtext) {
                file_put_contents($file->getRealPath(), $newtext);
            }
        }
    }

    private function replaceSolidPatterns($svgText)
    {

        // check if exists
        preg_match('/<svg.*(fill\=\"currentColor\".*?>)/', $svgText, $matches);

        if (count($matches) == 2 && isset($matches[0])) {
            return false;
        }

        // replace it

        preg_match('/<svg.*?>/', $svgText, $matches);

        if (count($matches) > 0 && isset($matches[0])) {
            $source = $matches[0];
            $replacement = str_replace('>', ' fill="currentColor">', $source);
            $svgText = str_replace($source, $replacement, $svgText);
        }
        return $svgText;
    }

    //fill="none" stroke="currentColor"
    private function replaceOutlinePatterns($svgText)
    {

        // check if exists
        preg_match('/<svg.*(fill\=\"none\"\sstroke\=\"currentColor\".*?>)/', $svgText, $matches);

        if (count($matches) == 2 && isset($matches[0])) {
            return false;
        }

        // replace it

        preg_match('/<svg.*?>/', $svgText, $matches);

        if (count($matches) > 0 && isset($matches[0])) {
            $source = $matches[0];
            $replacement = str_replace('>', ' fill="none" stroke="currentColor">', $source);
            $svgText = str_replace($source, $replacement, $svgText);
        }
        return $svgText;
    }

    private function addAttributes()
    {
        // for solid icons
        $finder = new Finder();
        $finder->files()->in(self::RESOURCE_DIR)->name('*.svg');
        foreach ($finder as $file) {
            $changedText = $this->replaceSolidPatterns($file->getContents());
            if ($changedText !== false) {
                file_put_contents($file->getRealPath(), $changedText);
            } else {
                echo 'no changes'.PHP_EOL;
            }
        }
    }

    private function minifySvg($svg)
    {
        return (new CollapseWhitespace())->apply($svg);
    }

    private function cleanUp()
    {
        $finder = new Finder();
        $finder->files()->in(self::RESOURCE_DIR)->name('*.svg');
        foreach ($finder as $file) {
            $changedText = $this->minifySvg($file->getContents());
            if ($changedText !== false) {
                file_put_contents($file->getRealPath(), $changedText);
            } else {
                echo 'no changes'.PHP_EOL;
            }
        }
    }

    public function process()
    {
        $this->cleanUp();

        $this->removeAttributes();

        $this->addAttributes();
    }
}
$svgCleaner = new SvgIconCleaner();
$svgCleaner->process();
