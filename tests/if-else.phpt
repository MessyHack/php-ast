--TEST--
if-else location information
--SKIPIF--
<?php if (!extension_loaded("ast")) print "skip"; ?>
--FILE--
<?php

require __DIR__ . '/../util.php';

$code = <<<'PHP'
<?php
if ($x) // intended_if
    if ($x) { // dangling_else // actual_if
        x();
    } elseif ($x) {
        x();
    } else {
        x();
    }  
PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

?>
--EXPECT--
AST_STMT_LIST @ 1:1 9:5
    0: AST_IF @ 2:1 9:5
        0: AST_IF_ELEM @ 2:1 2:7
            0: AST_VAR @ 2:5 2:6
                0: "x"
            1: AST_IF @ 3:5 9:5
                0: AST_IF_ELEM @ 3:5 3:11
                    0: AST_VAR @ 3:9 3:10
                        0: "x"
                    1: AST_STMT_LIST @ 3:13 5:5
                        0: AST_CALL @ 4:9 4:12
                            0: AST_NAME @ 4:9 4:9
                                flags: NAME_NOT_FQ (1)
                                0: "x"
                            1: AST_ARG_LIST @ 4:11 4:11
                1: AST_IF_ELEM @ 5:7 5:17
                    0: AST_VAR @ 5:15 5:16
                        0: "x"
                    1: AST_STMT_LIST @ 5:19 7:5
                        0: AST_CALL @ 6:9 6:12
                            0: AST_NAME @ 6:9 6:9
                                flags: NAME_NOT_FQ (1)
                                0: "x"
                            1: AST_ARG_LIST @ 6:11 6:11
                2: AST_IF_ELEM @ 7:7 9:5
                    0: null
                    1: AST_STMT_LIST @ 7:12 9:5
                        0: AST_CALL @ 8:9 8:12
                            0: AST_NAME @ 8:9 8:9
                                flags: NAME_NOT_FQ (1)
                                0: "x"
                            1: AST_ARG_LIST @ 8:11 8:11
