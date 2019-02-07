<?php

namespace Deployer;

/**
 * Init GitlabClient
 */
set('GitlabClient', function () {
    try {
        $apiKey = get('apiKey');
        $client = \Gitlab\Client::create('https://gitlab.com')
                                ->authenticate($apiKey, \Gitlab\Client::AUTH_URL_TOKEN);

        return $client;
    } catch (\Throwable $e) {
        writeln('<error>Kon geen verbinding maken met Gitlab. Is je \'apiKey\' ingesteld?</error>');
    }

});

/**
 * Close all issues under the 'major' milestone of the project.
 */
task('label_milestone_issues', function () {
    $latestTag = get('latestTag');
    $semanticVersioningRegex = '/^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(-(0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(\.(0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*)?(\+[0-9a-zA-Z-]+(\.[0-9a-zA-Z-]+)*)?$/';
    preg_match($semanticVersioningRegex, $latestTag, $semantics);
    if (isset($semantics[0])) {
        $latestTag = "{$semantics[1]}.{$semantics[2]}";
    }
    $Gitlab = get('GitlabClient');
    $projectId = get('project_id');

    // Check if a Milestone exists
    $milestone = $Gitlab->api('milestones')->all($projectId, [
        'search' => $latestTag,
    ]);
    if (empty($milestone)) {
        writeln("No Milestone names {$latestTag} found. Aborting.");
    } else {
        $issues = $Gitlab->api('issues')->all($projectId,
            [
                'scope' => 'all',
                'milestone' => $latestTag,
                'per_page' => 100,
                'labels' => '06 staat klaar',
            ]);

        // Loop over and update issues with new Labels
        if (empty($issues)) {
            writeln("No issues for Milestone {$latestTag}.");
        } else {
            $env = get('hostname');
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
        }
    }
});
