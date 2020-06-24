<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <kevin@dunglas.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\ActivityPub\Doctrine;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/**
 * JsonbAtGreater ::= "JSONB_AG" "(" LeftHandSide "," RightHandSide ")".
 *
 * This will be converted to: "( LeftHandSide::jsonb @> RightHandSide::jsonb )"
 *
 * @copyright Robin Boldt <boldtrn@gmail.com>
 * @author Robin Boldt <boldtrn@gmail.com>
 *
 * @see https://github.com/boldtrn/JsonbBundle
 */
class JsonbAtGreater extends FunctionNode
{
    public $leftHandSide;
    public $rightHandSide;

    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->leftHandSide = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->rightHandSide = $parser->ArithmeticPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }

    public function getSql(SqlWalker $sqlWalker)
    {
        // We use a workaround to allow this statement in a WHERE. Doctrine relies on the existence of an ComparisonOperator
        return '('.
            $this->leftHandSide->dispatch($sqlWalker).'::jsonb @> '.
            $this->rightHandSide->dispatch($sqlWalker).
            ')';
    }
}
