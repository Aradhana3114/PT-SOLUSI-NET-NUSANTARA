<?php

$ctx = stream_context_create(['http' => ['timeout' => 30]]);
$json = @file_get_contents('https://repo.packagist.org/p2/filament/support.json', false, $ctx);
$d = json_decode($json, true);
$vers = $d['packages']['filament/support'];
$i = 0;
foreach ($vers as $v) {
    if (! empty($v['require'])) {
        echo str_pad($v['version'], 12).' illuminate/contracts: '.($v['require']['illuminate/contracts'] ?? 'n/a')
            .' | livewire: '.($v['require']['livewire/livewire'] ?? 'n/a')
            .' | php: '.($v['require']['php'] ?? 'n/a')."\n";
        if (++$i >= 6) {
            break;
        }
    }
}
