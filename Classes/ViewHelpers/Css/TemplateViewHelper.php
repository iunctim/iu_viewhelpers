<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2009 Michael Knoll <mimi@kaktusteam.de>, MKLV GbR
 *
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/



namespace Iunctim\IuViewhelpers\ViewHelpers\Css;

use TYPO3\CMS\Extbase\Service\ExtensionService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Error;

/**
 * Class implements a viewhelper for inline css
 *
 * @author Daniel Lienert <daniel@lienert.cc>
 * @package ViewHelpers
 * @subpackage Javascript
 *
 * Available generic markers:
 *
 * extPath: relative path to the extension
 * extKey: Extension Key
 * pluginNamespace: Plugin Namespace for GET/POST parameters
 */
class TemplateViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
    /**
     * @var t3lib_PageRenderer
     */
    protected $pageRenderer;


    /**
     * Initialize ViewHelper
     */
    public function initialize()
    {
        parent::initialize();

        if (TYPO3_MODE === 'FE' && $GLOBALS['TSFE']) {
            // $this->pageRenderer = $GLOBALS['TSFE']->getPageRenderer();
	    $this->pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        }
    }



    /**
     * @param string $href
     * @param boolean $forceOnTop
     */
    public function render($href,$forceOnTop = FALSE)
    {

	//error_log($this->pageRenderer);

        if ($this->pageRenderer != null && $href) {
            
           // $this->pageRenderer->addMetaTag($this->tag->render($metaTag));
           $this->pageRenderer->addCssFile($href,"stylesheet","all","",true,$forceOnTop,"",true);

        }
    }


}

