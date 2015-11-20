--TEST--
ast: xref issue
--SKIPIF--
<?php if (!extension_loaded("ast")) print "skip"; ?>
--FILE--
<?php

require __DIR__ . '/../util.php';

$code = <<<'PHP'
<?php
    foo('foo', 'bar');
PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

// The lineno for AST_ARG_LIST is wrong...

?>
--EXPECT--
AST_STMT_LIST @ 1:1 2:22
    0: AST_CALL @ 2:5 2:22
        0: AST_NAME @ 2:5 2:7
            flags: NAME_NOT_FQ (1)
            0: "foo"
        1: AST_ARG_LIST @ 2:8 2:21
            0: "foo"
            1: "bar"