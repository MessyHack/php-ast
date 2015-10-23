--TEST--
ast-class -- check column
--SKIPIF--
<?php if (!extension_loaded("ast")) print "skip"; ?>
--FILE--
<?php

require __DIR__ . '/../util.php';

$code = <<<'PHP'
<?php
class Cart {
    var $items;  // Items in our shopping cart

    // Add $num articles of $artnr to the cart

    function add_item($artnr, $num) {
        $this->items[$artnr] += $num;
    }

    // Take $num articles of $artnr out of the cart

    function remove_item($artnr, $num) {
        if ($this->items[$artnr] > $num) {
            $this->items[$artnr] -= $num;
            return true;
        } elseif ($this->items[$artnr] == $num) {
            unset($this->items[$artnr]);
            return true;
        } else {
            return false;
        }
    }
}
PHP;

$ast = ast\parse_code($code);
echo ast_dump($ast, AST_DUMP_LINENOS);

?>
--EXPECT--
AST_STMT_LIST @ 1:1 24:1
    0: AST_CLASS @ 2:1 24:1
        flags: 0
        name: Cart
        0: null
        1: null
        2: AST_STMT_LIST @ 2:12 24:1
            0: AST_PROP_DECL @ 3:15 3:15
                flags: MODIFIER_PUBLIC (256)
                0: AST_PROP_ELEM @ 3:9 3:14
                    0: "items"
                    1: null
            1: AST_METHOD @ 7:5 9:5
                flags: MODIFIER_PUBLIC (256)
                name: add_item
                0: AST_PARAM_LIST @ 7:22 7:35
                    0: AST_PARAM @ 7:23 7:28
                        flags: 0
                        0: null
                        1: "artnr"
                        2: null
                    1: AST_PARAM @ 7:31 7:34
                        flags: 0
                        0: null
                        1: "num"
                        2: null
                1: null
                2: AST_STMT_LIST @ 7:37 8:37
                    0: AST_ASSIGN_OP @ 8:9 8:37
                        flags: ASSIGN_ADD (23)
                        0: AST_DIM @ 8:9 8:28
                            0: AST_PROP @ 8:9 8:20
                                0: AST_VAR @ 8:9 8:13
                                    0: "this"
                                1: "items"
                            1: AST_VAR @ 8:22 8:27
                                0: "artnr"
                        1: AST_VAR @ 8:33 8:36
                            0: "num"
                3: null
            2: AST_METHOD @ 13:5 23:5
                flags: MODIFIER_PUBLIC (256)
                name: remove_item
                0: AST_PARAM_LIST @ 13:25 13:38
                    0: AST_PARAM @ 13:26 13:31
                        flags: 0
                        0: null
                        1: "artnr"
                        2: null
                    1: AST_PARAM @ 13:34 13:37
                        flags: 0
                        0: null
                        1: "num"
                        2: null
                1: null
                2: AST_STMT_LIST @ 13:40 22:9
                    0: AST_IF @ 14:9 22:9
                        0: AST_IF_ELEM @ 14:9 14:40
                            0: AST_GREATER @ 14:13 14:39
                                0: AST_DIM @ 14:13 14:32
                                    0: AST_PROP @ 14:13 14:24
                                        0: AST_VAR @ 14:13 14:17
                                            0: "this"
                                        1: "items"
                                    1: AST_VAR @ 14:26 14:31
                                        0: "artnr"
                                1: AST_VAR @ 14:36 14:39
                                    0: "num"
                            1: AST_STMT_LIST @ 14:42 17:9
                                0: AST_ASSIGN_OP @ 15:13 15:41
                                    flags: ASSIGN_SUB (24)
                                    0: AST_DIM @ 15:13 15:32
                                        0: AST_PROP @ 15:13 15:24
                                            0: AST_VAR @ 15:13 15:17
                                                0: "this"
                                            1: "items"
                                        1: AST_VAR @ 15:26 15:31
                                            0: "artnr"
                                    1: AST_VAR @ 15:37 15:40
                                        0: "num"
                                1: AST_RETURN @ 16:13 16:24
                                    0: AST_CONST @ 16:20 16:23
                                        0: AST_NAME @ 16:20 16:23
                                            flags: NAME_NOT_FQ (1)
                                            0: "true"
                        1: AST_IF_ELEM @ 17:11 17:47
                            0: AST_BINARY_OP @ 17:19 17:46
                                flags: BINARY_IS_EQUAL (17)
                                0: AST_DIM @ 17:19 17:38
                                    0: AST_PROP @ 17:19 17:30
                                        0: AST_VAR @ 17:19 17:23
                                            0: "this"
                                        1: "items"
                                    1: AST_VAR @ 17:32 17:37
                                        0: "artnr"
                                1: AST_VAR @ 17:43 17:46
                                    0: "num"
                            1: AST_STMT_LIST @ 17:49 20:9
                                0: AST_STMT_LIST @ 18:13 18:40
                                    0: AST_UNSET @ 18:19 18:38
                                        0: AST_DIM @ 18:19 18:38
                                            0: AST_PROP @ 18:19 18:30
                                                0: AST_VAR @ 18:19 18:23
                                                    0: "this"
                                                1: "items"
                                            1: AST_VAR @ 18:32 18:37
                                                0: "artnr"
                                1: AST_RETURN @ 19:13 19:24
                                    0: AST_CONST @ 19:20 19:23
                                        0: AST_NAME @ 19:20 19:23
                                            flags: NAME_NOT_FQ (1)
                                            0: "true"
                        2: AST_IF_ELEM @ 20:11 22:9
                            0: null
                            1: AST_STMT_LIST @ 20:16 22:9
                                0: AST_RETURN @ 21:13 21:25
                                    0: AST_CONST @ 21:20 21:24
                                        0: AST_NAME @ 21:20 21:24
                                            flags: NAME_NOT_FQ (1)
                                            0: "false"
                3: null
