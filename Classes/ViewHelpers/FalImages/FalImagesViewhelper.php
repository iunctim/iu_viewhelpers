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



namespace Iunctim\IuViewhelpers\ViewHelpers\FalImages;

use TYPO3\CMS\Extbase\Service\ExtensionService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Error;

/**
 * Class implements a viewhelper for inline javascript
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
class FalImagesViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

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

/*
        if (TYPO3_MODE === 'FE' && $GLOBALS['TSFE']) {
            // $this->pageRenderer = $GLOBALS['TSFE']->getPageRenderer();  // deprecated in v8 (hjl)
	    $this->pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
        }
*/

    }



    /**
     * @param string $href
     * @param boolean $forceOnTop
     * @param boolean $forceOnFooter
     * @param boolean $compress
     * @param boolean $excludeFromConcatenation
     */
    public function render($ceUid)
    {
/*
        // error_log(print_r($this->pageRenderer->jsFiles,true));

        if ($this->pageRenderer != null && $templatePath && !$forceOnFooter) {

           $this->pageRenderer->addJsFile($templatePath,"text/javascript",$compress,$forceOnTop,"",$excludeFromConcatenation);

        } else if($this->pageRenderer != null && $templatePath && $forceOnFooter) {

           $this->pageRenderer->addJsFooterFile($templatePath,"text/javascript",$compress,$forceOnTop,"",$excludeFromConcatenation);

        }
*/

	//return [$ceUid,111,222,333];
	return $ceUid;

    }

}

