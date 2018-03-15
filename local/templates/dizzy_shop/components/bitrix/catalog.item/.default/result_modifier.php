<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
 

foreach ( $arResult['ITEM']["OFFERS"] as $key=>$offer){

	$keyProp = $offer["TREE"]["PROP_77"];
	
	if ( !$morePhoto[$keyProp] && $keyProp ){
	
			
			
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>48, 'height'=>72), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$sliderImg = $file['src'];
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>220, 'height'=>330), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$normalImg = $file['src'];
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>460, 'height'=>600), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$bigImg = $file['src'];
			$file = CFile::ResizeImageGet($offer["DETAIL_PICTURE"], array('width'=>100, 'height'=>200), BX_RESIZE_IMAGE_PROPORTIONAL, true);                
			$sliderbigImg = $file['src'];
			
			$morePhoto[$keyProp] = Array(
				"SRC" => $normalImg,
				"SLIDER" => $sliderImg,
				"BIG" => $bigImg,
				"SLIDER_BIG" => $sliderbigImg,
			);
		}
}
$arResult['ITEM']["MORE_PHOTO"] = $morePhoto;
?>

<?
		global $USER;
		$arResult["FAVORITES"] = Array();
		if(!$USER->IsAuthorized()){
			$arElements = unserialize($APPLICATION->get_cookie('favorites'));
		}
		else{
			$idUser = $USER->GetID();
			$rsUser = CUser::GetByID($idUser);
			$arUser = $rsUser->Fetch();
			$arElements = unserialize($arUser['UF_FAVORITES']);
        }  
		foreach ( $arElements as $key => $arElement){
			if ( $arElement == $ProductID ) {
				unset( $arElements[$key] );
			}
		}
		$arResult['ITEM']["FAVORITES"] = $arElements;


?>


