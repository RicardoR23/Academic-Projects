/* ===========================================================================
COMP-1410 Assignment 1: Question 3
Ricardo Roufai
I have NOT used any outside sources.
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <stdbool.h>

int collatz(int n);

int main(){
int n; 
//Enter number 2
assert(collatz(2)==1);
//Enter number 8
assert(collatz(8)==3);
//Enter number 12
assert(collatz(12)==9);
//Enter number 7
assert(collatz(9)==19);

printf("\nPlease enter an integer: ");
scanf("%d",&n);{
  if(n==0)
    return 0;}

if(n<0){
  printf("Error: Invalid Input");}

int steps = collatz(n);
  printf("\nThe number of steps is: %d\n",steps);
  printf("If you want to quit, please press 0");
    return 0;
}

// collatz(n) returns the number of steps it takes to reach 1 by repeatedly 
// applying the Collatz mapping on n; prints each number in the sequence starting at n
// requires: 1 <= n
int collatz(int n){ 
int iteration=0;
  
while(n!=1){
printf("%d -> ",n);
  if(n&1)
    n=3*n+1;
  else
    n=n/2; 
    ++iteration;
}

printf("%d",n);
  return iteration;
}