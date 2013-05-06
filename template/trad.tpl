<table class="table table-bordered">
	<thead>
		<tr>
			<th>Code</th>
			{foreach $listLang as $lang => $data}
				<th>
					<img src="/img/flags/{$lang}" alt="{$lang}" /> {$lang}
				</th>
			{/foreach}
			<th width="40"></th>
		</tr>
	</thead>
	<tbody>
		{foreach $listId as $id}
			<tr data-var="{$listVar[$id]}">
				<td>{$id}</td>
				{foreach $listLang as $lang => $data}
					<td class="{if !$data[$id]}error{else}success{/if}" data-content="{$data[$id]}" data-lang="{$lang}">
						{if !$data[$id]}
							<center><i class="icon-remove"></i></center>
						{else}
							<center><i class="icon-ok"></i></center>
						{/if}
					</td>
				{/foreach}
				<td>
					<a href="#" class="btn edit">
						<i class="icon-pencil"></i>
					</a>
				</td>
			</tr>
		{foreachelse}
			<tr class="error">
				<td colspan="{$listLang@total + 1}">Any ID</td>
			</tr>
		{/foreach}
	</tbody>
</table>

<div id="tradForm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tradFormTitle" aria-hidden="true">
	<div class="modal-header">
    	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    	<h3 id="tradFormTitle">Translate "<i></i>"</h3>
    </div>
    <div class="modal-body">
    	<h4>Variables available</h4>
    	<ul id="tradFormVar"></ul>
    	<h4>Translation</h4>
    	<table class="table">
	    	{foreach $listLang as $lang => $data}
	    		<tr valign="top">
	    			<td>
		    			<img src="/img/flags/{$lang}.png" />
	    			</td>
	    			<td>
			    		<textarea id="tradForm-{$lang}" data-lang="{$lang}" style="width:100%; margin: 0;"></textarea>
	    			</td>
	    	{/foreach}
    	</table>
    </div>
    <div class="modal-footer">
    	<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    	<button class="btn btn-primary" id="saveTradForm">Save changes</button>
    </div>
</div>

<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/trad.js"></script>