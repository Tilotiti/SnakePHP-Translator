<p>Available languages in <code>{$smarty.const.LANG}/</code> :</p>

<table class="table table-bordered">
	<thead>
		<tr>
			<th>Language</th>
			<th>Complete</th>
			<th>Writable</th>
		</tr>
	</thead>
	<tbody>
		{foreach $languages as $lang}
			<tr class="{if $lang.complete && $lang.writable}success{else}error{/if}">
				<td><img src="/img/flags/{$lang.code}.png" /> <strong>{$lang.code}</strong></td>
				<td>{if $lang.complete}Yes{else}No{/if}</td>
				<td>{if $lang.writable}Yes{else}No{/if}</td>
			</tr>
		{foreachelse}
			<tr>
				<td colspan="3" class="error">Any available languages. Please, verify your LANG folder path.</td>
			</tr>
		{/foreach}
	</tbody>
</table>

<h3>Translation progress</h3>
{foreach $arrayFile as $file}
	<h4>File : lang.{$file.code}.xml</h4>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Language</th>
				<th>Variables</th>
				<th>Total</th>
				<th>Progress</th>
			</tr>
		</thead>
		<tbody>
			{foreach $file.lang as $code => $lang}
				{if !$lang.error}
					<tr class="{if $lang.progress == $file.max}success{elseif $lang.progress > 0}warning{else}error{/if}">
						<td><img src="/img/flags/{$code}.png" /> <strong>{$code}</strong></td>
						<td>{$lang.progress}</td>
						{if $lang@index == 0}
							<td rowspan="{$lang@total}" style="vertical-align: middle; text-align: center;">{$file.max}</td>
						{/if}
						<td>{if $file.max > 0}{ceil($lang.progress / $file.max * 100)} %{else}100%{/if}</td>
					</tr>
				{else}
					<tr class="error">
						<td><img src="/img/flags/{$code}.png" /> <strong>{$code}</strong></td>
						<td colspan="3">Error with the file <code>{$smarty.const.LANG}/{$code}/lang.{$file.code}.xml</code></td>
					</tr>
				{/if}
			{/foreach}
		</tbody>
	</table>
{foreachelse}
	<div class="error">Any available languages. Please, verify your LANG folder path.</div>
{/foreach}