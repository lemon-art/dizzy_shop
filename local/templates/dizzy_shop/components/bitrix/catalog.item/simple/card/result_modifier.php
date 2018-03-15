<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications(); 
 
$file = CFile::ResizeImageGet($uInfo['PERSONAL_PHOTO'], array('width'=>220, 'height'=>330), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
$item['PREVIEW_PICTURE']['SRC'] = $file['src'];