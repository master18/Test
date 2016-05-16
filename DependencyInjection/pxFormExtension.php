<?php

namespace px\FormBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerInterface;
/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class pxFormExtension extends Extension
{
    /**
     * Responds to the px_form configuration parameter.
     *
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $configs = $this->processConfiguration(new Configuration(), $configs);
        $loader->load('twig.xml');
        $loader->load('form.xml');
        foreach (array('tinymce', 'date', 'file','select2') as $type) {
            if (isset($configs[$type]) && !empty($configs[$type]['enabled'])) {
                $method = 'register' . ucfirst($type) . 'Configuration';
                $this->$method($configs[$type], $container);
            }
        }
        $this->loadExtendedTypes('px.form.jquery.type.chosen', 'chosen', $container);
    }



    /**
     * Loads Tinymce configuration
     *
     * @param array            $config    A configuration array
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    private function registerTinymceConfiguration(array $configs, ContainerBuilder $container)
    {
        if (isset($configs['script_url']) && !empty($configs['script_url'])) {
            $configs['configs'] = array_merge($configs['configs'], array(
                'script_url' => $configs['script_url']
            ));
        }

        if (isset($configs['theme']) && !empty($configs['theme'])) {
            $configs['configs'] = array_merge($configs['configs'], array(
                'theme' => $configs['theme']
            ));
        }
        $container->setParameter('px.form.tinymce.configs', $configs['configs']);
    }

    /**
     * Loads Date configuration
     *
     * @param array            $config    A configuration array
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    private function registerDateConfiguration(array $configs, ContainerBuilder $container)
    {
        $container->setParameter('px.form.date.options', $configs['configs']);
    }

    /**
     * Loads File configuration
     *
     * @param array            $config    A configuration array
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    private function registerFileConfiguration(array $configs, ContainerBuilder $container)
    {
        $rootDir = $container->getParameter('px.form.file.root_dir');
        $rootDir = $container->getParameterBag()->resolveValue($rootDir);

        $uploadDir = $rootDir . '/' . $configs['folder'];
        if (!is_dir($uploadDir) && false === @mkdir($uploadDir, 0777, true)) {
            throw new \RuntimeException(sprintf('Could not create upload directory "%s".', $uploadDir));
        }
        $configs['configs'] = array_merge($configs['configs'], array(
            'script'    => 'px_upload',
            'swf'       => $configs['swf'],
            'cancelImg' => $configs['cancel_img'],
            'folder'    => $configs['folder']
        ));

        $container->setParameter('px.form.file.folder', $configs['folder']);
        $container->setParameter('px.form.file.upload_dir', $rootDir . '/' . $configs['folder']);
        $container->setParameter('px.form.file.options', $configs['configs']);
    }
    private function registerSelect2Configuration(array $configs, ContainerBuilder $container)
    {
        $serviceId = 'px.form.jquery.type.select2';
        foreach (array_merge($this->getChoiceTypeNames(), array('hidden')) as $type) {
            $typeDef = new DefinitionDecorator($serviceId);
            $typeDef
                ->addArgument($type)
                ->addArgument($configs['configs'])
                ->addTag('form.type', array('alias' => 'px_select2_'.$type))
            ;

            $container->setDefinition($serviceId.'.'.$type, $typeDef);
        }
    }

    /**
     * Loads extended form types.
     *
     * @param string           $serviceId Id of the abstract service
     * @param string           $name      Name of the type
     * @param ContainerBuilder $container A ContainerBuilder instance
     */
    private function loadExtendedTypes($serviceId, $name, ContainerBuilder $container)
    {
        foreach ($this->getChoiceTypeNames() as $type) {
            $typeDef = new DefinitionDecorator($serviceId);
            $typeDef->addArgument($type)->addTag('form.type', array('alias' => 'px_'.$name.'_'.$type));

            $container->setDefinition($serviceId.'.'.$type, $typeDef);
        }
    }

    private function getChoiceTypeNames()
    {
        return array('choice', 'language', 'country', 'timezone', 'locale', 'entity', 'document', 'model', 'currency');
    }
}
