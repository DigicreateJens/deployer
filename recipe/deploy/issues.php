<?php

namespace Deployer;

/**
 * Init GitlabClient
 */
set('GitlabClient', function () {
    try {
        $apiKey = get('apiKey');
        $client = \Gitlab\Client::create('https://gitlab.com')
                                ->authenticate($apiKey,\Gitlab\Client::AUTH_URL_TOKEN);

        return $client;
    } catch(\Throwable $e) {
        writeln('<error>Kon geen verbinding maken met Gitlab. Is je \'apiKey\' ingesteld?</error>');
    }

});

/**
 * Close all issues under the 'major' milestone of the project.
 */
task('label_milestone_issues', function () {
    $latestTag = get('latestTag');
    $semantics = explode('.', $latestTag);
    $latestMajor = "{$semantics[0]}.{$semantics[1]}";
    $Gitlab = get('GitlabClient');
    $projectId = get('project_id');
    $env = get('hostname');

    $issues = $Gitlab->api('issues')->all($projectId,
        [
            'scope' => 'all',
            'milestone' => $latestMajor,
            'per_page' => 100,
            'labels' => '06 staat klaar',
        ]);

    /**
     * Loop over and update issues with new Labels
     */
    foreach ($issues as $i => $issue) {
        $labels = array_merge($issue['labels'], ["Deployed {$env}"]);

        $Gitlab->api('issues')->update(
            $projectId,
            $issue['iid'],
            [
                'labels' => implode(',', $labels),
            ]
        );

        writeln("Added badge to {$issue['title']} - {$issue['web_url']}");
    }
});
