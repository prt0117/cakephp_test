<h2>UTM Tree</h2>

<ul id="utm-tree">
	<?php foreach ($sources as $source): ?>
		<li>
			<span class="toggle" data-level="source" data-source="<?php echo h($source['UtmData']['source']); ?>">
				▶ <?php echo h($source['UtmData']['source']); ?>
			</span>
			<ul class="children" id="source-<?php echo h($source['UtmData']['source']); ?>" style="display:none;"></ul>
		</li>
	<?php endforeach; ?>
</ul>

<br>

<div class="pagination">
	<?php
		echo $this->Paginator->prev('« Prev  ', null, null, ['class' => 'prev']);
		echo $this->Paginator->next('  Next »', null, null, ['class' => 'next']);
		echo "<br>";
		echo $this->Paginator->numbers();
	?>
</div>

<?php echo $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js', ['inline' => false]);
 ?>
<script>
$(document).on('click', '.toggle', function() {
	var el = $(this);
	var level = el.data('level');
	var source = el.data('source');
	var medium = el.data('medium');
	var campaign = el.data('campaign');
	var content = el.data('content');
	var page = 1;

	if (el.hasClass('loaded')) {
		el.next('.children').toggle();
		return;
	}

	var url = '';
	var targetId = '';

	if (level === 'source') {
		url = '/statistics/utm/loadMediums/' + encodeURIComponent(source) + '/' + page;
		targetId = '#source-' + source;
	} else if (level === 'medium') {
		url = '/statistics/utm/loadCampaigns/' + encodeURIComponent(source) + '/' + encodeURIComponent(medium) + '/' + page;
		targetId = '#medium-' + source + '-' + medium;
	} else if (level === 'campaign') {
		url = '/statistics/utm/loadContents/' + encodeURIComponent(source) + '/' + encodeURIComponent(medium) + '/' + encodeURIComponent(campaign) + '/' + page;
		targetId = '#campaign-' + source + '-' + medium + '-' + campaign;
	} else if (level === 'content') {
		url = '/statistics/utm/loadTerms/' + encodeURIComponent(source) + '/' + encodeURIComponent(medium) + '/' + encodeURIComponent(campaign) + '/' + encodeURIComponent(content) + '/' + page;
		targetId = '#content-' + source + '-' + medium + '-' + campaign + '-' + content;
	}

	$.getJSON(url, function(response) {
		var html = '';
		response.data.forEach(function(item) {
			if (level === 'source') {
				html += '<li><span class="toggle" data-level="medium" data-source="' + source + '" data-medium="' + item + '">' + item + '</span><ul class="children" id="medium-' + source + '-' + item + '" style="display:none;"></ul></li>';
			} else if (level === 'medium') {
				html += '<li><span class="toggle" data-level="campaign" data-source="' + source + '" data-medium="' + medium + '"data-campaign="' + item + '">' + item + '</span><ul class="children" id="campaign-' + source + '-' + medium + '-' + item + '" style="display:none;"></ul></li>';
			} else if (level === 'campaign') {
				html += '<li><span class="toggle" data-level="content" data-source="' + source + '" data-medium="' + medium + '" data-campaign="' + campaign + '"data-content="' + item + '">' + item + '</span><ul class="children" id="content-' + source + '-' + medium + '-' + campaign + '-' + item + '" style="display:none;"></ul></li>';
			} else if (level === 'content') {
				html += '<li>' + item + '</li>';
			}
		});

		if (response.totalPages > response.currentPage) {
			html += '<li><button class="load-more" data-level="' + level + '" data-source="' + source + '" data-medium="' + medium + '" data-campaign="' + campaign + '" data-content="' + content + '" data-page="' + (parseInt(response.currentPage) + 1) + '">Загрузить ещё</button></li>';
		}

		$(targetId).append(html);
		el.addClass('loaded').next('.children').show();
	});
});

$(document).on('click', '.load-more', function() {
	var el = $(this);
	var level = el.data('level');
	var source = el.data('source');
	var medium = el.data('medium');
	var campaign = el.data('campaign');
	var content = el.data('content');
	var page = parseInt(el.data('page'), 10);
	var url = '';
	var targetId = '';

	if (level === 'source') {
		url = '/statistics/utm/loadMediums/' + encodeURIComponent(source) + '/' + page;
		targetId = '#source-' + source;
	} else if (level === 'medium') {
		url = '/statistics/utm/loadCampaigns/' + encodeURIComponent(source) + '/' + encodeURIComponent(medium) + '/' + page;
		targetId = '#medium-' + source + '-' + medium;
	} else if (level === 'campaign') {
		url = '/statistics/utm/loadContents/' + encodeURIComponent(source) + '/' + encodeURIComponent(medium) + '/' + encodeURIComponent(campaign) + '/' + page;
		targetId = '#campaign-' + source + '-' + medium + '-' + campaign;
	} else if (level === 'content') {
		url = '/statistics/utm/loadTerms/' + encodeURIComponent(source) + '/' + encodeURIComponent(medium) + '/' + encodeURIComponent(campaign) + '/' + encodeURIComponent(content) + '/' + page;
		targetId = '#content-' + source + '-' + medium + '-' + campaign + '-' + content;
	}

	$.getJSON(url, function(response) {
		var html = '';
		response.data.forEach(function(item) {
			if (level === 'source') {
				html += '<li><span class="toggle" data-level="medium" data-source="' + source + '" data-medium="' + item + '">' + item + '</span><ul class="children" id="medium-' + source + '-' + item + '" style="display:none;"></ul></li>';
			} else if (level === 'medium') {
				html += '<li><span class="toggle" data-level="campaign" data-source="' + source + '" data-medium="' + medium + '" data-campaign="' + item + '">' + item + '</span><ul class="children" id="campaign-' + source + '-' + medium + '-' + item + '" style="display:none;"></ul></li>';
			} else if (level === 'campaign') {
				html += '<li><span class="toggle" data-level="content" data-source="' + source + '" data-medium="' + medium + '" data-campaign="' + campaign + '" data-content="' + item + '">' + item + '</span><ul class="children" id="content-' + source + '-' + medium + '-' + campaign + '-' + item + '" style="display:none;"></ul></li>';
			} else if (level === 'content') {
				html += '<li>' + item + '</li>';
			}
		});

		if (response.totalPages > response.currentPage) {
			html += '<li><button class="load-more" data-level="' + level + '" data-source="' + source + '" data-medium="' + medium + '" data-campaign="' + campaign + '" data-content="' + content + '" data-page="' + (parseInt(response.currentPage) + 1) + '">Загрузить ещё</button></li>';
		}

		$(targetId).append(html);
		el.closest('li').remove();
	});
});
</script>