<?php

App::uses('AppController', 'Controller');

class UtmController extends AppController {
	public $uses = array('UtmData');
	public $components = array('Paginator');
	public $helpers = array('Paginator', 'Html');

	private $innerLevelLimit = 5;

	public function statistics_list() {
		$this->Paginator->settings = [
			'fields' => ['source'],
			'group' => ['source'],
			'order' => ['source' => 'ASC'],
			'limit' => 20
		];

		$sources = $this->Paginator->paginate('UtmData');
		$this->set('sources', $sources);
	}

	public function statistics_loadMediums($source = null, $page = 1) {
		$this->autoRender = false;

		$limit = $this->innerLevelLimit;
		$offset = ($page - 1) * $limit;

		$this->UtmData->begin();

		try {
			$mediums = $this->UtmData->find('list', [
				'fields' => ['medium', 'medium'],
				'conditions' => ['source' => $source],
				'group' => ['medium'],
				'order' => ['medium' => 'ASC'],
				'limit' => $limit,
				'offset' => $offset
			]);

			// вот тут надо уточнить, экранируются ли автоматически данные при передаче подобным способом (:content). Если не экранируются, переписать или задействовать Sanitize.
			$sql = "SELECT COUNT(DISTINCT `medium`) AS total FROM `utm_data` WHERE `source` = :source";
			$result = $this->UtmData->query($sql, ['source' => $source]);

			$totalMedium = $result[0][0]['total'];

			$this->UtmData->commit();

			$totalPages = ceil($totalMedium / $limit);

			return json_encode([
				'data' => array_values($mediums),
				'totalPages' => $totalPages,
				'currentPage' => $page
			]);
		} catch (Exception $e) {
			$this->UtmData->rollback();
			throw $e;
		}
	}

	public function statistics_loadCampaigns($source = null, $medium = null, $page = 1) {
		$this->autoRender = false;

		$limit = $this->innerLevelLimit;
		$offset = ($page - 1) * $limit;

		$this->UtmData->begin();

		try {
			$campaigns = $this->UtmData->find('list', [
				'fields' => ['campaign', 'campaign'],
				'conditions' => ['source' => $source, 'medium' => $medium],
				'group' => ['campaign'],
				'order' => ['campaign' => 'ASC'],
				'limit' => $limit,
				'offset' => $offset
			]);

			// вот тут надо уточнить, экранируются ли автоматически данные при передаче подобным способом (:content). Если не экранируются, переписать или задействовать Sanitize.
			$sql = "SELECT COUNT(DISTINCT `campaign`) AS total FROM `utm_data` WHERE `source` = :source AND `medium` = :medium";
			$result = $this->UtmData->query($sql, ['source' => $source, 'medium' => $medium]);

			$totalCampaigns = $result[0][0]['total'];

			$this->UtmData->commit();

			$totalPages = ceil($totalCampaigns / $limit);

			return json_encode([
				'data' => array_values($campaigns),
				'totalPages' => $totalPages,
				'currentPage' => $page
			]);
		} catch (Exception $e) {
			$this->UtmData->rollback();
			throw $e;
		}
	}

	public function statistics_loadContents($source = null, $medium = null, $campaign = null, $page = 1) {
		$this->autoRender = false;

		$limit = $this->innerLevelLimit;
		$offset = ($page - 1) * $limit;

		$this->UtmData->begin();

		try {
			$contents = $this->UtmData->find('list', [
				'fields' => ['content', 'content'],
				'conditions' => ['source' => $source, 'medium' => $medium, 'campaign' => $campaign],
				'group' => ['content'],
				'order' => ['content' => 'ASC'],
				'limit' => $limit,
				'offset' => $offset
			]);

			// вот тут надо уточнить, экранируются ли автоматически данные при передаче подобным способом (:content). Если не экранируются, переписать или задействовать Sanitize.
			$sql = "SELECT COUNT(DISTINCT `content`) AS total FROM `utm_data` WHERE `source` = :source AND `medium` = :medium AND `campaign` = :campaign";
			$result = $this->UtmData->query($sql, ['source' => $source, 'medium' => $medium, 'campaign' => $campaign]);

			$totalContents = $result[0][0]['total'];

			$this->UtmData->commit();

			$totalPages = ceil($totalContents / $limit);

			return json_encode([
				'data' => array_values($contents),
				'totalPages' => $totalPages,
				'currentPage' => $page
			]);
		} catch (Exception $e) {
			$this->UtmData->rollback();
			throw $e;
		}
	}

	public function statistics_loadTerms($source = null, $medium = null, $campaign = null, $content = null, $page = 1) {
		$this->autoRender = false;

		$limit = $this->innerLevelLimit;
		$offset = ($page - 1) * $limit;

		$this->UtmData->begin();

		if ($content == 'null')
			$content = NULL;

		try {
			$terms = $this->UtmData->find('list', [
				'fields' => ['term'],
				'conditions' => ['source' => $source, 'medium' => $medium, 'campaign' => $campaign, 'content' => $content],
				'limit' => $limit,
				'offset' => $offset
			]);

			// вот тут надо уточнить, экранируются ли автоматически данные при передаче подобным способом (:content). Если не экранируются, переписать или задействовать Sanitize.
			if ($content === NULL) {
				$sql = "SELECT COUNT(*) AS total
						FROM `utm_data`
						WHERE `source` = :source
						AND `medium` = :medium
						AND `campaign` = :campaign
						AND `content` IS NULL";
				$params = ['source' => $source, 'medium' => $medium, 'campaign' => $campaign];
			} else {
				$sql = "SELECT COUNT(*) AS total
						FROM `utm_data`
						WHERE `source` = :source
						AND `medium` = :medium
						AND `campaign` = :campaign
						AND `content` = :content";
				$params = ['source' => $source, 'medium' => $medium, 'campaign' => $campaign, 'content' => $content];
			}

			$result = $this->UtmData->query($sql, $params);

			$totalTerms = $result[0][0]['total'];

			$this->UtmData->commit();

			$totalPages = ceil($totalTerms / $limit);

			return json_encode([
				'data' => array_values($terms),
				'totalPages' => $totalPages,
				'currentPage' => $page
			]);
		} catch (Exception $e) {
			$this->UtmData->rollback();
			throw $e;
		}
	}
}