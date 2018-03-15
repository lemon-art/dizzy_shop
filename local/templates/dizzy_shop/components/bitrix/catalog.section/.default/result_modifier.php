<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
?>

<?
if(!function_exists('BITGetDeclNum'))
{

    /**
     * Возврат окончания слова при склонении
     *
     * Функция возвращает окончание слова, в зависимости от примененного к ней числа
     * Например: 5 товаров, 1 товар, 3 товара
     *
     * @param int $value - число, к которому необходимо применить склонение
     * @param array $status - массив возможных окончаний
     * @return mixed
     */
    function BITGetDeclNum($value=1, $status= array('','а','ов'))
    {
     $array =array(2,0,1,1,1,2);
     return $status[($value%100>4 && $value%100<20)? 2 : $array[($value%10<5)?$value%10:5]];
    }
}
?>