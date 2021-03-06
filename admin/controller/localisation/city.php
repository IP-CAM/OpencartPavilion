<?php
class ControllerLocalisationCity extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('localisation/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/city');

		$this->getList();
	}

	public function add() {
		$this->load->language('localisation/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/city');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_city->addCity($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

		if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country= 220 ';
			}

			if (isset($this->request->get['filter_zone'])) {
				$url .= '&filter_zone=' . $this->request->get['filter_zone'];
			}

			if (isset($this->request->get['filter_city'])) {
				$url .= '&filter_city=' . urlencode(html_entity_decode($this->request->get['filter_city'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('localisation/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/city');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_localisation_city->editCity($this->request->get['city_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country= 220';
			}

			if (isset($this->request->get['filter_zone'])) {
				$url .= '&filter_zone=' . $this->request->get['filter_zone'];
			}

			if (isset($this->request->get['filter_city'])) {
				$url .= '&filter_city=' . urlencode(html_entity_decode($this->request->get['filter_city'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('localisation/city');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('localisation/city');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $city_id) {
				$this->model_localisation_city->deleteCity($city_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_country'])) {
				$url .= '&filter_country=220';
			}

			if (isset($this->request->get['filter_zone'])) {
				$url .= '&filter_zone=' . $this->request->get['filter_zone'];
			}

			if (isset($this->request->get['filter_city'])) {
				$url .= '&filter_city=' . urlencode(html_entity_decode($this->request->get['filter_city'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	protected function getList() {

	//		$filter_country = '220';


     /*   if (isset($this->request->get['filter_zone'])) {
			$filter_zone = $this->request->get['filter_zone'];
		} else {
			$filter_zone = null;
		}

		if (isset($this->request->get['filter_city'])) {
			$filter_city = $this->request->get['filter_city'];
		} else {
			$filter_city = null;
		} */

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';


      /*  if (isset($this->request->get['filter_zone'])) {
            $url .= '&filter_zone=' . $this->request->get['filter_zone'];
        }

        if (isset($this->request->get['filter_city'])) {
            $url .= '&filter_city=' . urlencode(html_entity_decode($this->request->get['filter_city'], ENT_QUOTES, 'UTF-8'));
        } */

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'		=> $this->language->get('text_home'),
			'href'		=> $this->url->link('common/home', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text'		=> $this->language->get('heading_title'),
			'href'		=> $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['insert'] = $this->url->link('localisation/city/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('localisation/city/delete', 'token=' . $this->session->data['token'] . $url, true);
		$data['update'] = $this->url->link('localisation/city_update', 'token=' . $this->session->data['token'] . $url, true);
        $data['logo']   = "../image/admin/delivery/nova-poshta.png";
		$data['cities'] = array();

		$filter_data = array(
		  //  'filter_country'=>'220',
          //  'filter_zone' => $filter_zone,
          //  'filter_city' => $filter_city,
			'sort'	      => $sort,
			'order'	      => $order,
			'start'	      => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'       => $this->config->get('config_limit_admin')
		);

		$city_total = $this->model_localisation_city->getTotalCities($filter_data);

		$results = $this->model_localisation_city->getCities($filter_data);

		foreach ($results as $result) {
			$data['cities'][] = array(
				'city_id'	=> $result['city_id'],
				'name'		=> $result['name'],
				'zone'		=> $result['zone'],
				'status'	=> ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'selected'	=> isset($this->request->post['selected']) && in_array($result['city_id'], $this->request->post['selected']),
				'edit'      => $this->url->link('localisation/city/edit', 'token=' . $this->session->data['token'] . '&city_id=' . $result['city_id'] . $url, true)
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
        $data['text_list'] = $this->language->get('text_list');
        $data['text_all'] = $this->language->get('text_all');
		$data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['entry_country'] = $this->language->get('entry_country');
        $data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_name'] = $this->language->get('entry_name');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_zone'] = $this->language->get('column_zone');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_insert'] = $this->language->get('button_insert');
        $data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');
		$data['button_city_update'] = $this->language->get('button_city_update');
		$data['logo']= '../image/catalog/novaposhta.png';

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

	/*	$url = '';

        if (isset($this->request->get['filter_country'])) {
           $url .= '&filter_country=220';
        }

        if (isset($this->request->get['filter_zone'])) {
            $url .= '&filter_zone=' . $this->request->get['filter_zone'];
        }

        if (isset($this->request->get['filter_city'])) {
            $url .= '&filter_city=' . urlencode(html_entity_decode($this->request->get['filter_city'], ENT_QUOTES, 'UTF-8'));
        }

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		} */

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_zone'] = $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . '&sort=zone' . $url, true);

		$url = '';

      if (isset($this->request->get['filter_country'])) {
            $url .= '&filter_country= 220';
        }

        if (isset($this->request->get['filter_zone'])) {
            $url .= '&filter_zone=' . $this->request->get['filter_zone'];
        }

        if (isset($this->request->get['filter_city'])) {
            $url .= '&filter_city=' . urlencode(html_entity_decode($this->request->get['filter_city'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $city_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($city_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($city_total - $this->config->get('config_limit_admin'))) ? $city_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $city_total, ceil($city_total / $this->config->get('config_limit_admin')));

     /*   $data['filter_country'] = '220';
        $data['filter_zone'] = $filter_zone;
        $data['filter_city'] = $filter_city;

        $this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();


		$data['order'] = $order; */

        $data['sort'] = $sort;

        $data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/city_list.tpl', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['city_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_none'] = $this->language->get('text_none');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_country'] = $this->language->get('entry_country');
		$data['entry_zone'] = $this->language->get('entry_zone');
		$data['entry_status'] = $this->language->get('entry_status');
        $data['logo']= '../image/catalog/novaposhta.png';

        $this->load->model('localisation/language');
        $data['languages'] = $this->model_localisation_language->getLanguages();

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$url = '';


		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text'		=> $this->language->get('text_home'),
			'href'		=> $this->url->link('common/home', 'token=' . $this->session->data['token'], true),
			'separator'	=> false
		);

		$data['breadcrumbs'][] = array(
			'text'		=> $this->language->get('heading_title'),
			'href'		=> $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, true),
			'separator'	=> ' :: '
		);

		if (!isset($this->request->get['city_id'])) {
			$data['action'] = $this->url->link('localisation/city/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('localisation/city/edit', 'token=' . $this->session->data['token'] . '&city_id=' . $this->request->get['city_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('localisation/city', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['city_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$city_info = $this->model_localisation_city->getCity($this->request->get['city_id']);
		}

	    if (!empty($city_info)) {
		    foreach ($city_info as $value){
		        $city[$value['language_id']]=array(
		            'name' => $value['name'],
                    'city_id'=>$value['city_id'],
                    'zone'   =>$value['zone']
                );
		        $zone=$value['zone'];
		        $status=$value['status'];
            }
			$data['city'] = $city;
		} else {
			$data['city'] = '';
		}

		$this->load->model('localisation/zone');


		$results = $this->model_localisation_zone->getNpZones();
		foreach ($results as $result){
		    $zones[$result['language_id']][]=array(
		        'code'=>$result['code'],
                'name'=>$result['name'],
            );
        }

        $data['zones']=$zones;

		if (isset($this->request->post['code'])) {
			$data['zone'] = $this->request->post['code'];
		} elseif (!empty($city_info)) {
			$data['zone'] = $zone;
		} else {
			$data['zone'] = 0;
		}



		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($city_info)) {
			$data['status'] = $status;
		} else {
			$data['status'] = '1';
		}

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('localisation/city_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'localisation/city')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

	/*	if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 128)) {
			$this->error['name'] = $this->language->get('error_name');
		} */

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'localisation/city')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function country() {
		$json = array();

			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => '220',
				'name'              => 'Україна',
				'zone'              => $this->model_localisation_zone->getZonesByCountryId('220'),
				'status'            => '1'
			);


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
