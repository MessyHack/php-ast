--TEST--
ast: xref issue
--SKIPIF--
<?php if (!extension_loaded("ast")) print "skip"; ?>
--FILE--
<?php

require __DIR__ . '/../util.php';

$code = <<<'PHP'
<?php
class Foo extends \Bar
{
    public function test()
    {
        if (array_key_exists('adminhtml', $_SESSION)) {
            unset($_SESSION['adminhtml']);
        }
        $logger = $this->getMock('\LoggerInterface', [], [], '', false);
        \Bootstrap::getObjectManager()->create('\Session', [$logger]);
        $this->assertArrayHasKey('adminhtml', $_SESSION);
    }
}
PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

// The lineno for AST_ARG_LIST is wrong...

?>
--EXPECT--
AST_STMT_LIST @ 1:1 13:1
    0: AST_CLASS @ 2:1 13:1
        flags: 0
        name: Foo
        0: AST_NAME @ 2:20 2:22
            flags: NAME_FQ (0)
            0: "Bar"
        1: null
        2: AST_STMT_LIST @ 3:1 13:1
            0: AST_METHOD @ 4:5 12:5
                flags: MODIFIER_PUBLIC (256)
                name: test
                0: AST_PARAM_LIST @ 4:25 4:26
                1: null
                2: AST_STMT_LIST @ 5:5 11:57
                    0: AST_IF @ 6:9 8:9
                        0: AST_IF_ELEM @ 6:9 8:9
                            0: AST_CALL @ 6:13 6:52
                                0: AST_NAME @ 6:13 6:28
                                    flags: NAME_NOT_FQ (1)
                                    0: "array_key_exists"
                                1: AST_ARG_LIST @ 6:29 6:52
                                    0: "adminhtml"
                                    1: AST_VAR @ 6:43 6:51
                                        0: "_SESSION"
                            1: AST_STMT_LIST @ 6:55 8:9
                                0: AST_STMT_LIST @ 7:13 7:42
                                    0: AST_UNSET @ 7:19 7:40
                                        0: AST_DIM @ 7:19 7:40
                                            0: AST_VAR @ 7:19 7:27
                                                0: "_SESSION"
                                            1: "adminhtml"
                    1: AST_ASSIGN @ 9:9 9:72
                        0: AST_VAR @ 9:9 9:15
                            0: "logger"
                        1: AST_METHOD_CALL @ 9:19 9:71
                            0: AST_VAR @ 9:19 9:23
                                0: "this"
                            1: "getMock"
                            2: AST_ARG_LIST @ 9:33 9:71
                                0: "\LoggerInterface"
                                1: AST_ARRAY @ 9:54 9:55
                                2: AST_ARRAY @ 9:58 9:59
                                3: ""
                                4: AST_CONST @ 9:66 9:70
                                    0: AST_NAME @ 9:66 9:70
                                        flags: NAME_NOT_FQ (1)
                                        0: "false"
                    2: AST_METHOD_CALL @ 10:9 10:70
                        0: AST_STATIC_CALL @ 10:10 10:38
                            0: AST_NAME @ 10:10 10:18
                                flags: NAME_FQ (0)
                                0: "Bootstrap"
                            1: "getObjectManager"
                            2: AST_ARG_LIST @ 10:38 10:38
                        1: "create"
                        2: AST_ARG_LIST @ 10:47 10:69
                            0: "\Session"
                            1: AST_ARRAY @ 10:60 10:68
                                0: AST_ARRAY_ELEM @ 10:61 10:67
                                    flags: 0
                                    0: AST_VAR @ 10:61 10:67
                                        0: "logger"
                                    1: null
                    3: AST_METHOD_CALL @ 11:9 11:57
                        0: AST_VAR @ 11:9 11:13
                            0: "this"
                        1: "assertArrayHasKey"
                        2: AST_ARG_LIST @ 11:33 11:56
                            0: "adminhtml"
                            1: AST_VAR @ 11:47 11:55
                                0: "_SESSION"
                3: null


