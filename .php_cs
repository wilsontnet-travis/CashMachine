<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude(['node_modules', 'web'])
    ->notPath('app/check.php')
    ->notPath('app/SymfonyRequirements.php')
;

return PhpCsFixer\Config::create()
    ->setRules(
        [
            '@Symfony' => true,
            '@PSR2' => true,
            '@PHP70Migration' => true,
            '@PHP71Migration' => true,
            'concat_space' => ['spacing' => 'one'],
            'phpdoc_summary' => false,
            'phpdoc_annotation_without_dot' => false,
            'pre_increment' => false,
        ]
    )
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
