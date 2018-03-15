<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$arViewStyles = array(
	'LIST' => array(
		'CONT' => 'bx_sitemap',
		'TITLE' => 'bx_sitemap_title',
		'LIST' => 'bx_sitemap_ul',
	),
	'LINE' => array(
		'CONT' => 'bx_catalog_line',
		'TITLE' => 'bx_catalog_line_category_title',
		'LIST' => 'bx_catalog_line_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/line-empty.png'
	),
	'TEXT' => array(
		'CONT' => 'bx_catalog_text',
		'TITLE' => 'bx_catalog_text_category_title',
		'LIST' => 'bx_catalog_text_ul'
	),
	'TILE' => array(
		'CONT' => 'bx_catalog_tile',
		'TITLE' => 'bx_catalog_tile_category_title',
		'LIST' => 'bx_catalog_tile_ul',
		'EMPTY_IMG' => $this->GetFolder().'/images/tile-empty.png'
	)
);
$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

$arStyles = Array(
	"bottom: 0; left: 20px;",
	"bottom: 0; right: 10px; z-index: 3;",
	"bottom: 0; right: 25px;",
	"top: 0; right: -20px; z-index: 3;",
	"bottom: 0; right: 30px;",
	"top: -22px; left: 10px; z-index: 3;",
	"top: 0; left: 5px; z-index: 3;"
);	

?>

	<div class="home-catalog">
        <div class="container">
            <div class="title">
				<a href="/catalog/"><?=GetMessage('TITLE')?></a>
			</div>
            <div class="home-catalog__wrapper">
				<div class="row">
				
					<?foreach ($arResult['SECTIONS'] as $key=> &$arSection):?>
					
						<div class="col-md-6 col-lg-4">
							<a class="catalog-card catalog-card--bg-peach" href="<?=$arSection['SECTION_PAGE_URL']; ?>">
								<div class="catalog-card__image" style="<?=$arStyles[$key]?>">
									<img src="<?=$arSection['PICTURE']['SRC']?>" srcset="img/catalogCard-1@2x.png 2x">
								</div>
								<div class="catalog-card__content catalog-card__content--right">
									<div class="catalog-card__name"><?=$arSection["NAME"]?></div>
									<div class="catalog-card__short">С натуральным мехом</div>
								</div>
							</a>
						</div>
						
					<?endforeach;?>
					
                
				</div>
            </div>
        </div>
    </div>



