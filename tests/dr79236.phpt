--TEST--
DR79236 -- Column information incorrect.
--SKIPIF--
<?php if (!extension_loaded("ast")) print "skip"; ?>
--FILE--
<?php

require __DIR__ . '/../util.php';

$code = <<<'PHP'
<?php
[0
 ,1
  ,2];

PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

?>
--EXPECT--
AST_STMT_LIST @ 1:1 4:6
    0: AST_ARRAY @ 2:1 4:5
        0: AST_ARRAY_ELEM @ 2:2 2:2
            flags: 0
            0: 0
            1: null
        1: AST_ARRAY_ELEM @ 3:3 3:3
            flags: 0
            0: 1
            1: null
        2: AST_ARRAY_ELEM @ 4:4 4:4
            flags: 0
            0: 2
            1: null