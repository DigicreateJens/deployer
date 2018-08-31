<?php

namespace Deployer;

set('latestTag', function() {
    $latestTag = runLocally('git describe --abbrev=0 --tags');

    return $latestTag;
});

before('deploy:prepare', 'check:apiKey');
task('check:apiKey', function() {
    if(!has('apiKey')) {
        writeln('<fg=red>No Gitlab `apiKey` set, no badge will be added.</fg=red>');
    }
});

after('cleanup', 'git:badge');
desc('Add a badge to your repository');
task('git:badge', function () {
        $hostname = get('hostname');
        set('anchor', str_replace('.', '', get('latestTag')));
        if(has($hostname . '_badge_id')) {
            set('badge_id', get($hostname . '_badge_id'));
            set('color', has('production_badge_color') ? get($hostname . '_badge_color') : 'brightgreen');
            runLocally('curl --request PUT -H "PRIVATE-TOKEN: {{apiKey}}" -F "link_url=https://gitlab.com/%{project_path}#version-{{anchor}}" -F "image_url=https://img.shields.io/badge/{{hostname}}-v{{latestTag}}-{{color}}.svg" https://gitlab.com/api/v4/projects/{{project_id}}/badges/{{badge_id}}');
            writeln('<info>Badge added</info>');
        } else {
            writeln('<fg=red>No `{{hostname}}_badge_id` set, could not add badge</fg=red>');
        }
});
