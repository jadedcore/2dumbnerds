<div class="row">
	<?php foreach($newActivities as $activity):?>
		<div class="col-xs-12 col-sm-4 col-md-3">
			<?= $this->element('news_card', [
				'type' => $activity->activity_type->name,
				'title' => $activity->title,
				'image' => $activity->image,
				'link' => $activity->link,
				'newTab' => $activity->is_newtab,
				'date' => $activity->created->nice(),
				'author' => $activity->creator->display_name
			]);?>
		</div>
	<?php endforeach;?>
</div>
