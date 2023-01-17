//Midterm: Question 2 - Ricardo Roufai
#include<stdio.h>
#include <assert.h>
#include <stdbool.h>

//I declared the array along with the needed points. I set the count to 0 because that is the first starting number for each even number. I set total to 0 because thats where we must start the total at. There is a simple for loop that increases each "run" by one and the if statement determines whether the numbers in the array are even or odd. If so, increase the count by one and add it to the total.
int sum_even_in_array(int a[],int n,int* count){
  int countb = 0;
  int total = 0;
    for(int i=0;i<n;i++){
      if(a[i]%2==0){
        total = total+a[i];
        countb++;
        }
    }
    *count = countb;
    return total;
}

//Assert functions to check whether the sum_even_in_array is valid with the following numbinpututed. Assert functions determines the length of the array and the needed total for the even numbers in the array. I did not have enough time to fix the last assert function but that was not due to my function above but because I need to fix the true declaration at the end.
int main(void){
  int a[2]={2,4};
  int total=6;
  assert(sum_even_in_array(&a[0],2,&total)==true);

  int a2[4]={2,4,6,8};
  int total2=20;
  assert(sum_even_in_array(&a[0],4,&total2)==true);

  int a3[6]={2,4,6,8,10,12};
  int total3=42;
  assert(sum_even_in_array(&a[0],6,&total3)==true);
  printf("All tests passed successfully.\n");
  return 0;
}