<?php
	


	class Form extends HTMLElement{
		private $html = '', $method, $url;
		
		public function __construct($method, $url, $id = ''){
			$this->method = $method;
			$this->url = $url;
			$this->id = $id;
		}

		// public function addHidden($name, $value){
		// 	$submit = new HTMLElement([
		// 			'tag' => 'input',
		// 			'attributes' => [
		// 					'name' 	=> $name,
		// 					'type' 	=> 'hidden',
		// 					'value' => $value
		// 			]
		// 	]);
		// 	$this->html .= $submit->write();
		// }
		
		public function addSubmit($name, $label, $id = ''){
			
			$submit = new HTMLElement([
					'tag' => 'input',
					'attributes' => [
							'name' 	=> $name,
							'type' 	=> 'submit',
							'value' => $label,
							'id' 	=> $id
					]
			]);
			$this->html .= $submit->write();
			
			$this->html .= '<br>';
		}
		
		public function addText($name, $label = '', $value = '', $id = '', $type = 'text',$js = ''){
			if($label){
				$le = new HTMLElement([
						'tag' => 'label',
						'text' => $label,
						'needsClosing' => true
				]);
				$this->html .= $le->write();
			}
			
			$te = new HTMLElement([
					'tag' => 'input',
					'attributes' => [
							'name' => $name,
							'type' => $type,
							'value' => $value,
							'id'	=> $id
					]
			]);
			$this->html .= $te->write();
			
			$this->html .= '<br>';
		}
		
		/**
		 *
		 * Print the Text Area HTML element
		 *
		 */
		
		public function addTextArea($name, $rows, $columns, $label = '', $value = '', $js = ''){
			if($label){
				$le = new HTMLElement([
						'tag' => 'label',
						'text' => $label,
						'needsClosing' => true
				]);
				$this->html .= $le->write();
			}
			
			$area = new HTMLElement([
					'tag' => 'textarea',
					'attributes' => [
							'name' => $name,
							'rows' => $rows,
							'columns' => $columns,
							'value' => $value,
					],
					'needsClosing' => true
			]);
			$this->html .= $area->write();
			
			$this->html .= '<br>';
		}
		


		/**
		 *
		 * Print the Select HTML Element
		 *
		 */
		
		public function addSelect($name, $options){

			$opts = "";

			foreach ($options as $key => $value) {
				$opts .="<option value = \"$key\"> $value </option>";
			}



			$te = new HTMLElement([
					'tag' => 'select',
					'attributes' => [
						'name' => $name,
					],
					'text' => $opts,
					"needsClosing" => true
			]);
			$this->html .= $te->write();
			
			$this->html .= '<br>';
		}
		


		public function write(){
			$form = new HTMLElement([
					'tag' => 'form',
					'attributes' => [
							'method' => $this->method,
							'action' => $this->url,
							'id' => $this->id
					],
					'text' => $this->html,
					'needsClosing' => true
			]);
			
			return $form->write();
		}
	}