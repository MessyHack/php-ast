--TEST--
ast_dump() with AST_DUMP_LINENOS for split array
--SKIPIF--
<?php if (!extension_loaded("ast")) print "skip"; ?>
--FILE--
<?php

require __DIR__ . '/../util.php';

$code = <<<'PHP'
<?php
[
0
,
1
,
2
];

function foo() {
    echo "this is a function.\n";
}

PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

// The lineno for AST_ARG_LIST is wrong...

?>
--EXPECT--
AST_STMT_LIST @ 1:1 12:1
    0: AST_ARRAY @ 2:1 8:2
        0: AST_ARRAY_ELEM @ 3:1 3:1
            flags: 0
            0: 0
            1: null
        1: AST_ARRAY_ELEM @ 5:1 5:1
            flags: 0
            0: 1
            1: null
        2: AST_ARRAY_ELEM @ 7:1 7:1
            flags: 0
            0: 2
            1: null
    1: AST_FUNC_DECL @ 10:1 12:1
        flags: 0
        name: foo
        0: AST_PARAM_LIST @ 10:13 10:14
        1: null
        2: AST_STMT_LIST @ 10:16 12:1
            0: AST_STMT_LIST @ 11:5 11:33
                0: AST_ECHO @ 11:10 11:32
                    0: "this is a function.
                    "
        3: null



