<?php namespace Core\Engine;

use System\Models\Tools\Basic\GlobalValue;

/**
 * Fupma
 *
 * Classe responsável por gerenciar algumas das funções primordiais
 * para Views.
 *
 * 23/12/2017
 *
 */

/**
 * Class View
 * @package Core\Engine
 * @author Daniel Fiedler
 */
class View {

    /**
     * @param string $pathOfDependency
     * @param bool $isExternal
     */
    public static function loadJSDependence(string $pathOfDependency, $isExternal = false) {

        echo
            '
            <script src="',
            (
                !$isExternal
                    ? SERVER_LINK . JS_DIRECTORY.$pathOfDependency . '.js"'
                    : $pathOfDependency
            ),'></script>
            ';

    }

    /**
     * @param string $pathOfDependency
     * @param string $media
     * @param bool $isExternal
     */
    public static function loadCSSDependence(string $pathOfDependency, string $media = 'all', bool $isExternal = false) {

        echo
            '
            <link rel="stylesheet" type="text/css" href="',
            (
                !$isExternal
                    ? SERVER_LINK . CSS_DIRECTORY.$pathOfDependency . '.css'
                    : $pathOfDependency
            ),'" media="',$media,'">
            ';

    }

    /**
     * @param string $imagePath
     * @param string $class
     * @param string $moreParams
     * @param bool $isExternal
     */

    public static function loadImage (string $imagePath, string $class = '', $moreParams = '', bool $isExternal = false) {

        echo
        '
        <img src="',
        (
            !$isExternal
                ? SERVER_LINK . $imagePath
                : $imagePath
        ),
        '" class ="',$class,
        '" ',$moreParams,' >
        ';

    }

    /**
     * Automaticamente printa na tela um determinado valor dos valores globais em uma view
     * @param string $globalPath
     * @param string $pathSeparator
     */
    public static function printGlobalValue (string $globalPath, string $pathSeparator = '->') {

        echo GlobalValue::get($globalPath, $pathSeparator);

    }

    /**
     * Chama uma lista de dependencias JS automaticamente
     * @param array $requiredJSList
     */
    public static function loadJSList (array $requiredJSList) {

        foreach ($requiredJSList as $currentRequiredJS) {

            self::loadJSDependence($currentRequiredJS);

        }

    }

    /**
     * Chama uma lista de dependencias CSS automaticamente
     * @param array $requiredCSSList
     */
    public static function loadCSSList (array $requiredCSSList) {

        foreach ($requiredCSSList as $currentRequiredCSS) {

            self::loadCSSDependence($currentRequiredCSS);

        }

    }

}