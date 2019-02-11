<?php
/**
 * This recipe supports Jeeves 1.5 and up.
 */

namespace Deployer;

use Symfony\Component\Console\Input\InputOption;

require_once __DIR__.'/laravel.php';

/**
 * Override default Laravel
 */
set('git_tty', false);
set('bin/php', '/opt/plesk/php/7.2/bin/php');
set('bin/composer', function () {
    $options = '';

    if (get('hostname') === 'production') {
        $options = ' --no-dev ';
    }

    return '/usr/lib64/plesk-9.0/composer.phar'.$options;
});
set('bin/nvm', '. "/usr/local/opt/nvm/nvm.sh"');

/**
 * Add custom options
 */
option(
    'CI',
    null,
    InputOption::VALUE_NONE,
    'Deploy from CI or dev env?'
);

/**
 * Check if CI is set
 */
set('CI', function () {
    return input()->getOption('CI');
});

set('legacy_project', false);


// Jeeves shared dirs
set('shared_dirs', [
    'storage',
    'resources/lang',
]);

// JEeves shared file
set('shared_files', [
    '.env',
    'auth.json',
]);

// Jeeves writable dirs
set('writable_dirs', [
    'bootstrap/cache',
    'storage',
    'storage/app',
    'storage/app/public',
    'storage/framework',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs',
]);

// When NOT in CI, build and push assets to GIT before starting deploy
before('deploy:release', 'jeeves:build');
task('jeeves:build', [
    'jeeves:nvm',
    'jeeves:yarn',
    'jeeves:git',
]);

task('jeeves:nvm', function () {
    if (!get('CI')) {
        try {
            runLocally('{{bin/nvm}} && nvm use 9');
        } catch (\Throwable $e) {
            runLocally('say NVM niet gevonden.');
        }
    }
});

task('jeeves:yarn', function () {
    if (!get('CI')) {
        try {
            runLocally('yarn {{hostname}}:jeeves');
            runLocally('yarn {{hostname}}:app');
        } catch (\Throwable $e) {
            runLocally('say Host {{hostname}} bestaat niet, ik probeer met demo.');
            writeln("<info>{$e->getMessage()}</info>");
            runLocally('yarn demo:jeeves');
            runLocally('yarn demo:app');
        }
    }
});

task('jeeves:git', function () {
    if (!get('CI')) {
        try {
            runLocally('git add .');
            runLocally("git commit -m '{{hostname}} assets'");
            runLocally('git push origin');
        } catch (\Throwable $e) {
            runLocally('say Git is niet gelukt, waarschijnlijk moet er niets gepusht worden.');
            writeln("<info>{$e->getMessage()}</info>");
        }
    }
});

// When deploying from CI, upload assets manually
task('deploy:vendors', function () {
    if (get('CI')) {
        upload('vendor', '{{release_path}}/vendor');
    } else {
        // Merge JSONs and run Composer
        run('composer global require wikimedia/composer-merge-plugin');
        run('rm {{release_path}}/composer.lock');
        run('cp {{release_path}}/_composer.live.json {{release_path}}/composer.live.json');
        run('cd {{release_path}} && {{bin/php}} {{bin/composer}} install --no-interaction');
    }
});

/**
 * Upload assets if they are ignored AND this is not flagged as a legacy project.
 */
after('deploy:vendors', 'upload:assets');
task('upload:assets', function () {
    $ignored = strpos(file_get_contents('.gitignore'), 'public/jeeves') !== false;
    if ($ignored && !get('legacy_project')) {
        upload('public/app/', '{{release_path}}/public/app/', []);
        upload('public/jeeves/', '{{release_path}}/public/jeeves/', []);
    }
});

// [Optional] if deploy fails automatically unlock.
before('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

after('git:badge', 'label_milestone_issues');
