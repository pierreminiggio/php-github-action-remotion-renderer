<?php

namespace PierreMiniggio\GithubActionRemotionRenderer;

use Exception;
use PierreMiniggio\GithubActionRunStarterAndArtifactDownloader\GithubActionRunStarterAndArtifactDownloader;
use PierreMiniggio\GithubActionRunStarterAndArtifactDownloader\GithubActionRunStarterAndArtifactDownloaderFactory;

class GithubActionRemotionRenderer
{

    private GithubActionRunStarterAndArtifactDownloader $runnerAndDownloader;

    public function __construct()
    {
        $this->runnerAndDownloader = (new GithubActionRunStarterAndArtifactDownloaderFactory())
            ->make()
        ;
    }

    /**
     * @param array<string, mixed> $inputs
     * @param int $refreshTime in seconds
     *
     * @return string video's file paths
     *
     * @throws GithubActionRemotionRendererException
     */
    public function render(
        string $token,
        string $owner,
        string $repo,
        int $refreshTime = 30,
        int $retries = 0,
        array $inputs = [],
        string $ref = 'main'
    ): string
    {
        try {
            $files = $this->runnerAndDownloader->runActionAndGetArtifacts(
                $token,
                $owner,
                $repo,
                'render-video.yml',
                $refreshTime,
                $retries,
                $inputs,
                $ref
            );
        } catch (Exception $e) {
            throw new GithubActionRemotionRendererException($e->getMessage());
        }

        if (! $files) {
            throw new GithubActionRemotionRendererException('No artifact file !');
        }

        return $files[0];
    }

    public function getRunnerAndDownloader(): GithubActionRunStarterAndArtifactDownloader
    {
        return $this->runnerAndDownloader;
    }
}
