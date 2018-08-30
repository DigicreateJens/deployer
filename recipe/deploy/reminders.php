<?php

namespace Deployer;

use Symfony\Component\Console\Input\InputOption;

set('remindersByTag', function () {
    $file = @file_get_contents('.dep_reminders');
    if(!$file) {
        touch('.dep_reminders');
    }

    return json_decode($file, true);
});

desc('Add a reminder for the next deploy.');
task('reminders:add', function () {
    $reminder = ask('What should I remind you of?', null);
    if ($reminder) {
        $tag = ask('Which tag should be used?', get('latestTag'));
        // Load the .dep_reminders file
        $remindersByTag = get('remindersByTag');
        // Add the reminder to the file, under the tag
        $remindersByTag[$tag][] = $reminder;
        file_put_contents('.dep_reminders', json_encode($remindersByTag));
        writeln("<info>Ok, I'll remind you of '{$reminder}' the next time you deploy tag '{$tag}'");
    }
})->local()
    ->once();

desc('Show the set reminders when deploying.');
task('reminders:show', function () {
    // Load the .dep_reminders file.
    $remindersByTag = get('remindersByTag');
    $tag = ask('Which tag should be used?', get('latestTag'));
    if($tag === 'all') {
        showAllReminders($remindersByTag);
    } else {
        showRemindersByTag($remindersByTag, $tag);
    }

})->local()
  ->once();

// Functions
function showReminders($remindersByTag) {
    writeln('<info>Don\'t forget:</info>');
    foreach ($remindersByTag as $tag => $reminders) {
        writeln("<info>Tag: {$tag}</info>");
        foreach ($reminders as $i => $reminder) {
            // Show all reminders for the given tag
            writeln("<info>    - {$reminder}</info>");
        }
    }

    return true;
}

function showAllReminders($remindersByTag) {
    showReminders($remindersByTag);

    return true;
}

function showRemindersByTag($remindersByTag, $selectedTag) {
    // Loop over the reminders of the latest tag.
    if (isset($remindersByTag[$selectedTag])) {
        showReminders($remindersByTag[$selectedTag]);
    } else {
        writeln("<info>No reminders set for {$selectedTag}</info>");
    }

    return true;
}
