<?php

declare(strict_types = 1);

use Kirby\Cms\App;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[RunTestsInSeparateProcesses]
#[PreserveGlobalState(false)]
final class SnippetTest extends TestCase
{
    #[Test]
    public function prints_the_legacy_script_with_the_site_host_as_domain(): void
    {
        $html = $this->render([]);

        $this->assertSame(
            '<script data-domain="example.com" defer src="https://plausible.io/js/plausible.js"></script>',
            $html
        );
    }

    #[Test]
    public function escapes_the_configured_domain(): void
    {
        $html = $this->render(['domain' => 'example.com"><script>alert(1)</script>']);

        $this->assertStringContainsString('data-domain="example.com&quot;&gt;&lt;script&gt;', $html);
    }

    #[Test]
    public function prints_the_current_snippet_with_scriptUrl(): void
    {
        $html = $this->render(['scriptUrl' => 'https://plausible.io/js/pa-abc123.js']);

        $this->assertStringContainsString('<script async src="https://plausible.io/js/pa-abc123.js"></script>', $html);
        $this->assertStringContainsString('plausible.init()', $html);
        $this->assertStringNotContainsString('data-domain', $html);
    }

    #[Test]
    public function prints_nothing_in_debug_mode(): void
    {
        $this->assertSame('', $this->render([], debug: true));
    }

    #[Test]
    public function prints_nothing_for_a_logged_in_user(): void
    {
        $this->assertSame('', $this->render(['scriptUrl' => 'https://plausible.io/js/pa-abc123.js'], loggedIn: true));
    }

    /** @param array<string, string> $options */
    private function render(array $options, bool $debug = false, bool $loggedIn = false): string
    {
        $app = new App([
            'roots' => ['index' => '/dev/null'],
            'urls' => ['index' => 'https://example.com'],
            'options' => [
                'debug' => $debug,
                'johannschopplich.plausible' => $options
            ]
        ]);

        if ($loggedIn) {
            $app->impersonate('kirby');
        }

        return trim(snippet('plausible', return: true));
    }
}
