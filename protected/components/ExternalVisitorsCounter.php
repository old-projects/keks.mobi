<?php
class ExternalVisitorsCounter extends CApplicationComponent {
	public function processRequest() {
		$address = Yii::app()->request->userHostAddress;
		$referrer = Yii::app()->request->urlReferrer;
		$external_referrer = (!empty($referrer) && parse_url($referrer, PHP_URL_HOST) != Yii::app()->request->serverName)
			? $referrer
			: null;
		$user_agent = Yii::app()->request->userAgent;
		if (!empty($external_referrer)) {
			$external_visitor = new ExternalVisitors;
			$external_visitor->referrer_site = parse_url($external_referrer, PHP_URL_HOST);
			$external_visitor->referrer = $external_referrer;
			$external_visitor->address = $address;
			$external_visitor->user_agent = $user_agent;
			$external_visitor->visit_time = new CDbExpression('NOW()');
			$external_visitor->query = Yii::app()->request->url;
			if (!$external_visitor->save())
				throw new CHttpException(500, 'Can not save external visitor info!');
		}
	}
}