<?php

App::uses('AppController', 'Controller');

class UtmController extends AppController {
	public $uses = array('UtmData');
	public $components = array('Paginator');
	public $helpers = array('Paginator', 'Html');

	public $paginate = array(
		'limit' => 2
    );

	// Загрузка начальных source для отображения на первой странице
    public function statistics_index() {
		$this->Paginator->settings = [
            'fields' => ['source'],
            'group' => ['source'],
            'order' => ['source' => 'ASC'],
            'limit' => 2  // Показывать по 5 на странице
        ];

        // Получаем данные с пагинацией
        $sources = $this->Paginator->paginate('UtmData');

        // Передаем данные в представление
        $this->set('sources', $sources);
    }

    // Загрузка medium для source с пагинацией
    public function statistics_loadMediums($source = null, $page = 1) {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');

        // Количество элементов на странице
        $limit = 1;
        $offset = ($page - 1) * $limit;

        // Начинаем транзакцию
        $this->UtmData->begin();

        try {
            // Запрос на получение порции medium для выбранного source с пагинацией
            $mediums = $this->UtmData->find('list', [
                'fields' => ['medium', 'medium'],
                'conditions' => ['source' => $source],
                'group' => ['medium'],
                'order' => ['medium' => 'ASC'],
                'limit' => $limit,
                'offset' => $offset
            ]);

			// Выполняем запрос с DISTINCT через SQL
			$sql = "SELECT COUNT(DISTINCT `medium`) AS total FROM `utm_data` WHERE `source` = :source";
			$result = $this->UtmData->query($sql, ['source' => $source]);

			// Получаем количество уникальных medium
			$totalMedium = $result[0][0]['total'];

			$this->log($totalMedium, 'debug');

            // Коммит транзакции
            $this->UtmData->commit();

            // Количество страниц для пагинации
            $totalPages = ceil($totalMedium / $limit);

            // Возвращаем данные
            return json_encode([
                'data' => array_values($mediums),
                'totalPages' => $totalPages,
                'currentPage' => $page
            ]);
        } catch (Exception $e) {
            // Если произошла ошибка, откатываем транзакцию
            $this->UtmData->rollback();
            throw $e;  // Перебрасываем исключение
        }
    }

    // Загрузка campaigns для medium с пагинацией
    public function statistics_loadCampaigns($source = null, $medium = null, $page = 1) {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');

        // Количество элементов на странице
        $limit = 1;
        $offset = ($page - 1) * $limit;

        $this->UtmData->begin();

        try {
            // Получаем campaigns для medium
            $campaigns = $this->UtmData->find('list', [
                'fields' => ['campaign', 'campaign'],
                'conditions' => ['source' => $source, 'medium' => $medium],
                'group' => ['campaign'],
                'order' => ['campaign' => 'ASC'],
                'limit' => $limit,
                'offset' => $offset
            ]);

            // Подсчитываем общее количество campaigns для medium
            // $totalCampaigns = $this->UtmData->find('count', [
            //     'conditions' => ['source' => $source, 'medium' => $medium]
            // ]);

			$sql = "SELECT COUNT(DISTINCT `campaign`) AS total FROM `utm_data` WHERE `source` = :source AND `medium` = :medium";
			$result = $this->UtmData->query($sql, ['source' => $source, 'medium' => $medium]);

			// Получаем количество уникальных campaign
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

    // Загрузка contents для campaign с пагинацией
    public function statistics_loadContents($source = null, $medium = null, $campaign = null, $page = 1) {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');

        // Количество элементов на странице
        $limit = 1;
        $offset = ($page - 1) * $limit;

        $this->UtmData->begin();

        try {
            // Получаем contents для campaign
            $contents = $this->UtmData->find('list', [
                'fields' => ['content', 'content'],
                'conditions' => ['source' => $source, 'medium' => $medium, 'campaign' => $campaign],
                'group' => ['content'],
                'order' => ['content' => 'ASC'],
                'limit' => $limit,
                'offset' => $offset
            ]);

            // Подсчитываем общее количество contents для campaign
            // $totalContents = $this->UtmData->find('count', [
            //     'conditions' => ['source' => $source, 'medium' => $medium, 'campaign' => $campaign]
            // ]);

			$sql = "SELECT COUNT(DISTINCT `content`) AS total FROM `utm_data` WHERE `source` = :source AND `medium` = :medium AND `campaign` = :campaign";
			$result = $this->UtmData->query($sql, ['source' => $source, 'medium' => $medium, 'campaign' => $campaign]);

			// Получаем количество уникальных content
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

    // Загрузка terms для content с пагинацией
    public function statistics_loadTerms($source = null, $medium = null, $campaign = null, $content = null, $page = 1) {
        $this->autoRender = false;
        $this->request->onlyAllow('ajax');

        // Количество элементов на странице
        $limit = 1;
        $offset = ($page - 1) * $limit;
		$this->log("offset", 'debug');
		$this->log($offset, 'debug');

        $this->UtmData->begin();

        try {
            // Получаем terms для content
            $terms = $this->UtmData->find('list', [
                'fields' => ['term', 'term'],
                'conditions' => ['source' => $source, 'medium' => $medium, 'campaign' => $campaign, 'content' => $content],
                #'group' => ['term'],
                #'order' => ['term' => 'ASC'],
                'limit' => $limit,
                'offset' => $offset
            ]);

            // Подсчитываем общее количество terms для content
            // $totalTerms = $this->UtmData->find('count', [
            //     'conditions' => ['source' => $source, 'medium' => $medium, 'campaign' => $campaign, 'content' => $content]
            // ]);

			$sql = "SELECT COUNT(*) AS total FROM `utm_data` WHERE `source` = :source AND `medium` = :medium AND `campaign` = :campaign AND `content` = :content";
			$result = $this->UtmData->query($sql, ['source' => $source, 'medium' => $medium, 'campaign' => $campaign, 'content' => $content]);

			// Получаем количество уникальных terms
			$totalTerms = $result[0][0]['total'];
			$this->log($totalTerms, 'debug');
			$this->log("terms", 'debug');
			$this->log($terms, 'debug');

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