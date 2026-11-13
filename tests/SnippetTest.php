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
    public function prints_nothing_without_scriptUrl(): void
    {
        $this->assertSame('', $this->render([]));
    }

    #[Test]
    public function prints_the_current_snippet_with_scriptUrl(): void
    {
        $html = $this->render(['scriptUrl' => 'https://plausible.io/js/pa-abc123.js']);

        $this->assertStringContainsString('<script async src="https://plausible.io/js/pa-abc123.js"></script>', $html);
        $this->assertStringContainsString('plausible.init()', $html);
    }

    #[Test]
    public function prints_nothing_in_debug_mode(): void
    {
        $this->assertSame('', $this->render(['scriptUrl' => 'https://plausible.io/js/pa-abc123.js'], debug: true));
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
