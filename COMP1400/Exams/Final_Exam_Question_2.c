#include <stdio.h>

int main(void){
  
int number;  
int digit[10]={0};

printf("Please enter an integer number:\n");
if(scanf("%d", &number)!=1) 
  return 0;
if(number<=0) 
  return 0;

  while(number>0){
    ++digit[number%10];
    number/=10;
  }

  for(number=0; number<10; ++number)
    if(digit[number])
      printf("%d is repeated %d times\n", number, digit[number]);
}