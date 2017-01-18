<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions() {
		return array(
			'captcha' => array(
				'class' => 'CCaptchaAction',
				'backColor' => 0xFFFFFF,
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex() {
		$this->render('index', array(
			'total_videos' => Yii::app()->getModule('video')->getTotalVideos(),
			// 'total_video_size' => Yii::app()->getModule('video')->getTotalVideoSize(),
			// 'total_tracks_size' => Yii::app()->getModule('music')->getTotalTracksSize(),
			// 'total_tracks' => Yii::app()->getModule('music')->getTotalTracks(),
			'total_images' => Yii::app()->getModule('images')->getTotalImages(),
			'total_images_size' => Yii::app()->getModule('images')->getTotalImagesSize(),

			'total_lyrics_songs' => 
				Yii::app()->getModule('lyrics')->getTotalRussianSongs() + Yii::app()->getModule('lyrics')->getTotalEnglishSongs(),
			'total_lyrics_artists' => 
				Yii::app()->getModule('lyrics')->getTotalRussianArtists() + Yii::app()->getModule('lyrics')->getTotalEnglishArtists(),

			'total_authors' => Yii::app()->getModule('library')->getTotalAuthors(),
			'total_books' => Yii::app()->getModule('library')->getTotalBooks(),
		));
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model = new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes = $_POST['ContactForm'];
			if($model->validate())
			{
				$name = '=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject = '=?UTF-8?B?'.base64_encode('Письмо с '.Yii::app()->request->serverName.(empty($model->name) ? null : ' от '.$model->name)).'?=';
				$headers = "From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'], 'Письмо с '.Yii::app()->request->serverName.(empty($model->name) ? null : ' от '.$model->name), $model->body, $headers);
				$this->setFlash('Ваше сообщение отправлено.');
				$this->redirect($this->createUrl('index'));
			}
		}
		$this->render('contact', array('model' => $model));
	}

	public function actionOnline() {

		$sorting_labels = array(
			'refresh_last_time' => 'по времени',
			'refreshes_count' => 'по количеству просмотров',
			'start_time' => 'по длительности',
		);
		$sorting_selector = new Selector($sorting_labels);

		$bots_labels = array(
			'users' => 'только реальные посетители',
			'bots' => 'только боты',
			'all' => 'все',
		);
		$bots_selector = new Selector($bots_labels, 'filter');

		$criteria = new CDbCriteria;
		$criteria->order = $sorting_selector->selectedItem.' DESC';
		$criteria->scopes = array('active');
		if ($bots_selector->selectedItem != 'all')
			$criteria->scopes[] = $bots_selector->selectedItem;

		$dataProvider = new CActiveDataProvider('Online', array(
			'criteria' => $criteria,
			// 'pagination' => array(
			// 	'pageSize' => 10,
			// ),
		));
		$this->render('online', array(
			'dataProvider' => $dataProvider,
			'detailed' => isset($_GET['detailed']),
			'sorting_selector' => $sorting_selector,
			'bots_selector' => $bots_selector,
			'online_active_limit' => Yii::app()->params['online_active_limit'],
		));
	}

	/**
	 * Displays the login page
	 */
	// public function actionLogin()
	// {
	// 	$model=new LoginForm;

	// 	// if it is ajax validation request
	// 	if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
	// 	{
	// 		echo CActiveForm::validate($model);
	// 		Yii::app()->end();
	// 	}

	// 	// collect user input data
	// 	if(isset($_POST['LoginForm']))
	// 	{
	// 		$model->attributes=$_POST['LoginForm'];
	// 		// validate user input and redirect to the previous page if valid
	// 		if($model->validate() && $model->login())
	// 			$this->redirect(Yii::app()->user->returnUrl);
	// 	}
	// 	// display the login form
	// 	$this->render('login',array('model'=>$model));
	// }

	// /**
	//  * Logs out the current user and redirect to homepage.
	//  */
	// public function actionLogout()
	// {
	// 	Yii::app()->user->logout();
	// 	$this->redirect(Yii::app()->homeUrl);
	// }
}