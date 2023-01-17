#include <stdio.h>

int sumPositive
(int n);
int aveEven
(int n);
int sumOdd
(int n);

int sumPositive
(int n){
int sum=0;
  for(int i=0;i<=n;i++)
    sum+=i;
  return sum;
}

int aveEven(int n){
int run=0;
int sum=0;
  for(int i=n+1;;i++){
    if(i%2==0){
      sum+=i;
      run++;
  }
    if(run==n) return sum;
    }
    return 0;
}

int sumOdd(int n){
int run=0;
int sum=0;
  for(int i=n;;i++){
    if(i%2==1){
      sum+=i;
      run++;
  }
  if(run==n) 
    return sum;
    }
    return 0;
}

int main(void){
int i;
int n;
  printf("How many numbers you want to enter:");
  scanf("%d",&i);

while(i<=0){
  printf("Your input is invalid, please try again.\n");
  scanf("%d",&i);
}
    for(int value=0; value<i; value++){
    printf("Enter value %d: ", value+1);
    scanf("%d",&n);

    while(n<=0){
    printf("Your input is invalid, please try again.\n");
    scanf("%d",&n);
}   
  printf("The sum of the first %d positive integers is %d\n", n, sumPositive(n));
  printf("The sum of the %d even numbers strictly greater than %d is  %d\n", n, n, aveEven(n));
  printf("The sum of the %d odd numbers gretaer than %d is %d\n", n, n, sumOdd(n));
        }       
}