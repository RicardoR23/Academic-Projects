//Midterm: Question 1 - Ricardo Roufai
#include<stdio.h>
#include <assert.h>

//Declaring the function
int sum_even_up_to_n(int n);

//Assert functions to determine how many numbers there are and what the total of the even numbers should be before n.
int main(void){
  assert(sum_even_up_to_n(4) == 6);
  assert(sum_even_up_to_n(6) == 20);
  assert(sum_even_up_to_n(8) == 42);
  printf("All tests passed successfully.\n");
  return 0;
}


//Determines whether the integer is even or odd, if its even that it would proceed to the recursive function. Recursive function retrives the next or next cloest even number and adds it to the sum.
int sum_even_up_to_n(n){
  if(n%2==0){
}
  else{
    return n + sum_even_up_to_n(n-1);
  }
}