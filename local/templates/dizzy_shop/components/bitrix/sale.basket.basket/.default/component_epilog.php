<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (array_key_exists('is_ajax', $_REQUEST) && $_REQUEST['is_ajax']=='y') {
    die();
}