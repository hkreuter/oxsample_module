[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="module_main">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<input type="button" value="[{oxmultilang ident=CLICK_HERE}]" class="edittext" onclick="JavaScript:showDialog('&cl=oxsample_admin_ajax_controller&aoc=1]');">

[{include file="bottomnaviitem.tpl"}]
[{include file="bottomitem.tpl"}]