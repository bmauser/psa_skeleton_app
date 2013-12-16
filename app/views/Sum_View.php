<?php

/**
 * View class
 */
class Sum_View extends Psa_Smarty_View{
	
	/**
	 * Shows form
	 */
	function sum($sum_result = null){
		
		if($sum_result !== null)
			$this->psa_smarty->assign('sum_result', $sum_result);
		
		$this->psa_smarty->assign('page_title_text', 'Sum numbers');
		$this->psa_smarty->assign('page_title', $this->psa_smarty->fetch('page_title.tpl'));		
		$this->psa_smarty->assign('content', $this->psa_smarty->fetch('sum_form.tpl'));
	}

	
	/**
	 * Shows form
	 */
	function sum_ajax(){
		
		$this->psa_smarty->assign('ajax_form', 1);
		$this->psa_smarty->assign('page_title_text', 'Sum numbers with ajax');
		$this->psa_smarty->assign('page_title', $this->psa_smarty->fetch('page_title.tpl'));
		$this->psa_smarty->assign('content', $this->psa_smarty->fetch('sum_form.tpl'));
	}
	
	
	/**
	 * Shows result with ajax
	 */
	function sum_result_ajax($sum_result){
		
		$this->psa_smarty->assign('content', $sum_result);
	}
}
