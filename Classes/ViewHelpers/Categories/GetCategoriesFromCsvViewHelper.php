<?php


namespace Iunctim\IuViewhelpers\ViewHelpers\Categories;

use TYPO3\CMS\Extbase\Service\ExtensionService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Error;

/**
 * Class implements a viewhelper for sys categories information retrieval by CSV syscat-uids
 *
 * @author Henning Lange (hjl) <lange@iunctim.com>
 * @package ViewHelpers
 * @subpackage Categories
 *
 * Available generic markers:
 *
 * extPath: relative path to the extension
 * extKey: Extension Key
 * pluginNamespace: Plugin Namespace for GET/POST parameters
 */

class GetCategoriesFromCsvViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


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
    }


    /**
     * categoryRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository;


    /**
     * @param string $syscatUidsCSV
     */
    public function render($syscatUidsCSV="")
    {
	    
	    $syscatUids = explode(",", $syscatUidsCSV);
	    $syscatUids = array_unique($syscatUids);
	    $syscatUidsCSV = implode(",", $syscatUids);	     

	    if ($syscatUidsCSV == "") return [];

            $query = $this->categoryRepository->createQuery();
            $sql = "SELECT sys_category.* FROM sys_category
                    WHERE uid IN (" . $syscatUidsCSV . ")
                    ORDER BY sorting ASC"; 

            return $query->statement($sql)->execute();

    }

}

