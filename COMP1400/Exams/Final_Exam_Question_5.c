#include <stdio.h>
#include <string.h>
#include <stdlib.h>

void numtochar
(int n){

long int holder;
long int total=0;

while(n>0){
    holder=n%10;
    total=total*10+holder;
  n=n/10;
}
n=total;

while(n>0){
  holder=n%10;

switch(holder){
    case 1:
      printf("O");
    break;

    case 2:
      printf("T");
    break;

    case 3:
      printf("H");
    break;

    case 4:
      printf("F");
    break;

    case 5:
      printf("V");
    break;

    case 6:
      printf("X");
    break;

    case 7:
      printf("S");
    break;

    case 8:
      printf("E");
    break;

    case 9:
      printf("N");
    break;

    case 0:
      printf("Z");
    break;

    default:
      printf("tttt");
    break;
    }
n=n/10;
  }
}

int chartoNum
(char b[]){
int i;
int integer=0;

for(i=0;b[i]!='\0';i++){
  switch(b[i]){

    case 'Z':
      integer=integer*10;
    break;

    case 'O':
      integer=integer*10+1;
    break;

    case 'T':
      integer=integer*10+2;
    break;

    case 'H':
      integer=integer*10+3;
    break;

    case 'F':
      integer=integer*10+4;
    break;

    case 'V':
      integer=integer*10+5;
    break;

    case 'X':
      integer=integer*10+6;
    break;

    case 'S':
      integer=integer*10+7;
    break;

    case 'E':
      integer=integer*10+8;
    break;

    case 'N':
      integer=integer*10+9;
    break;

    default:
    return -1;
    }
}
return integer=integer;
}

int main(void){
  
int i;
int temp;
int holder1;
int holder2;

char value1[6],value2[6];

printf("Enter the first set of Characters () : ");
    gets(value1);
printf("Enter the second set of Characters () : ");
    gets(value2);

for(i=0;value1[i]!='\0';i++){

if(value1[i]<='z'&&(value1[i]>='a')
    value1[i]=value1[i]-32;
}
for(i=0;value2[i]!='\0';i++){

if(value2[i]<='z'&&(value2[i]>='a')
    value2[i]=value2[i]-32;
}

printf("\n");
  holder1=chartoNum(value1);

printf("\n");
  holder2=chartoNum(value2);
    temp=holder1+holder2;

printf("%s+%s=", value1,value2);
  numtochar(temp);
}