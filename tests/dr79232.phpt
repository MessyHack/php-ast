--TEST--
ast_dump() with AST_DUMP_LINENOS for split array
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

function foo() {
    echo "this is a function.\n";
}

PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

// The lineno for AST_ARG_LIST is wrong...

?>
--EXPECT--
AST_STMT_LIST @ 1:1 8:1
    0: AST_ARRAY @ 2:2 4:4
        0: AST_ARRAY_ELEM @ 2:3 2:3
            flags: 0
            0: 0
            1: null
        1: AST_ARRAY_ELEM @ 3:3 3:3
            flags: 0
            0: 1
            1: null
        2: AST_ARRAY_ELEM @ 4:3 4:3
            flags: 0
            0: 2
            1: null
    1: AST_FUNC_DECL @ 6:1 8:1
        flags: 0
        name: foo
        0: AST_PARAM_LIST @ 6:13 6:14
        1: null
        2: AST_STMT_LIST @ 6:16 8:1
            0: AST_STMT_LIST @ 7:5 7:33
                0: AST_ECHO @ 7:10 7:32
                    0: "this is a function.
                    "
        3: null



