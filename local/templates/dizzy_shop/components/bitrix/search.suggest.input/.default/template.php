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

CJSCore::Init(array("ajax"));
?>
<script>
	BX.ready(function(){
		var input = BX("<?echo $arResult["ID"]?>");
		if (input)
			new JsSuggest(input, '<?echo $arResult["ADDITIONAL_VALUES"]?>');
	});
</script>


	<div class="navi__search" js-teleport data-teleport-to="mobile-search" data-teleport-condition="&lt;768">
		<form class="navi__search-form" action="/search/" js-header-search>
			<button type="submit"><i class="icon icon-search"></i></button>
			<input type="text" name="<?echo $arParams["NAME"]?>" value="<?echo $arParams["VALUE"]?>" id="<?echo $arResult["ID"]?>" autocomplete="off" placeholder="Поиск">
		</form>
	</div>

