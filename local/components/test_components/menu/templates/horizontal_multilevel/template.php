<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
echo "<pre>";
print_r($arResult);
echo "</pre>";
if (!empty($arResult)):?>
<ul id="horizontal-multilevel-menu">

<?
$previousLevel = 0;
foreach($arResult["SECTIONS"] as $arItem):?>

	    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
		    <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
	    <?endif?>

	    <?if ($arItem["IS_PARENT"]):?>

		    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
			    <li><a href="" class="root-item"><?=$arItem["NAME"]?></a>
				    <ul>
                        <?if ($arParams["POPULAR_ITEM"]) {?>
                            <li><?=$arResult["TOP_ELEMENTS"][$arItem["IBLOCK_SECTION_ID"]]?></li>    
                        <?}?>
                        <?foreach ($arItem["SUBSECTIONS"] as $arSubsection) {?>
                            <li><a href=""><?=$arSubsection["NAME"]?></a>
                            <?if (isset($arResult["SECTIONS"][$arSubsection["ID"]])) {?>
                                <ul>
                                    <?if ($arParams["POPULAR_ITEM"]) {?>
                                        <li><?=$arResult["TOP_ELEMENTS"][$arSubsection["IBLOCK_SECTION_ID"]]?></li>    
                                    <?}?>
                                    <?foreach ($arResult["SECTIONS"][$arSubsection["ID"]]["SUBSECTIONS"] as $arCurrSubsection) {?>
                                        <li><a href=""><?=$arCurrSubsection["NAME"]?></a></li>    
                                    <?}?>
                                </ul>    
                            <?}?>    
                        <?}?>
                    </ul>
                </li>
		    <?/*else:?>
			    <li><a href="" class="parent"><?=$arItem["NAME"]?></a>
				    <ul>
		    <?*/endif?>

	    <?else:?>

			    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
				    <li><a href="" class=""><?=$arItem["NAME"]?></a></li>
			    <?else:?>
				    <li><a href=""><?=$arItem["NAME"]?></a></li>
			    <?endif?>

	    <?endif?>

	    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

    <?endforeach;?>

    <?if ($previousLevel > 1)://close last item tags?>
	    <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

    </ul>
    <div class="menu-clear-left"></div>
    <?
endif;?>