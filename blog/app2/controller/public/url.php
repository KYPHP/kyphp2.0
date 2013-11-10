<?php
class ControllerPublicUrl extends Controller{
	public function index() {
		// 添加静态到类
		if($this->config->get('PATH_KEY')==5){ 
			$this->url->addRewrite($this);
		}
		
		// 解码
		if (isset($this->request->get['_k_'])) {
			$parts = explode('/', $this->request->get['_k_']);
			if(strstr($this->request->get['_k_'],'---')){
				$this->request->get['k']='info/view';
			}
			
			if (isset($this->request->get['k'])) {
				
				return $this->request->get['k'];
			}
		}
	}
	
	public function rewrite($link) {
		
		if($this->config->get('PATH_KEY')==5){ 
			$url_data = parse_url(str_replace('&amp;', '&', $link));
		
			$url = ''; 
			
			$data = array();
			
			parse_str($url_data['query'], $data);
			
			if(strstr($link,'info/view')){
				$url='/---';
			}
			
			if ($url) {
				unset($data['k']);
			
				$query = '';
			
				if ($data) {
					foreach ($data as $key => $value) {
						$query .= '&' . $key . '=' . $value;
					}
					
					if ($query) {
						$query = '?' . trim($query, '&');
					}
				}

				return $url_data['scheme'] . '://' . $url_data['host'] . (isset($url_data['port']) ? ':' . $url_data['port'] : '') . str_replace('/index.php', '', $url_data['path']) . $url . $query;
			} else {
				return $link;
			}
		} else {
			return $link;
		}		
	}	
}
?>