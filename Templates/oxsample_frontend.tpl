[{capture append="oxidBlock_content"}]
<h1 class="page-header">OXID eShop 6 Example Module</h1>

<p>
    [{if $oxsample_greeting}]
        [{oxmultilang ident="$oxsample_greeting"}][{$oxsample_date}]
    [{/if}]
</p>

<br>
<form action="[{$oViewConf->getSelfActionLink()}]" name="OxsampleDoSomethingAction" method="post" role="form">
    <div>
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="hkreuter_oxsample_controller">
        <input type="hidden" name="fnc" value="doSomethingAction">
        <button type="submit" id="OxSampleDoSomethingActionButton" class="submitButton">[{oxmultilang ident="SUBMIT_DOSOMETHING"}]</button>
    </div>
</form>
<br>

<br>
<p>
    [{$oxsample_info}]
</p>
<form action="[{$oViewConf->getSelfActionLink()}]" name="OxsampleDoSomethingElseAction" method="post" role="form">
    <div>
        [{$oViewConf->getHiddenSid()}]
        <input type="hidden" name="cl" value="hkreuter_oxsample_controller">
        <input type="hidden" name="fnc" value="doSomethingElseAction">
        <button type="submit" id="OxSampleDoSomethingElseActionButton" class="submitButton">[{oxmultilang ident="SUBMIT_DOSOMETHING_ELSE"}]</button>
    </div>
</form>

<br>

[{include file="layout/page.tpl"}]