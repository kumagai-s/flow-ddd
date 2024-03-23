<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = (new Finder())
    ->in(__DIR__)
    ->exclude([
        'bin',
        'Build',
        'Configuration',
        'Data',
        'Packages',
        'Web',
    ])
;

return (new Config())
    ->setRules([
        '@Symfony' => true,
        '@DoctrineAnnotation' => true,
        'binary_operator_spaces' => [
            'operators' => [
                '=>' => 'align_single_space_minimal',
                '=' => 'single_space',
            ],
        ],
    ])
    ->setFinder($finder)
;
