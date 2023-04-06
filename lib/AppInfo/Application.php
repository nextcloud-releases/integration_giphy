<?php
/**
 * Nextcloud - Giphy
 *
 *
 * @author Julien Veyssier <julien-nc@posteo.net>
 * @copyright Julien Veyssier 2022
 */

namespace OCA\Giphy\AppInfo;

use OCA\Giphy\Listener\GiphyReferenceListener;
use OCA\Giphy\Reference\GiphyReferenceProvider;
use OCP\Collaboration\Reference\RenderReferenceEvent;

use OCP\AppFramework\App;
use OCP\AppFramework\Bootstrap\IRegistrationContext;
use OCP\AppFramework\Bootstrap\IBootContext;
use OCP\AppFramework\Bootstrap\IBootstrap;

use OCA\Giphy\Search\GiphySearchGifsProvider;

class Application extends App implements IBootstrap {

	public const APP_ID = 'integration_giphy';
	// this key belongs to the eneiluj+giphy@posteo.net acount on https://developers.giphy.com
	public const DEFAULT_API_KEY = 'LebyjhpSc5GpX5xKSEtdxFIWMneLlrIF';
	public const DEFAULT_RATING = 'g';

	public function __construct(array $urlParams = []) {
		parent::__construct(self::APP_ID, $urlParams);
	}

	public function register(IRegistrationContext $context): void {
		$context->registerSearchProvider(GiphySearchGifsProvider::class);

		$context->registerReferenceProvider(GiphyReferenceProvider::class);
		$context->registerEventListener(RenderReferenceEvent::class, GiphyReferenceListener::class);
	}

	public function boot(IBootContext $context): void {
	}
}

