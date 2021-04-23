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

class GetCategoriesOfItemViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {


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
     * pageRepository
     *
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     * @inject
     */
    protected $pageRepository;


    /**
     * @param integer $itemUid
     */
	/* Gets sys_categories assigned to a given content element */
    protected function getCategoriesOfContentElement($itemUid) {

        $query = $this->categoryRepository->createQuery();
        $sql = "SELECT sys_category.* FROM sys_category
            INNER JOIN sys_category_record_mm 
                ON sys_category_record_mm.uid_local = sys_category.uid
                AND sys_category_record_mm.fieldname = 'categories'
                AND sys_category_record_mm.tablenames = 'tt_content'
            INNER JOIN tt_content
                ON  sys_category_record_mm.uid_foreign = tt_content.uid
            WHERE tt_content.uid = '" . (int)$itemUid . "'
            AND sys_category.deleted = 0
            ORDER BY sys_category_record_mm.sorting_foreign ASC";
        return $query->statement($sql)->execute();   

	}

    /**
     * @param integer $itemUid
     */
	/* Gets sys_categories assigned to a given page */
    protected function getCategoriesOfPage($itemUid) {

    	$query = $this->categoryRepository->createQuery();
        $sql = "SELECT sys_category.* FROM sys_category
            INNER JOIN sys_category_record_mm 
				ON sys_category_record_mm.uid_local = sys_category.uid
				AND sys_category_record_mm.fieldname = 'categories'
				AND sys_category_record_mm.tablenames = 'pages'
            INNER JOIN pages
				ON  sys_category_record_mm.uid_foreign = pages.uid
            WHERE pages.uid = '" . (int)$itemUid . "'
            AND sys_category.deleted = 0
            ORDER BY sys_category_record_mm.sorting_foreign ASC";
        return $query->statement($sql)->execute();

	}

    /**
     * @param integer $itemUid
     */
	/* Gets sys_categories assigned to a given file */
    protected function getCategoriesOfFile($itemUid) {

        $query = $this->categoryRepository->createQuery();
        $sql = "SELECT sys_category.* FROM sys_category
            INNER JOIN sys_category_record_mm 
                ON sys_category_record_mm.uid_local = sys_category.uid
                AND sys_category_record_mm.fieldname = 'categories'
                AND sys_category_record_mm.tablenames = 'sys_file_metadata'
            INNER JOIN sys_file_metadata
                ON  sys_category_record_mm.uid_foreign = sys_file_metadata.uid
            WHERE sys_file_metadata.file = '" . (int)$itemUid . "'
            AND sys_category.deleted = 0
            ORDER BY sys_category_record_mm.sorting_foreign ASC";
        return $query->statement($sql)->execute();

	}


    /**
     * @param integer $itemUid
	 * @param string $ofType
     */
    public function render($itemUid="", $ofType="tt_content")
    {

		// print_r($category.', '.$for);

		if ($itemUid == "") return array();

		switch ($ofType) {
			case 'tt_content':
			case 'content':
				return $this->getCategoriesOfContentElement($itemUid);
				break;
			case 'pages':
			case 'page':
				// print_r('it`s dem pages, man!');
				return $this->getCategoriesOfPage($itemUid);
				break;
			case 'files':
			case 'file':
				return $this->getCategoriesOfFile($itemUid);
				break;				
		}

		return array();

    }

}

