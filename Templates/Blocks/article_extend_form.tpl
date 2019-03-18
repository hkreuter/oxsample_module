
<tr>
    <td class="edittext">
        [{oxmultilang ident="ARTICLE_EXTEND_OXSAMPLE_COUNTER"}]
    </td>
    <td class="edittext">
        <input type="text" class="editinput" size="10" maxlength="[{$edit->oxarticles__oxsample_counter->fldmax_length}]" name="editval[oxarticles__oxsample_counter]" value="[{$edit->oxarticles__oxsample_counter->value}]" [{$readonly}]>
        [{oxinputhelp ident="HELP_OXSAMPLE_COUNTER"}]
    </td>
</tr>

[{$smarty.block.parent}]