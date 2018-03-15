<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>



							<div class="slider-card">
								<a class="slider-card__image" href="#">
									<?$file = CFile::ResizeImageGet($item['DETAIL_PICTURE']["ID"], array('width'=>220, 'height'=>330), BX_RESIZE_IMAGE_PROPORTIONAL, true);?>
									<img src="<?=$file['src']?>">
								</a>
								<a class="slider-card__name" href="<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME']?></a>
								<div class="slider-card__category">Куртка</div>
								<div class="slider-card__price"><?=$price['PRINT_RATIO_PRICE'];?></div>
							</div>



