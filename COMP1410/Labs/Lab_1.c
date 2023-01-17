/* ===========================================================================
COMP-1410 Lab 1
Ricardo Roufai
I have NOT used any outside sources.
=========================================================================== */

#include <stdio.h>
#include <assert.h>

// digit_sum_iterative(n) returns the decimal sum of the digits in n
// requires: 0 <= n < 10^9
// note: implemented using iteration and not recursion
int digit_sum_iterative(int n) {
int sum = 0;
    while (n != 0) {
        sum = sum + n % 10;
        n = n / 10;
    }
    return sum;
}

// digit_sum_recursive(n) returns the decimal sum of the digits in n
// requires: 0 <= n < 10^9
// note: implemented using recursion and not iteration
int digit_sum_recursive(int n) {
	if (n == 0)
	  return 0;
	return (n % 10 + digit_sum_recursive(n / 10));
}

int main(void) {
  // Implement your test code here
  assert(digit_sum_iterative(1234) == 10);
  assert(digit_sum_iterative(0) == 0);
  assert(digit_sum_iterative(9999999) == 63);

  assert(digit_sum_recursive(1234) == 10);
  assert(digit_sum_recursive(0) == 0);
  assert(digit_sum_recursive(9999999) == 63);
	printf("All tests passed successfully.\n");
  return 0;
}