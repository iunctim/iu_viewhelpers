<?php
  
namespace Iunctim\IuViewhelpers\ViewHelpers\File;

class ExistsViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('path', 'string', 'path to check', false, '');
    }

    /**
     * @param string $path
     */
    public function render()
    {
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(PATH_site."fileadmin/properties_upload/Fotos800/Am Waller Freihafen 5+7/181.jpg");
        //\TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump(file_exists(PATH_site."fileadmin/properties_upload/Fotos800/Am Waller Freihafen 5+7/181.jpg"));

        return ((file_exists(PATH_site.$this->arguments['path'])) && (!(is_dir(PATH_site.$this->arguments['path']))));
    }

}

?>

