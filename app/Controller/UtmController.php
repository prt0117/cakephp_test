<?php

App::uses('AppController', 'Controller');

class UtmController extends AppController {
	public $uses = array('UtmData');
	public $components = array('Paginator');
	public $helpers = array('Paginator');

	public $paginate = array(
		'limit' => 20
    );

	public function statistics_list() {
		$this->Paginator->settings = $this->paginate;
		$utms = $this->Paginator->paginate('UtmData');

		$grouped = [];

		foreach ($utms as $utm) {
			$source = $utm['UtmData']['source'];
			$medium = $utm['UtmData']['medium'];
			$campaign = $utm['UtmData']['campaign'];
			$content = isset($utm['UtmData']['content']) ? $utm['UtmData']['content'] : 'NULL';
			$term = isset($utm['UtmData']['term']) ? $utm['UtmData']['term'] : 'NULL';

			if ($content === 'NULL')
				$grouped[$source][$medium][$campaign][] = 'NULL';
			else
				$grouped[$source][$medium][$campaign][$content][] = $term;
		}

		$this->set('utms', $grouped);
	}
}