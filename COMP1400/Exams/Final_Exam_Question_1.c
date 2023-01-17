#include <stdio.h>

int main(void){
int n;
int temp=0;
double total=0;

printf("Please enter an integer number: \n");
scanf("%d",&n);

if(n<=1)
  printf("No input less than or equal to 1, goodbye!");
else{
  printf("The positive factors of %d are: ",n);

  for(int x=1;x<n;x++){
    if(n%x==0){
      printf("%d ",x);
      ++temp;
      total+=x;
    }
}
printf("The avarage of the factors is: %.2f\n",total/temp); 
    }
}