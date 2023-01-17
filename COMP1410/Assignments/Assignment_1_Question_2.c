/* ===========================================================================
COMP-1410 Assignment 1: Question 2
Ricardo Roufai
I have NOT used any outside sources.
=========================================================================== */

#include <stdio.h>
#include <assert.h>
#include <stdbool.h>

int num_divisors_up_to_k(int n, int k);
bool is_prime(int n);

int main(){
  //n = 20 and k = 20...output = 6
  assert(num_divisors_up_to_k(20, 20) == 6);
  //n = 10 and k = 100...output = 4
  assert(num_divisors_up_to_k(10, 100) == 4);
  //n = 2836 and k = 100...output = 3
  assert(num_divisors_up_to_k(2836, 100) == 3);
  //n = 88 and k = 500...output = 8
  assert(num_divisors_up_to_k(88, 500) == 8);
  printf("All tests passed successfully.\n");

  //8 is not a prime number: (false)
  assert(is_prime(8) == 0);
  //22 is not a prime number: (false)
  assert(is_prime(22) == 0);
  //17 is a prime number: (true)
  assert(is_prime(17) == 1);
  //47 is a prime number: (true)
  assert(is_prime(47) == 1);
  printf("All tests passed successfully.\n");
}

// num_divisors_up_to_k(n,k) returns the number of positive divisors 
// of n that are less than or equal to k
// requires: 1 <= k <= n
int num_divisors_up_to_k(int n, int k){ 
  if(k==0)
    return 0;
    
if(n%k==0)
  return 1 + num_divisors_up_to_k(n,k-1);
    else
  return 0 + num_divisors_up_to_k(n,k-1);
}

bool is_prime(int n){
  if(n<2)
    return 0;

  for(int a=2; (a*a) <= n; ++a)
    if(n%a==0)
      return 0;
    else
      return 1;
}