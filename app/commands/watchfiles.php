<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class watchfiles extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'watch:dir';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Watch Directory for changes.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//
		$this->line('Started watching directory public/cob_files');

		$path = public_path().'/cob_files';


				$watcher = App::make('watcher');
				$listener = $watcher->watch($path);

				$listener->onAnything(function($event, $resource, $path)
				{
					switch ($event->getCode())
					{
						case JasonLewis\ResourceWatcher\Event::RESOURCE_DELETED:
							$this->line("{$path} was deleted (from anything listener).");
							break;
						case JasonLewis\ResourceWatcher\Event::RESOURCE_MODIFIED:
							$this->line("{$path} was modified (from anything listener).");
							break;
						case JasonLewis\ResourceWatcher\Event::RESOURCE_CREATED:
							Queue::push('FileService',$path);
							break;
					}
				});

				$watcher->start();
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('dir', InputArgument::REQUIRED, 'Directory to watch.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('event', null, InputOption::VALUE_OPTIONAL, 'An Optional event name to watch.', null),
		);
	}

}
