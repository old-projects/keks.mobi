<?php
class OnlineCounter extends CApplicationComponent {
	public function processRequest() {
		$address = Yii::app()->request->userHostAddress;
		$referrer = Yii::app()->request->urlReferrer;
		$external_referrer = (!empty($referrer) && parse_url(Yii::app()->request->urlReferrer, PHP_URL_HOST) != Yii::app()->request->serverName)
			? $referrer
			: null;
		$user_agent = Yii::app()->request->userAgent;
		
		$cookie_key = 'site_online_id';

			// если ID записи в куках
			if (isset(Yii::app()->request->cookies[$cookie_key])) {
				$site_online_id = Yii::app()->request->cookies[$cookie_key]->value;
				// if (YII_DEBUG) var_dump('by cookie');
				if (($online = Online::model()->findByPk($site_online_id)) !== null) {
					if ($online->address != $address)
						$online->address = $address;
					if ($online->user_agent != $user_agent)
						$online->user_agent = $user_agent;
				}
			} 

			// если есть запись с такого IP, user_agent не учитывается
			if (empty($online) && ($online = Online::model()->findByAttributes(array(
					'address' => Yii::app()->request->userHostAddress,
			))) !== null) {
				// if (YII_DEBUG) var_dump('by address');
				// но если был другой браузер - стираем данные
				if ($online->user_agent != $user_agent) {
					// if (YII_DEBUG) var_dump('flushing...');
					// $online->user_agent = $user_agent;
					// $online->refreshes_count = 0;
					// $online->query = null;
					// $online->referrer = null;
					// $online->external_referrer = null;
					// // $online->external_referrer = $external_referrer;
					// $online->start_time = new CDbExpression('NOW()');
					// $online->is_bot = Yii::app()->user->isBot()
					// 	? 1
					// 	: 0;
					// $online->save();
					$online->delete();
					$online = null;
				}
			}

			// если это совершенно новый посетитель
			if (empty($online)) {
				// if (YII_DEBUG) var_dump('new');
				$online = new Online();
				$online->address = Yii::app()->request->userHostAddress;
				$online->user_agent = Yii::app()->request->userAgent;
				$online->start_time = new CDbExpression('NOW()');
				$online->is_bot = Yii::app()->user->isBot()
					? 1
					: 0;
			}

			if ($online->query != Yii::app()->request->url)
				$online->refreshes_count++;
			$online->refresh_last_time = new CDbExpression('NOW()');
			$online->query = Yii::app()->request->url;
			$online->referrer = Yii::app()->request->urlReferrer;
			if (!empty(Yii::app()->request->urlReferrer) && parse_url(Yii::app()->request->urlReferrer, PHP_URL_HOST) != Yii::app()->request->serverName)
				$online->external_referrer = Yii::app()->request->urlReferrer;

			// Yii::beginProfile('online');
			$online->save();
			if (!isset(Yii::app()->request->cookies[$cookie_key]) || Yii::app()->request->cookies[$cookie_key]->value != $online->id)
				Yii::app()->request->cookies[$cookie_key] = new CHttpCookie($cookie_key, $online->id);
			// Yii::endProfile('online');
			Online::model()->deleteAllByAttributes(array(), 'refresh_last_time < SUBDATE(NOW(), INTERVAL :days DAY_HOUR)', array(':days' => Yii::app()->params['online_time_limit']));
	}
}