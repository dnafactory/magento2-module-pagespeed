<?php


namespace DNAFactory\PageSpeed\Plugin\Controller\Result;


use DNAFactory\PageSpeed\Management\ConfigManager;
use Magento\Framework\App\Response\Http;
use Magento\Framework\RequireJs\Config;

class DeferRequireJsPlugin
{
    /**
     * @var ConfigManager
     */
    protected $configManager;

    /**
     * @param ConfigManager $configManager
     */
    public function __construct(
        ConfigManager $configManager
    ){
        $this->configManager = $configManager;
    }

    /**
     * @param Http $subject
     * @return void
     */
    public function beforeSendResponse(Http $subject): void
    {
        if(!$this->configManager->isDeferRequireJsEnabled())
            return;

        $content = $subject->getContent();

        if (\is_string($content) && strpos($content, '<!-- __require.js.deferral__ -->') !== false ) {
            $requirejsPath = Config::REQUIRE_JS_FILE_NAME;
            $pattern = $this->getSearchPattern($requirejsPath);
            $content = preg_replace($pattern, '$1 async requirejs-src=$2', $content);

            $configFiles = [
                Config::MIXINS_FILE_NAME,
                Config::CONFIG_FILE_NAME,
                Config::STATIC_FILE_NAME,
                Config::MIN_RESOLVER_FILENAME,
                Config::MAP_FILE_NAME,
                Config::URL_RESOLVER_FILE_NAME
            ];
            foreach ($configFiles as $configFile){
                $pattern = $this->getSearchPattern($configFile);
                $content = preg_replace($pattern, '$1 defer requirejs-dep-src=$2', $content);
                $content = preg_replace('/require\(\[/', '__dcr([', $content);
            }

            $subject->setContent($content);
        }
    }

    protected function getSearchPattern($fileName){
        $fileName = str_replace('/','\/', $fileName);
        $fileName = str_replace('.','\.', $fileName);
        $fileName = str_replace('\.js','\.(min\.)*js', $fileName);
        return '@(<script.+)src=([\\\'\"](?<url>.*'.$fileName.').+<\/script>)@';
    }
}
