<?php

namespace LarawireGarage\LarapexLivewire;

class LarapexBladeDirectives
{
    public static function larapexScripts($withCDN)
    {
        $service = new self;

        $jsPluginScript = $service->getPluginScript($service->resolveWithCDN($withCDN));

        $jsScripts = $service->getScripts();

        return <<<HTML
                {$jsPluginScript}
                {$jsScripts}
            HTML;
    }

    protected function minify($content)
    {
        return preg_replace('~(\v|\t|\s{2,})~m', '', $content);
    }
    protected function resolveWithCDN($value)
    {
        return !empty($withCDN)
            ? (in_array(\strtolower($withCDN), ["false", "'false'", "no", "'no'"]) ? false : true)
            : false;
    }

    protected function getPluginScript(bool $withCDN = false)
    {
        $jsChartCDN = <<<HTML
                            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                        HTML;

        $jsChartLocal = <<<HTML
                        <script src="{{ asset('vendor/larapex-livewire/apexcharts.js') }}"></script>
                    HTML;
        return !$withCDN && file_exists(public_path('vendor\larapex-livewire\apexcharts.js')) ? $jsChartLocal : $jsChartCDN;
    }
    protected function getScripts()
    {
        return $this->isLocalScriptExists() ? $this->getLocalScriptTags() : $this->getScriptsContent();
    }
    protected function getLocalScriptTags()
    {
        if (config('larapex-livewire.useBrowserEventListeners', false))
            $tags = <<<HTML
                    <script src="{{ asset('vendor/larapex-livewire/larapexScripts.js') }}"></script>
                    <script src="{{ asset('vendor/larapex-livewire/larapexLivewireEventListeners.js') }}"></script>
                HTML;
        else $tags = <<<HTML
                        <script src="{{ asset('vendor/larapex-livewire/larapexScripts.js') }}"></script>
                    HTML;
        return $tags;
    }

    private function getScriptsContent()
    {
        $content = $this->getEssentialScriptsContent();
        if (config('larapex-livewire.useBrowserEventListeners', false))
            $content .= $this->getLivewireListenersScriptsContent();
        return $content;
    }
    private function getEssentialScriptsContent()
    {
        return '<script>' . file_get_contents(__DIR__ . '/../resources/js/larapexScripts.js') . '</script>';
    }
    private function getLivewireListenersScriptsContent()
    {
        return '<script>' . file_get_contents(__DIR__ . '/../resources/js/larapexLivewireEventListeners.js') . '</script>';
    }

    protected function isLocalScriptExists()
    {
        return $this->isLocalEssentialScriptExists() && $this->isLocalLivewireListenersScriptExists();
    }
    private function isLocalEssentialScriptExists()
    {
        return file_exists(public_path('vendor\larapex-livewire\apexcharts.js'));
    }
    private function isLocalLivewireListenersScriptExists()
    {
        return file_exists(public_path('vendor\larapex-livewire\larapexLivewireEventListeners.js'));
    }
}
