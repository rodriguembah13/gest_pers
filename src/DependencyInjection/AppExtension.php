<?php

/*
 * This file is part of the Kimai time-tracking app.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DependencyInjection;

use App\Util\Constants;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This class that loads and manages the gest configuration and container parameter.
 */
class AppExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        try {
            $config = $this->processConfiguration($configuration, $configs);
        } catch (InvalidConfigurationException $e) {
            trigger_error('Found invalid "gest" configuration: '.$e->getMessage());
            throw $e;
        }




        $config['invoice']['documents'] = array_merge($config['invoice']['documents'], $config['invoice']['defaults']);
        unset($config['invoice']['defaults']);

        // safe alternatives to %kernel.project_dir%
       // $container->setParameter('gest.data_dir', $config['data_dir']);
        //$container->setParameter('gest.plugin_dir', $config['plugin_dir']);

        $this->setLanguageFormats($config['languages'], $container);
        unset($config['languages']);

        // translation files, which can overwrite the default kimai translations
        $localTranslations = [];
        /*if (null !== $config['theme']['branding']['translation']) {
            $localTranslations[] = $config['theme']['branding']['translation'];
        }
        if (null !== $config['industry']['translation']) {
            $localTranslations[] = $config['industry']['translation'];
        }*/
        $container->setParameter('gest.i18n_domains', $localTranslations);

        // this should happen always at the end, so bundles do not mess with the base configuration
     /*   if ($container->hasParameter('gest.bundles.config')) {
            $bundleConfig = $container->getParameter('gest.bundles.config');
            if (!is_array($bundleConfig)) {
                trigger_error('Invalid bundle configuration found, skipping all bundle configuration');
            }
            foreach ($bundleConfig as $key => $value) {
                if (array_key_exists($key, $config)) {
                    trigger_error(sprintf('Invalid bundle configuration "%s" found, skipping', $key));
                    continue;
                }
                $config[$key] = $value;
            }
        }*/
        $container->setParameter('gest.config', $config);
    }

    protected function setLanguageFormats(array $config, ContainerBuilder $container)
    {
        $locales = explode('|', $container->getParameter('app_locales'));

        // make sure all allowed locales are registered
        foreach ($locales as $locale) {
            if (!array_key_exists($locale, $config)) {
                $config[$locale] = $config[Constants::DEFAULT_LOCALE];
            }
        }

        // make sure all keys are registered for every locale
        foreach ($config as $locale => $settings) {
            if (Constants::DEFAULT_LOCALE === $locale) {
                continue;
            }
            // pre-fill all formats with the default locale settings
            $config[$locale] = array_merge($config[Constants::DEFAULT_LOCALE], $config[$locale]);
        }

        $container->setParameter('gest.languages', $config);
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return 'gest';
    }
}
