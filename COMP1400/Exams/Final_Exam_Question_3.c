#include <stdio.h>

int isSymmetric
(int *myArray, int size);

int main(void){
int arr[9]; 
int run;

printf("Enter 9 integers numbers:");
for (run=0; run<9; run++){
  scanf("%d", &arr[run]);
    }
int total=isSymmetric(arr, 9);
  if (total){
    printf("The array is symmetric!");
  }
  else{
    printf("The array is not symmetric!");
  }
}

int isSymmetric
(int *myArray, int length){

int integer=length/2; 
int run;
  for (run=0; run<integer; run++){
    if (myArray[run]!=myArray[length-run-1]){ 
}
  }
    return 1;
}