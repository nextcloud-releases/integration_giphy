<?php
namespace OCA\Giphy\Settings;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Services\IInitialState;
use OCP\IConfig;
use OCP\Settings\ISettings;
use OCA\Giphy\AppInfo\Application;

class Personal implements ISettings {

	public function __construct(
		private IConfig $config,
		private IInitialState $initialStateService,
		private ?string $userId
	) {
	}

	/**
	 * @return TemplateResponse
	 */
	public function getForm(): TemplateResponse {
		$adminLinkPreviewEnabled = $this->config->getAppValue(Application::APP_ID, 'link_preview_enabled', '1') === '1';
		$linkPreviewEnabled = $this->config->getUserValue($this->userId, Application::APP_ID, 'link_preview_enabled', '1') === '1';

		$adminSearchEnabled = $this->config->getAppValue(Application::APP_ID, 'search_gifs_enabled', '1') === '1';
		$userSearchEnabled = $this->config->getUserValue($this->userId, Application::APP_ID, 'search_gifs_enabled', '0') === '1';

		$userConfig = [
			'admin_link_preview_enabled' => $adminLinkPreviewEnabled,
			'link_preview_enabled' => $linkPreviewEnabled,
			'search_gifs_enabled' => $userSearchEnabled,
			'admin_search_gifs_enabled' => $adminSearchEnabled,
		];
		$this->initialStateService->provideInitialState('user-config', $userConfig);
		return new TemplateResponse(Application::APP_ID, 'personalSettings');
	}

	public function getSection(): string {
		return 'connected-accounts';
	}

	public function getPriority(): int {
		return 10;
	}
}
