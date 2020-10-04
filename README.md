<a href="https://travis-ci.org/ordermind/logic-gates-php" target="_blank"><img src="https://travis-ci.org/ordermind/logic-gates-php.svg?branch=master" /></a>
# logic-gates

This is a generic library that provides logic gates for use by other libraries. It is possible to use the output value of one gate as an input value to another, and thus nesting the gates indefinitely.

Currently supported gates:

- [AND](https://en.wikipedia.org/wiki/AND_gate)
- [NAND](https://en.wikipedia.org/wiki/NAND_gate)
- [OR](https://en.wikipedia.org/wiki/OR_gate)
- [NOR](https://en.wikipedia.org/wiki/NOR_gate)
- [XOR](https://en.wikipedia.org/wiki/XOR_gate)
- [NOT](https://en.wikipedia.org/wiki/NOT_gate)

### Note about the XOR gate
If the number of input values for the XOR gate is greater than 2, it behaves as a cascade of 2-input gates and performs an odd-parity function. In effect that means that the output of the XOR gate is `true` if the number of `true` input values is odd, otherwise the output is `false`.
