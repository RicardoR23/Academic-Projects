#include<stdio.h>
#include <assert.h>

int sum_even(int a[], int size){
int j;
int sum = 0;
  for(j=0; j<size; j++){
    if(a[j]%2==0){
    sum=sum+a[j];
  }
}
  return sum;
}

int main(){
 int Size, i, a[10];
 int result = 0;
 
 printf("Please Enter the Size of the Array :  ");
   scanf("%d", &Size);
 
 printf("\nPlease Enter the Array Elements\n");
   for(i = 0; i < Size; i++){
     scanf("%d", &a[i]);
 }
 
 result = sum_even(a, Size);
 printf("\n Sum of the even numbers in the array = %d ", result);
}