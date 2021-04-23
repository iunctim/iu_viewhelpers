<?php


namespace Iunctim\IuViewhelpers\ViewHelpers\Categories;

use TYPO3\CMS\Extbase\Service\ExtensionService;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Error;

/**
 * Class implements a viewhelper for sys categories retrieval (for pages, content elements, files)
 *   and/or alternatively, get all items (pages, files, tt_content elements) for a given category
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

class GetCategorizedItemsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


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
     * categoriesRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoriesRepository;


    /**
     * pageRepository
     *
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     * @inject
     */
    protected $pageRepository;


    /**
     * @param integer $categoryUid
     */
	/* Gets tt_content elements assigned to a given sys_category */
    protected function getCategorizedContentElements($categoryUid, $cType) {

		$collection = \TYPO3\CMS\Core\Category\Collection\CategoryCollection::load($categoryUid, TRUE, 'tt_content', 'categories');
		$items = $collection->getItems();

		/* Filter found items for desired CType */
		if ($cType != "") {
			foreach ($items as $index => $item) {
				if ($item['CType'] != $cType) unset($items[$index]);
			}
		}

		return $items;

	}

    /**
     * @param integer $categoryUid
     */
	/* Gets pages assigned to a given sys_category */
    protected function getCategorizedPages($categoryUid) {

		$collection = \TYPO3\CMS\Core\Category\Collection\CategoryCollection::load($categoryUid, TRUE, 'pages', 'categories');
		$items = $collection->getItems();
		return $items;

	}

    /**
     * @param integer $categoryUid
     */
	/* Gets files assigned to a given sys_category */
    protected function getCategorizedFiles($categoryUid) {

		$collection = \TYPO3\CMS\Core\Category\Collection\CategoryCollection::load($categoryUid, TRUE, 'sys_file_metadata', 'categories');
		$items = $collection->getItems();
		return $items;

	}


    /**
     * @param integer $categoryUid
	 * @param string $for
	 * @param string $type
     */
    public function render($category="", $for="tt_content", $type="")
    {

		// print_r($category.', '.$for);

		if ($category == "") return array();

		switch ($for) {
			case 'tt_content':
				return $this->getCategorizedContentElements($category, $type);
				break;
			case 'pages':
				// print_r('it`s dem pages, man!');
				return $this->getCategorizedPages($category);
				break;
			case 'files':
				return $this->getCategorizedFiles($category);
				break;				
		}

		return array();

    }

}

