#include <stdio.h>
#include <assert.h>
#include <stdbool.h>

//function all_small_digits to find 
//whether the given number 'n' contains all digits as small 
bool all_small_digits(int n){
    //the basic idea is that we are finding each digit of the number 'n'
    //using n%10 and then dividing n by 10 to extract the last digit always
    //and check for that if that digit is greater than or equal to 5 then return false
    //else after checking for all digits return true
    
    //run  a loop till n>0
    while(n>0){  
        //check the digit is not smaller
        if((n%10)>=5){    
            //the simply return false
            return false;
        }
        
        //divide n by 10 each time
        n=n/10;
        
    }
    //return true if all digits are valid
    return true;
}