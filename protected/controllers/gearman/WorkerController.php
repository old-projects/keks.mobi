<?php
class WorkerController extends AbstractWorkerController
{
	public function actionReverse(WorkerJob $job)
	{
		$job->sendComplete($job->getWorkload());
	    echo $job->getWorkload();
	    echo "\n";
	}
}
