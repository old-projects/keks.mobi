<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/main';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	
	public $breadcrumbs=array();

	public $pageMenu=array();

	public $menuButtons=array();

	public $userMenu=array();

	public $siteNavigation=array();

	public $pageDescription;

	public $headerTitle;
	public $headerImage;
	// public $headerImageLink;
	public $headerLink;
	public $counters;
	public $headerHomeLink = false;

	public function beforeAction($action) {
		$user_agent = Yii::app()->request->userAgent;
		if (empty($user_agent))
			throw new CHttpException(400);
		if (parent::beforeAction($action)) {
			// не считаем онлайн на предпросмотре
			if ($action->id != 'thumbnail') {
				Yii::app()->onlineCounter->processRequest();
				Yii::app()->externalVisitorsCounter->processRequest();
				// Yii::app()->getModule('statistics')->getCounter()->processRequest();
			}
			// if (($online = Online::model()->findByAttributes(array(
			// 		'address' => Yii::app()->request->userHostAddress,
			// 		'user_agent' => Yii::app()->request->userAgent,
			// ))) === null) {
			// 	$online = new Online();
			// 	$online->address = Yii::app()->request->userHostAddress;
			// 	$online->user_agent = Yii::app()->request->userAgent;
			// 	$online->start_time = new CDbExpression('NOW()');
			// 	$online->is_bot = Yii::app()->user->isBot()
			// 		? 1
			// 		: 0;
			// }
			
			// if ($online->query != Yii::app()->request->url)
			// 	$online->refreshes_count++;
			// $online->refresh_last_time = new CDbExpression('NOW()');
			// $online->query = Yii::app()->request->url;
			// $online->referrer = Yii::app()->request->urlReferrer;
			// if (!empty(Yii::app()->request->urlReferrer) && parse_url(Yii::app()->request->urlReferrer, PHP_URL_HOST) != Yii::app()->request->serverName)
			// 	$online->external_referrer = Yii::app()->request->urlReferrer;
			// $online->save();
			// Online::model()->deleteAllByAttributes(array(), 'refresh_last_time < SUBDATE(NOW(), INTERVAL :days DAY_HOUR)', array(':days' => Yii::app()->params['online_time_limit']));
			return true;
		}
		return false;
	}


	public function setFlash($message, $isPositive = true, $key = null) {
		if ($key === null) {
			if (version_compare(PHP_VERSION, '5.4.0', '>='))
				$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1);
			elseif (version_compare(PHP_VERSION, '5.3.6', '>='))
				$backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			else 
				$backtrace = debug_backtrace(false);

			$key = $backtrace[0]['file'].' : '.$backtrace[0]['line'].' : '.md5($message.$isPositive);
			
		}
		
		return Yii::app()->user->setSimpleFlash($message, $isPositive, $key);
	}
}
