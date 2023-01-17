/* ===========================================================================
COMP-1410 Assignment 1: Question 1
Ricardo Roufai
I have NOT used any outside sources.
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <stdbool.h>

int choose(int n, int m);

int main(){
  //There is 1 way to choose 0 items from 1,2.
  assert(choose(2,0) == 1);
  //There is 1 way to choose 0 items from 1,2,3,4,5.
  assert(choose(5,0) == 1);
  //There is 1 way to choose 10 items from 1,2,3,4,5,6,7,8,9,10.
  assert(choose(10,10) == 1);
  //There are 15 ways to choose 4 items from 1,2,3,4,5,6.
  assert(choose(6,4) == 15);
  printf("All tests passed successfully.\n");
}

// choose(n,m) returns how many ways there are to 
// choose m items from a set of n items
// requires: 0 <= m, 0 <= n
int choose(int n, int m){
  if(m==0 || n==m) 
    return 1;
  else
    return choose(n-1, m) + choose(n-1, m-1);
}