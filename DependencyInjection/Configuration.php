<?php

namespace px\FormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('px_form');
        $this->addTinymce($rootNode);
        $this->addDate($rootNode);
        $this->addFile($rootNode);
        $this->addImage($rootNode);
        $this->addAutocompleter($rootNode);
        $this->addTokeninput($rootNode);
        $this->addAutocomplete($rootNode);
        $this->addSelect2($rootNode);

        return $treeBuilder;
    }

    /**
     * Add configuration Tinymce
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addTinymce(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('tinymce')
            ->canBeUnset()
            ->addDefaultsIfNotSet()
            ->treatNullLike(array('enabled' => true))
            ->treatTrueLike(array('enabled' => true))
            ->children()
            ->booleanNode('enabled')->defaultTrue()->end()
            ->scalarNode('theme')->defaultValue('advanced')->end()
            ->scalarNode('script_url')->end()
            ->variableNode('configs')->defaultValue(array())->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    /**
     * Add configuration Date
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addDate(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('date')
            ->canBeUnset()
            ->addDefaultsIfNotSet()
            ->treatNullLike(array('enabled' => true))
            ->treatTrueLike(array('enabled' => true))
            ->children()
            ->booleanNode('enabled')->defaultTrue()->end()
            ->variableNode('configs')->defaultValue(array())->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    /**
     * Add configuration File
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addFile(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('file')
            ->canBeUnset()
            ->treatNullLike(array('enabled' => true))
            ->treatTrueLike(array('enabled' => true))
            ->children()
            ->booleanNode('enabled')->defaultTrue()->end()
            ->scalarNode('swf')->isRequired()->end()
            ->scalarNode('cancel_img')->defaultValue('bundles/pxform/uploadify/uploadify-cancel.png')->end()
            ->scalarNode('folder')->defaultValue('/upload')->end()
            ->variableNode('configs')->defaultValue(array())->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    /**
     * Add configuration Image
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addImage(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('image')
            ->canBeUnset()
            ->treatNullLike(array('enabled' => true))
            ->treatTrueLike(array('enabled' => true))
            ->children()
            ->booleanNode('enabled')->defaultTrue()->end()
        ;
    }

    /**
     * Add configuration Tokeninput
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addTokeninput(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('tokeninput')
            ->canBeUnset()
            ->addDefaultsIfNotSet()
            ->children()
            ->booleanNode('doctrine')->defaultTrue()->end()
            ->booleanNode('mongodb')->defaultFalse()->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    /**
     * Add configuration Autocompleter
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addAutocompleter(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('autocompleter')
            ->canBeUnset()
            ->addDefaultsIfNotSet()
            ->children()
            ->booleanNode('doctrine')->defaultTrue()->end()
            ->booleanNode('mongodb')->defaultFalse()->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    /**
     * Add configuration Autocompleter
     *
     * @param ArrayNodeDefinition $rootNode
     */
    private function addAutocomplete(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('autocomplete')
            ->canBeUnset()
            ->treatNullLike(array('enabled' => true))
            ->treatTrueLike(array('enabled' => true))
            ->addDefaultsIfNotSet()
            ->children()
            ->booleanNode('enabled')->defaultFalse()->end()
            ->booleanNode('doctrine')->defaultTrue()->end()
            ->booleanNode('mongodb')->defaultFalse()->end()
            ->end()
            ->end()
            ->end()
        ;
    }

    private function addSelect2(ArrayNodeDefinition $rootNode)
    {
        $rootNode
            ->children()
            ->arrayNode('select2')
            ->canBeUnset()
            ->treatNullLike(array('enabled' => true))
            ->treatTrueLike(array('enabled' => true))
            ->addDefaultsIfNotSet()
            ->children()
            ->booleanNode('enabled')->defaultFalse()->end()
            ->arrayNode('configs')
            ->prototype('variable')
            ->end()
            ->end()
            ->end()
            ->end()
            ->end()
        ;
    }
}
