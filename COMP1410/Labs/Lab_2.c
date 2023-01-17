/* ===========================================================================
COMP-1410 Lab 2
Ricardo Roufai
I have NOT used any outside sources.
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <stdbool.h>

bool order(int *const a, int *const b, int *const diff);

int main(void){
  int a;
  int b;
  int diff;
  bool switched;

  a = 10;
  b = 8;
  assert(a == 10 && b == 8);
  assert(order(&a,&b,&diff) == 1);
  assert(a == 8 && b == 10 && diff == 2);

  a = 15;
  b = 20;
  switched = order(&a,&b,&diff);
  assert(a == 15 && b == 20 && diff == 5 && !switched); 

  a = 100;
  b = 100;
  switched = order(&a,&b,&diff);
  assert(a == 100 && b == 100 && diff == 0 && !switched);     
  printf("All tests passed successfully.\n");
} 

// order(a, b) orders the values pointed to by a and b so that *a <= *b;
// *diff is set to absolute value of the difference between *a and *b;
// returns true if the values were switched and false otherwise
// requires: a, b, and diff point to memory that can be modified
bool order(int *const a, int *const b, int *const diff){
  if(*a > *b){
    *diff = *a-*b;
    *a = *b;
    *b =*a + *diff;
    return 1;
    }
  else
    *diff = *b-*a;
    return 0;
}